<?php

namespace App\Http\Controllers\Languages;

use App\Http\Controllers\Controller;
use App\Models\Languages\Languages;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{

    public function index()
    {
        $languages = Languages::where('status', 1)->get();

        return view('admin.langauges.index', [
            'languages' => $languages
        ]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:languages,id'
        ], [
            'id.exists' => 'Böyle bir dil bulunamadı'
        ]);
        $language = Languages::where('id', $request->id)->first();
        if (!$language) {
            return response()->json([
                'status' => 0,
                'message' => 'islem basarisiz'
            ]);
        }

        $language->is_active = !$language->is_active;
        $language->save();

        return response()->json([
            'status' => 1,
            'message' => 'islem Basarili',
            'action' => $language->is_active == 1 ? 'Aktif' : 'Pasif',
        ]);
    }
}
