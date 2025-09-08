<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Teams\TeamComment;
use App\Models\Teams\Teams;
use App\Models\Teams\TeamsUserPersonelInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamsController extends Controller
{
    public function index(Request $request)
    {
        $teams = Teams::with('category')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("title->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->paginate(10);

        return view('admin.teams.index', [
            'teams' => $teams,
        ]);
    }
    public function create(Request $request)
    {
        $categories = Category::where('model', 'Departments')->where('is_active', true)->get();
        return view('admin.teams.create', [
            'categories' => $categories
        ]);
    }
    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'category' => 'required|exists:categories,id',
                'position' => 'required|string|max:255',
                'file' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'personal_infos' => 'array',
            ],
            [
                'title.required' => 'Başlık alanı gereklidir.',
                'title.string' => 'Başlık alanı metin olmalıdır.',
                'title.max' => 'Başlık alanı en fazla 255 karakter olmalıdır.',
                'description.required' => 'Açıklama alanı gereklidir.',
                'description.string' => 'Açıklama alanı metin olmalıdır.',
                'description.max' => 'Açıklama alanı en fazla 500 karakter olmalıdır.',
                'category.required' => 'Kategori alanı gereklidir.',
                'category.exists' => 'Seçilen kategori geçerli değil.',
                'position.required' => 'Pozisyon alanı gereklidir.',
                'position.string' => 'Pozisyon alanı metin olmalıdır.',
                'position.max' => 'Pozisyon alanı en fazla 255 karakter olmalıdır.',
                'file.required' => 'Dosya alanı gereklidir.',
                'file.file' => 'Dosya alanı geçerli bir dosya olmalıdır.',
                'file.mimes' => 'Dosya alanı yalnızca jpg, jpeg ve png uzantılı dosyaları kabul etmektedir.',
                'file.max' => 'Dosya alanı en fazla 2MB boyutunda olmalıdır.',
            ]
        );

        $team = new Teams();
        $team->title = $request->title;
        $team->description = $request->description;
        $team->position = $request->position;
        $team->category_id = $request->category;
        $team->email = $request->email;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('teams', $filename, 'public');
            $team->image_url = $filename;
        }
        $team->save();

        if ($request->has('personal_infos')) {
            foreach ($request->personal_infos as $info) {
                $personalInfo = new TeamsUserPersonelInfo();
                $personalInfo->title = $info['title'];
                $personalInfo->description = $info['description'] ?? null;
                $personalInfo->team_id = $team->id;
                $personalInfo->save();
            }
        }

        return redirect()->route('teams.index')->with('success', 'Takım başarıyla eklendi.');
    }

    public function edit($id)
    {
        $team = Teams::with(['category', 'personalInfos'])->findOrFail($id);
        $categories = Category::where('model', 'Departments')->where('is_active', true)->get();
        return view('admin.teams.edit', [
            'team' => $team,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $team = Teams::findOrFail($id);

        $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'category' => 'required|exists:categories,id',
                'position' => 'required|string|max:255',
                'file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'personal_infos' => 'array',
            ],
            [
                'title.required' => 'Başlık alanı gereklidir.',
                'title.string' => 'Başlık alanı metin olmalıdır.',
                'title.max' => 'Başlık alanı en fazla 255 karakter olmalıdır.',
                'description.required' => 'Açıklama alanı gereklidir.',
                'description.string' => 'Açıklama alanı metin olmalıdır.',
                'description.max' => 'Açıklama alanı en fazla 500 karakter olmalıdır.',
                'category.required' => 'Kategori alanı gereklidir.',
                'category.exists' => 'Seçilen kategori geçerli değil.',
                'position.required' => 'Pozisyon alanı gereklidir.',
                'position.string' => 'Pozisyon alanı metin olmalıdır.',
                'position.max' => 'Pozisyon alanı en fazla 255 karakter olmalıdır.',
                'file.file' => 'Dosya alanı geçerli bir dosya olmalıdır.',
                'file.mimes' => 'Dosya alanı yalnızca jpg, jpeg ve png uzantılı dosyaları kabul etmektedir.',
                'file.max' => 'Dosya alanı en fazla 2MB boyutunda olmalıdır.',
            ]
        );
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $team->setTranslation('title', $translateLang, $request->title);
        $team->setTranslation('description', $translateLang, $request->description);
        $team->setTranslation('position', $translateLang, $request->position);
        $team->category_id = $request->category;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('teams', $filename, 'public');
            $team->image_url = $filename;
        }
        $team->save();

        if ($request->has('personal_infos')) {
            $team->personalInfos()->delete();
            foreach ($request->personal_infos as $info) {
                TeamsUserPersonelInfo::create([
                    'title' => $info['title'],
                    'description' => $info['description'] ?? null,
                    'team_id' => $team->id,
                ]);
            }
        }

        return redirect()->route('teams.index')->with('success', 'Takım başarıyla güncellendi.');
    }

    public function editTranslate($id)
    {
        $team = Teams::with(['category', 'personalInfos'])->findOrFail($id);

        return view('admin.teams.translate', [
            'team' => $team,
        ]);
    }

    public function updateTranslate(Request $request, $id)
    {
        $team = Teams::findOrFail($id);

        $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'position' => 'required|string|max:255',
            ],
            [
                'title.required' => 'Başlık alanı gereklidir.',
                'title.string' => 'Başlık alanı metin olmalıdır.',
                'title.max' => 'Başlık alanı en fazla 255 karakter olmalıdır.',
                'description.required' => 'Açıklama alanı gereklidir.',
                'description.string' => 'Açıklama alanı metin olmalıdır.',
                'description.max' => 'Açıklama alanı en fazla 500 karakter olmalıdır.',
                'category.required' => 'Kategori alanı gereklidir.',

            ]
        );
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $team->setTranslation('title', $translateLang, $request->title);
        $team->setTranslation('description', $translateLang, $request->description);
        $team->setTranslation('position', $translateLang, $request->position);

        $team->save();


        return redirect()->route('teams.index')->with('success', 'Takım başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $team = Teams::findOrFail($id);
        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Takım başarıyla silindi.');
    }

    public function generateSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $count = Category::where('slug', 'like', $slug . '%')->when($id, function ($query) use ($id) {
            return $query->where('id', '!=', $id);
        })->count();

        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        return $slug;
    }
    public function departmentIndex(Request $request)
    {
        $departments = Category::where('model', 'Departments')->withCount('departments')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.teams.departments.index', [
            'departments' => $departments,
        ]);
    }

    public function departmentStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $department = new Category();
        $department->name = $request->title;
        $department->description = $request->description;
        $department->slug = $this->generateSlug($request->title);
        $department->is_active = true;
        $department->model = 'Departments';
        $department->parent_id = $request->parent_id;
        $department->save();

        return redirect()->route('teams.departments.index')->with('success', 'Department created successfully.');
    }

    public function departmentEdit(Request $request, $id)
    {
        $department = Category::where('id', $id)->where('model', 'Departments')->first();
        if (!$department) {
            return redirect()->route('teams.departments.index')->with('error', 'Department not found.');
        }
        $departments = Category::where('model', 'Departments')->withCount('departments')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.teams.departments.edit', [
            'department' => $department,
            'departments' => $departments,
        ]);
    }

    public function departmentUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $department = Category::where('id', $id)->where('model', 'Departments')->first();
        if (!$department) {
            return redirect()->route('teams.departments.index')->with('error', 'Department not found.');
        }

        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $department->setTranslation('name', $translateLang, $request->title);
        $department->setTranslation('description', $translateLang, $request->description);
        $department->slug = $this->generateSlug($request->title, $id);
        $department->parent_id = $request->parent_id;
        $department->save();

        return redirect()->route('teams.departments.index')->with('success', 'Department updated successfully.');
    }
    public function departmentTranslateIndex(Request $request, $id)
    {
        $department = Category::where('id', $id)->where('model', 'Departments')->first();
        if (!$department) {
            return redirect()->route('teams.departments.index')->with('error', 'Department not found.');
        }
        $departments = Category::where('model', 'Departments')->withCount('departments')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.teams.departments.translate', [
            'department' => $department,
            'departments' => $departments,
        ]);
    }
    public function departmentTranslate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $department = Category::where('id', $id)->where('model', 'Departments')->first();
        if (!$department) {
            return redirect()->route('teams.departments.index')->with('error', 'Department not found.');
        }

        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $department->setTranslation('name', $translateLang, $request->title);
        $department->setTranslation('description', $translateLang, $request->description);
        $department->save();

        return redirect()->route('teams.departments.index')->with('success', 'Department updated successfully.');
    }

    public function departmentDelete($id)
    {
        $department = Category::where('id', $id)->where('model', 'Departments')->first();
        if (!$department) {
            return redirect()->route('teams.departments.index')->with('error', 'Department not found.');
        }

        $department->delete();

        return redirect()->route('teams.departments.index')->with('success', 'Department deleted successfully.');
    }

    public function commentIndex(Request $request)
    {
        $comments = TeamComment::when($request->search, function ($query) use ($request) {
            $query->where('comment', 'LIKE', '%' . $request->search . '%');
        })->get();

        return view('admin.teams.comments.index', [
            'comments' => $comments,
        ]);
    }

    public function commentCreate()
    {
        $teamMembers = Teams::get();
        return view('admin.teams.comments.create', [
            'teamMembers' => $teamMembers
        ]);
    }

    public function commentStore(Request $request)
    {
        $request->validate([
            'team_member_id' => 'required|exists:teams,id',
            'comment' => 'required|string|max:1000',
        ]);

        $comment = new TeamComment();
        $comment->team_user_id = $request->team_member_id;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route('teams.comments.index')->with('success', 'Comment added successfully.');
    }

    public function commentEdit($id)
    {
        $comment = TeamComment::findOrFail($id);
        $teamMembers = Teams::get();
        return view('admin.teams.comments.edit', [
            'comment' => $comment,
            'teamMembers' => $teamMembers
        ]);
    }

    public function commentUpdate(Request $request, $id)
    {
        $request->validate([
            'team_member_id' => 'required|exists:teams,id',
            'comment' => 'required|string|max:1000',
        ]);

        $comment = TeamComment::findOrFail($id);
        $comment->team_user_id = $request->team_member_id;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route('teams.comments.index')->with('success', 'Comment updated successfully.');
    }

    public function commentDelete($id)
    {
        $comment = TeamComment::findOrFail($id);
        $comment->delete();

        return redirect()->route('teams.comments.index')->with('success', 'Comment deleted successfully.');
    }
}
