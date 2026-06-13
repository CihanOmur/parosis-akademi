<?php

namespace App\Http\Controllers\ConsultingInstitution;

use App\Http\Controllers\Controller;
use App\Models\ConsultingInstitution;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;

class ConsultingInstitutionController extends Controller
{
    public function index()
    {
        $institutions = ConsultingInstitution::withCount('certificates')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        return view('admin.consulting-institutions.index', compact('institutions'));
    }

    public function show($id)
    {
        $institution = ConsultingInstitution::withCount('certificates')->findOrFail($id);
        $certificates = $institution->certificates()
            ->with(['student', 'category'])
            ->paginate(20);
        return view('admin.consulting-institutions.show', compact('institution', 'certificates'));
    }

    public function create()
    {
        return view('admin.consulting-institutions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:200',
            'contact_email' => 'nullable|email|max:200',
            'contact_phone' => 'nullable|string|max:50',
            'notes'         => 'nullable|string|max:5000',
        ], ValidationMessageService::getMessages('consulting_institution_store'));

        $institution = new ConsultingInstitution();
        $institution->fill($validated);
        $institution->sort_order = (ConsultingInstitution::max('sort_order') ?? 0) + 1;
        $institution->is_active = true;
        $institution->save();

        return redirect()->route('consultingInstitutions.index')
            ->with('success', 'Danışmanlık kurumu eklendi.');
    }

    public function edit($id)
    {
        $institution = ConsultingInstitution::findOrFail($id);
        return view('admin.consulting-institutions.edit', compact('institution'));
    }

    public function update(Request $request, $id)
    {
        $institution = ConsultingInstitution::findOrFail($id);

        $validated = $request->validate([
            'name'          => 'required|string|max:200',
            'contact_email' => 'nullable|email|max:200',
            'contact_phone' => 'nullable|string|max:50',
            'notes'         => 'nullable|string|max:5000',
        ], ValidationMessageService::getMessages('consulting_institution_update'));

        $institution->fill($validated)->save();

        return redirect()->route('consultingInstitutions.index')
            ->with('success', 'Danışmanlık kurumu güncellendi.');
    }

    public function delete($id)
    {
        $institution = ConsultingInstitution::findOrFail($id);
        $institution->delete();

        return redirect()->route('consultingInstitutions.index')
            ->with('success', 'Danışmanlık kurumu silindi.');
    }

    public function toggleActive($id)
    {
        $institution = ConsultingInstitution::findOrFail($id);
        $institution->is_active = !$institution->is_active;
        $institution->save();

        return response()->json([
            'status'  => 1,
            'message' => $institution->is_active ? 'Kurum aktif edildi.' : 'Kurum pasif edildi.',
            'action'  => $institution->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:consulting_institutions,id',
        ]);

        foreach ($request->order as $index => $id) {
            ConsultingInstitution::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }
}
