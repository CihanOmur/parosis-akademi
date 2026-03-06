<?php

namespace App\Http\Controllers\MenuItem;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Services\ValidationMessageService;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::whereNull('parent_id')
            ->with('children.children')
            ->orderBy('sort_order')
            ->get();

        return view('admin.menu-items.index', compact('menuItems'));
    }

    public function create()
    {
        $parentItems = MenuItem::whereNull('parent_id')
            ->with('children')
            ->orderBy('sort_order')
            ->get();

        return view('admin.menu-items.create', compact('parentItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label'     => 'required|string|max:255',
            'url'       => 'required|string|max:500',
            'target'    => 'required|in:_self,_blank',
            'parent_id' => 'nullable|exists:menu_items,id',
        ], ValidationMessageService::getMessages('menu_store'));

        $locale = app()->getLocale();

        $menuItem = new MenuItem();
        $menuItem->setTranslation('label', $locale, $request->label);
        $menuItem->url = $request->url;
        $menuItem->target = $request->target;
        $menuItem->parent_id = $request->parent_id ?: null;
        $menuItem->sort_order = MenuItem::where('parent_id', $menuItem->parent_id)->max('sort_order') + 1;
        $menuItem->is_active = true;
        $menuItem->save();

        return redirect()->route('menu-items.index')
            ->with('success', 'Menü öğesi başarıyla eklendi.');
    }

    public function edit($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $parentItems = MenuItem::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->with(['children' => function ($q) use ($id) {
                $q->where('id', '!=', $id);
            }])
            ->orderBy('sort_order')
            ->get();

        return view('admin.menu-items.edit', compact('menuItem', 'parentItems'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'label'     => 'required|string|max:255',
            'url'       => 'required|string|max:500',
            'target'    => 'required|in:_self,_blank',
            'parent_id' => 'nullable|exists:menu_items,id',
        ], ValidationMessageService::getMessages('menu_update'));

        $menuItem = MenuItem::findOrFail($id);
        $locale = app()->getLocale();

        $menuItem->setTranslation('label', $locale, $request->label);
        $menuItem->url = $request->url;
        $menuItem->target = $request->target;
        $menuItem->parent_id = $request->parent_id ?: null;
        $menuItem->save();

        return redirect()->route('menu-items.index')
            ->with('success', 'Menü öğesi başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->delete(); // cascade ile alt öğeler de silinir

        return redirect()->route('menu-items.index')
            ->with('success', 'Menü öğesi silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:menu_items,id',
        ], ValidationMessageService::getMessages('menu_order'));

        foreach ($request->order as $index => $id) {
            MenuItem::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function indent($id)
    {
        $item = MenuItem::with('children')->findOrFail($id);

        // Ayni seviyedeki onceki kardes
        $prevSibling = MenuItem::where('parent_id', $item->parent_id)
            ->where('sort_order', '<', $item->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        if (!$prevSibling) {
            return response()->json(['status' => 0, 'message' => 'Oncesinde oge yok, iceri tasinamaz.']);
        }

        // Derinlik kontrolu (max 3 seviye: 0, 1, 2)
        $prevDepth = $this->getDepth($prevSibling);
        $childDepth = $this->getMaxChildDepth($item);

        if ($prevDepth + 1 + $childDepth > 2) {
            return response()->json(['status' => 0, 'message' => 'Maksimum 3 seviye desteklenir.']);
        }

        $item->parent_id = $prevSibling->id;
        $item->sort_order = MenuItem::where('parent_id', $prevSibling->id)->max('sort_order') + 1;
        $item->save();

        return response()->json(['status' => 1, 'message' => 'Oge iceri tasindi.']);
    }

    public function outdent($id)
    {
        $item = MenuItem::findOrFail($id);

        if (!$item->parent_id) {
            return response()->json(['status' => 0, 'message' => 'Zaten en ust seviyede.']);
        }

        $parent = MenuItem::findOrFail($item->parent_id);
        $newParentId = $parent->parent_id;

        // Parent'in sort_order'indan sonraya yerlestir
        MenuItem::where('parent_id', $newParentId)
            ->where('sort_order', '>', $parent->sort_order)
            ->increment('sort_order');

        $item->parent_id = $newParentId;
        $item->sort_order = $parent->sort_order + 1;
        $item->save();

        return response()->json(['status' => 1, 'message' => 'Oge disari tasindi.']);
    }

    private function getDepth(MenuItem $item): int
    {
        $depth = 0;
        $current = $item;
        while ($current->parent_id) {
            $depth++;
            $current = MenuItem::find($current->parent_id);
        }
        return $depth;
    }

    private function getMaxChildDepth(MenuItem $item): int
    {
        $max = 0;
        $children = MenuItem::where('parent_id', $item->id)->get();
        foreach ($children as $child) {
            $childDepth = 1 + $this->getMaxChildDepth($child);
            $max = max($max, $childDepth);
        }
        return $max;
    }

    public function toggleActive($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->is_active = !$menuItem->is_active;
        $menuItem->save();

        return response()->json([
            'status'  => 1,
            'message' => $menuItem->is_active ? 'Menü öğesi aktif edildi.' : 'Menü öğesi pasif edildi.',
            'action'  => $menuItem->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function editTranslate($id, $lang)
    {
        $menuItem = MenuItem::findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.menu-items.edit-translate', compact('menuItem', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'lang'  => 'required|string',
        ], ValidationMessageService::getMessages('menu_translate'));

        $menuItem = MenuItem::findOrFail($id);
        $menuItem->setTranslation('label', $request->lang, $request->label);
        $menuItem->save();

        return redirect()->route('menu-items.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }
}
