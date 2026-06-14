<?php

namespace App\Http\Controllers\Competition;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index()
    {
        $competitions = Competition::withCount('participants')
            ->orderBy('sort_order')
            ->orderByDesc('start_date')
            ->orderBy('name')
            ->get();
        return view('admin.competitions.index', compact('competitions'));
    }

    public function create()
    {
        return view('admin.competitions.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        $competition = new Competition();
        $competition->fill($validated);
        $competition->sort_order = (Competition::max('sort_order') ?? 0) + 1;
        $competition->is_active = $request->boolean('is_active', true);
        $competition->save();

        return redirect()->route('competitions.index')
            ->with('success', 'Yarışma eklendi.');
    }

    public function edit($id)
    {
        $competition = Competition::findOrFail($id);
        return view('admin.competitions.edit', compact('competition'));
    }

    public function update(Request $request, $id)
    {
        $competition = Competition::findOrFail($id);
        $validated = $this->validateRequest($request);

        $competition->fill($validated);
        $competition->is_active = $request->boolean('is_active', $competition->is_active);
        $competition->save();

        return redirect()->route('competitions.index')
            ->with('success', 'Yarışma güncellendi.');
    }

    public function show($id)
    {
        $competition = Competition::withCount('participants')->findOrFail($id);
        $entries = $competition->entries()
            ->with('student')
            ->orderBy('result_rank')
            ->orderByDesc('created_at')
            ->paginate(20);
        return view('admin.competitions.show', compact('competition', 'entries'));
    }

    public function delete($id)
    {
        $competition = Competition::findOrFail($id);
        $competition->delete();

        return redirect()->route('competitions.index')
            ->with('success', 'Yarışma silindi.');
    }

    public function toggleActive($id)
    {
        $competition = Competition::findOrFail($id);
        $competition->is_active = !$competition->is_active;
        $competition->save();

        return response()->json([
            'status'  => 1,
            'message' => $competition->is_active ? 'Yarışma aktif edildi.' : 'Yarışma pasif edildi.',
            'action'  => $competition->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:competitions,id',
        ]);

        foreach ($request->order as $index => $id) {
            Competition::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'name'        => 'required|string|max:200',
            'organizer'   => 'nullable|string|max:200',
            'location'    => 'nullable|string|max:200',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:5000',
        ]);
    }
}
