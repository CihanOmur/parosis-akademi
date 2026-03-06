<?php

namespace App\Http\Controllers\ClientLogo;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo\ClientLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\ValidationMessageService;

class ClientLogoController extends Controller
{
    public function index()
    {
        $logos = ClientLogo::orderBy('sort_order')->get();
        return view('admin.client-logo.index', compact('logos'));
    }

    public function create()
    {
        return view('admin.client-logo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'nullable|string|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'url'   => 'nullable|url|max:500',
        ], ValidationMessageService::getMessages('client_logo_store'));

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/client-logos'), $filename);
            $imagePath = 'uploads/client-logos/' . $filename;
        }

        ClientLogo::create([
            'name'       => $request->name,
            'image'      => $imagePath,
            'url'        => $request->url,
            'sort_order' => ClientLogo::max('sort_order') + 1,
            'is_active'  => true,
        ]);

        return redirect()->route('client-logos.index')
            ->with('success', 'Logo başarıyla eklendi.');
    }

    public function edit($id)
    {
        $logo = ClientLogo::findOrFail($id);
        return view('admin.client-logo.edit', compact('logo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'url'   => 'nullable|url|max:500',
        ], ValidationMessageService::getMessages('client_logo_update'));

        $logo = ClientLogo::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($logo->image && file_exists(public_path($logo->image))) {
                unlink(public_path($logo->image));
            }
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/client-logos'), $filename);
            $logo->image = 'uploads/client-logos/' . $filename;
        }

        $logo->name = $request->name;
        $logo->url  = $request->url;
        $logo->save();

        return redirect()->route('client-logos.index')
            ->with('success', 'Logo başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $logo = ClientLogo::findOrFail($id);

        if ($logo->image && file_exists(public_path($logo->image))) {
            unlink(public_path($logo->image));
        }

        $logo->delete();

        return redirect()->route('client-logos.index')
            ->with('success', 'Logo silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:client_logos,id',
        ], ValidationMessageService::getMessages('client_logo_order'));

        foreach ($request->order as $index => $id) {
            ClientLogo::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $logo = ClientLogo::findOrFail($id);
        $logo->is_active = !$logo->is_active;
        $logo->save();

        return response()->json([
            'status'  => 1,
            'message' => $logo->is_active ? 'Logo aktif edildi.' : 'Logo pasif edildi.',
            'action'  => $logo->is_active ? 'Aktif' : 'Pasif',
        ]);
    }
}
