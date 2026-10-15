<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Hesabım (yalnız 'auth:member'): bilgilerim + şifre değiştir.
 */
class AccountController extends Controller
{
    public function show()
    {
        $member = Auth::guard('member')->user();
        return view('front.pages.member.account', compact('member'));
    }

    public function update(Request $request)
    {
        $member = Auth::guard('member')->user();

        $data = $request->validateWithBag('accountInfo', [
            'name'  => 'required|string|max:150',
            'email' => ['required', 'email', 'max:190', Rule::unique('members', 'email')->ignore($member->id)],
            'phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+()\s-]{7,30}$/'],
        ], ValidationMessageService::getMessagesForLocale('member_account_update', 'member.validation.member_account_update'));

        $member->update($data);

        return back()->with('account_status', __('member.info_updated'));
    }

    public function password(Request $request)
    {
        $member = Auth::guard('member')->user();

        $data = $request->validateWithBag('accountPassword', [
            'current_password' => 'required|current_password:member',
            'password'         => 'required|string|min:8|max:255|confirmed|different:current_password',
        ], ValidationMessageService::getMessagesForLocale('member_account_password', 'member.validation.member_account_password'));

        // Yeni şifre + "beni hatırla" anahtarını yenile (başka cihazdaki hatırlanan girişler düşer)
        $member->forceFill([
            'password'       => $data['password'],
            'remember_token' => Str::random(60),
        ])->save();
        $request->session()->regenerate();

        return back()->with('account_status', __('member.password_changed'));
    }
}
