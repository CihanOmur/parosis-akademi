<?php

namespace App\Http\Controllers\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider\Slider;
use App\Models\Slider\SliderItem;
use Illuminate\Http\Request;

class SliderItemController extends Controller
{
    public function index($sliderId)
    {
        $slider = Slider::findOrFail($sliderId);
        $items = SliderItem::where('slider_id', $sliderId)->orderBy('sort_order')->get();
        return view('admin.slider.items.index', compact('slider', 'items'));
    }

    public function create($sliderId)
    {
        $slider = Slider::findOrFail($sliderId);
        return view('admin.slider.items.create', compact('slider'));
    }

    public function store(Request $request, $sliderId)
    {
        $slider = Slider::findOrFail($sliderId);

        $request->validate([
            'title'            => 'required|string|max:500',
            'highlight_text'   => 'nullable|string|max:255',
            'description'      => 'nullable|string|max:2000',
            'button_text'      => 'nullable|string|max:255',
            'button_url'       => 'nullable|string|max:500',
            'image'            => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:5120',
            'background_image' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:5120',
        ]);

        $locale = app()->getLocale();

        $item = new SliderItem();
        $item->slider_id = $slider->id;
        $item->setTranslation('title', $locale, $request->title);
        $item->setTranslation('highlight_text', $locale, $request->highlight_text ?? '');
        $item->setTranslation('description', $locale, $request->description ?? '');
        $item->setTranslation('button_text', $locale, $request->button_text ?? '');
        $item->button_url = $request->button_url;
        $item->sort_order = SliderItem::where('slider_id', $slider->id)->max('sort_order') + 1;
        $item->is_active = true;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sliders'), $filename);
            $item->image = 'uploads/sliders/' . $filename;
        }

        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            $filename = time() . '_bg_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sliders'), $filename);
            $item->background_image = 'uploads/sliders/' . $filename;
        }

        $item->save();

        return redirect()->route('sliders.items.index', $slider->id)
            ->with('success', 'Slayt başarıyla eklendi.');
    }

    public function edit($sliderId, $id)
    {
        $slider = Slider::findOrFail($sliderId);
        $item = SliderItem::where('slider_id', $sliderId)->findOrFail($id);
        return view('admin.slider.items.edit', compact('slider', 'item'));
    }

    public function update(Request $request, $sliderId, $id)
    {
        $slider = Slider::findOrFail($sliderId);
        $item = SliderItem::where('slider_id', $sliderId)->findOrFail($id);

        $request->validate([
            'title'            => 'required|string|max:500',
            'highlight_text'   => 'nullable|string|max:255',
            'description'      => 'nullable|string|max:2000',
            'button_text'      => 'nullable|string|max:255',
            'button_url'       => 'nullable|string|max:500',
            'image'            => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:5120',
            'background_image' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:5120',
        ]);

        $locale = app()->getLocale();

        $item->setTranslation('title', $locale, $request->title);
        $item->setTranslation('highlight_text', $locale, $request->highlight_text ?? '');
        $item->setTranslation('description', $locale, $request->description ?? '');
        $item->setTranslation('button_text', $locale, $request->button_text ?? '');
        $item->button_url = $request->button_url;

        if ($request->hasFile('image')) {
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sliders'), $filename);
            $item->image = 'uploads/sliders/' . $filename;
        }

        if ($request->hasFile('background_image')) {
            if ($item->background_image && file_exists(public_path($item->background_image))) {
                unlink(public_path($item->background_image));
            }
            $file = $request->file('background_image');
            $filename = time() . '_bg_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sliders'), $filename);
            $item->background_image = 'uploads/sliders/' . $filename;
        }

        $item->save();

        return redirect()->route('sliders.items.index', $slider->id)
            ->with('success', 'Slayt başarıyla güncellendi.');
    }

    public function delete($sliderId, $id)
    {
        $item = SliderItem::where('slider_id', $sliderId)->findOrFail($id);

        if ($item->image && file_exists(public_path($item->image))) {
            unlink(public_path($item->image));
        }
        if ($item->background_image && file_exists(public_path($item->background_image))) {
            unlink(public_path($item->background_image));
        }

        $item->delete();

        return redirect()->route('sliders.items.index', $sliderId)
            ->with('success', 'Slayt silindi.');
    }

    public function updateOrder(Request $request, $sliderId)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:slider_items,id',
        ]);

        foreach ($request->order as $index => $id) {
            SliderItem::where('id', $id)->where('slider_id', $sliderId)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($sliderId, $id)
    {
        $item = SliderItem::where('slider_id', $sliderId)->findOrFail($id);
        $item->is_active = !$item->is_active;
        $item->save();

        return response()->json([
            'status'  => 1,
            'message' => $item->is_active ? 'Slayt aktif edildi.' : 'Slayt pasif edildi.',
            'action'  => $item->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function editTranslate($sliderId, $id, $lang)
    {
        $slider = Slider::findOrFail($sliderId);
        $item = SliderItem::where('slider_id', $sliderId)->findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.slider.items.edit-translate', compact('slider', 'item', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $sliderId, $id)
    {
        $item = SliderItem::where('slider_id', $sliderId)->findOrFail($id);

        $request->validate([
            'title'          => 'required|string|max:500',
            'highlight_text' => 'nullable|string|max:255',
            'description'    => 'nullable|string|max:2000',
            'button_text'    => 'nullable|string|max:255',
            'lang'           => 'required|string',
        ]);

        $locale = $request->lang;

        $item->setTranslation('title', $locale, $request->title);
        $item->setTranslation('highlight_text', $locale, $request->highlight_text ?? '');
        $item->setTranslation('description', $locale, $request->description ?? '');
        $item->setTranslation('button_text', $locale, $request->button_text ?? '');
        $item->save();

        return redirect()->route('sliders.items.edit', [$sliderId, $id])
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }
}
