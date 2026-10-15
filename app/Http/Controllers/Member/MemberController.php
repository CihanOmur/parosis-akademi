<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member\Member;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Panel → Üyeler: site üyelerinin listesi ve yönetimi (permission:member / member_delete).
 */
class MemberController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $status = $request->get('status', '');

        $query = Member::query()->orderByDesc('created_at');

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%")
                  ->orWhere('phone', 'like', "%{$q}%");
            });
        }
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'passive') {
            $query->where('is_active', false);
        }

        $members = $query->paginate(25)->withQueryString();
        $totalCount = Member::count();

        return view('admin.members.index', compact('members', 'totalCount'));
    }

    public function show($id)
    {
        $member = Member::findOrFail($id);

        // Üyeyken verilen siparişler / kurs başvuruları (son 20) + toplam sayıları
        $orders = $member->orders()->latest('id')->limit(20)->get();
        $applications = $member->courseApplications()->with('course')->latest('id')->limit(20)->get();
        $orderCount = $member->orders()->count();
        $applicationCount = $member->courseApplications()->count();

        return view('admin.members.show', compact('member', 'orders', 'applications', 'orderCount', 'applicationCount'));
    }

    public function toggleActive($id)
    {
        $member = Member::findOrFail($id);
        $member->is_active = !$member->is_active;
        if (!$member->is_active) {
            // "Beni hatırla" girişi düşsün; açık oturum EnsureMemberIsActive ile ilk istekte kapanır
            $member->remember_token = Str::random(60);
        }
        $member->save();

        return back()->with('success', $member->is_active ? 'Üye aktifleştirildi.' : 'Üye pasifleştirildi.');
    }

    public function updatePassword(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $data = $request->validate([
            'password' => 'required|string|min:8|max:255',
        ], ValidationMessageService::getMessages('member_admin_password'));

        $member->forceFill([
            'password'       => $data['password'],
            'remember_token' => Str::random(60),
        ])->save();

        return back()->with('success', 'Üyenin şifresi değiştirildi.');
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();

        return redirect()->route('members.index')->with('success', 'Üye silindi.');
    }
}
