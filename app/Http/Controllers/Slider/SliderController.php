<?php

namespace App\Http\Controllers\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::withCount('items')->orderBy('sort_order')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Slider::create([
            'name'       => $request->name,
            'sort_order' => Slider::max('sort_order') + 1,
            'is_active'  => false,
        ]);

        return redirect()->route('sliders.index')
            ->with('success', 'Slider başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $slider = Slider::withCount('items')->findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $slider = Slider::findOrFail($id);
        $slider->name = $request->name;
        $slider->save();

        return redirect()->route('sliders.index')
            ->with('success', 'Slider başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $slider = Slider::with('items')->findOrFail($id);

        foreach ($slider->items as $item) {
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }
            if ($item->background_image && file_exists(public_path($item->background_image))) {
                unlink(public_path($item->background_image));
            }
        }

        $slider->delete();

        return redirect()->route('sliders.index')
            ->with('success', 'Slider ve tüm slaytları silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:sliders,id',
        ]);

        foreach ($request->order as $index => $id) {
            Slider::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->is_active) {
            $slider->is_active = false;
            $slider->save();

            return response()->json([
                'status'  => 1,
                'message' => 'Slider pasif edildi.',
                'action'  => 'Pasif',
            ]);
        }

        Slider::where('is_active', true)->update(['is_active' => false]);

        $slider->is_active = true;
        $slider->save();

        return response()->json([
            'status'  => 1,
            'message' => 'Slider aktif edildi. Diğer sliderlar pasif edildi.',
            'action'  => 'Aktif',
        ]);
    }
}
