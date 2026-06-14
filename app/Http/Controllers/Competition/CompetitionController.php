<?php

namespace App\Http\Controllers\Competition;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\CompetitionCategory;
use App\Models\CompetitionStudent;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $query = Competition::withCount('participants')->with('categories');

        if ($request->filled('category_id')) {
            $catId = (int) $request->input('category_id');
            $query->whereHas('categories', fn($q) => $q->where('competition_categories.id', $catId));
        }

        $competitions = $query
            ->orderBy('sort_order')
            ->orderByDesc('start_date')
            ->orderBy('name')
            ->get();

        $allCategories = CompetitionCategory::orderBy('name')->get();

        return view('admin.competitions.index', compact('competitions', 'allCategories'));
    }

    public function create()
    {
        $allCategories = CompetitionCategory::orderBy('name')->get();
        return view('admin.competitions.create', compact('allCategories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        $categoryIds = $this->resolveCategories($request->input('categories', []));

        $competition = new Competition();
        $competition->fill($validated);
        $competition->sort_order = (Competition::max('sort_order') ?? 0) + 1;
        $competition->is_active = $request->boolean('is_active', true);
        $competition->save();

        $competition->categories()->sync($categoryIds);

        return redirect()->route('competitions.index')
            ->with('success', 'Yarışma eklendi.');
    }

    public function edit($id)
    {
        $competition = Competition::with('categories')->findOrFail($id);
        $allCategories = CompetitionCategory::orderBy('name')->get();
        return view('admin.competitions.edit', compact('competition', 'allCategories'));
    }

    public function update(Request $request, $id)
    {
        $competition = Competition::findOrFail($id);
        $validated = $this->validateRequest($request);
        $categoryIds = $this->resolveCategories($request->input('categories', []));

        $competition->fill($validated);
        $competition->is_active = $request->boolean('is_active', $competition->is_active);
        $competition->save();

        $competition->categories()->sync($categoryIds);

        return redirect()->route('competitions.index')
            ->with('success', 'Yarışma güncellendi.');
    }

    public function show(Request $request, $id)
    {
        $competition = Competition::with('categories')->withCount('participants')->findOrFail($id);

        // Bu yarışmaya henüz atanmamış aktif öğrenciler
        $attachedIds = $competition->participants()->pluck('students.id')->toArray();
        $availableStudents = \App\Models\Student\Student::where('registration_type', 2)
            ->whereNotIn('id', $attachedIds)
            ->orderBy('full_name')
            ->get(['id', 'full_name'])
            ->map(fn($s) => ['id' => $s->id, 'name' => $s->full_name])
            ->values()
            ->toArray();

        $query = $competition->entries()
            ->with(['student', 'category']);

        // Kombinasyon filtreleri
        if ($request->filled('category_id')) {
            $query->where('competition_category_id', (int) $request->input('category_id'));
        }
        if ($request->filled('visa_status')) {
            $query->where('visa_status', $request->input('visa_status'));
        }
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->input('payment_status'));
        }

        $entries = $query
            ->orderBy('result_rank')
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        $statusOptions = [
            'visa'    => CompetitionStudent::VISA,
            'payment' => CompetitionStudent::PAYMENT,
        ];

        return view('admin.competitions.show', compact('competition', 'entries', 'statusOptions', 'availableStudents'));
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
            'name'              => 'required|string|max:200',
            'organizer'         => 'nullable|string|max:200',
            'country'           => 'nullable|string|max:100',
            'city'              => 'nullable|string|max:100',
            'location'          => 'nullable|string|max:200',
            'start_date'        => 'nullable|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
            'internal_deadline' => 'nullable|date',
            'description'       => 'nullable|string|max:5000',
            'website_url'       => 'nullable|url|max:500',
        ]);
    }

    /**
     * Tom Select tagging: input dizisi (string|int) → category id'leri.
     * Yeni etiket varsa otomatik kayıt oluşturur.
     */
    private function resolveCategories(array $items): array
    {
        return CompetitionCategory::syncFromInput($items);
    }
}
