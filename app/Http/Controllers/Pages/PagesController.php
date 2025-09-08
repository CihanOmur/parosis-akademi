<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Faq\Faq;
use App\Models\Pages\AboutUs\AboutUsPageGallery;
use App\Models\Pages\AboutUs\AboutUsPageInfo;
use App\Models\Pages\Contact\ContactPageInfo;
use App\Models\Pages\Pages;
use App\Models\Pages\Projects\ProjectsPageInfo;
use App\Models\Pages\References\ReferencesPageInfo;
use App\Models\Pages\Services\ServicesPageInfo;
use App\Models\Pages\Teams\TeamsPageComments;
use App\Models\Pages\Teams\TeamsPageGallery;
use App\Models\Pages\Teams\TeamsPageInfo;
use App\Models\References\References;
use App\Models\Teams\TeamComment;
use App\Models\Teams\Teams;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function index()
    {

        return view('admin.pages.index');
    }

    public function editTranslate($id)
    {
        if ($id == 'teams') {
            $teamsPageInfo = TeamsPageInfo::firstOrCreate();
            return view('admin.pages.edit-teams-translate', [
                'teamsPageInfo' => $teamsPageInfo,
            ]);
        } elseif ($id == 'contact') {
            $contactPageInfo = ContactPageInfo::firstOrCreate();
            return view('admin.pages.edit-contact-translate', [
                'contactPageInfo' => $contactPageInfo,
            ]);
        } elseif ($id == 'projects') {
            $projectPageInfo = ProjectsPageInfo::firstOrCreate();
            return view('admin.pages.edit-projects-translate', [
                'projectPageInfo' => $projectPageInfo,
            ]);
        } elseif ($id == 'references') {
            $referencesPageInfo = ReferencesPageInfo::firstOrCreate();
            return view('admin.pages.edit-references-translate', [
                'referencesPageInfo' => $referencesPageInfo,
            ]);
        } elseif ($id == 'services') {
            $servicesPageInfo = ServicesPageInfo::firstOrCreate();
            return view('admin.pages.edit-services-translate', [
                'servicesPageInfo' => $servicesPageInfo,
            ]);
        } elseif ($id == 'about-us') {
            $aboutUsPageInfo = AboutUsPageInfo::firstOrCreate();
            return view('admin.pages.edit-about-us-translate', [
                'aboutUsPageInfo' => $aboutUsPageInfo,
            ]);
        }
    }

    public function updateTranslate(Request $request, $id)
    {
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();



        if ($id == 'teams') {
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'content' => 'nullable|string',
                'comment_title' => 'nullable|string|max:255',
                'gallery_title' => 'nullable|string|max:255',
                'gallery_subtitle' => 'nullable|string|max:255',
            ]);


            $teamsPageInfo = TeamsPageInfo::firstOrCreate();

            $teamsPageInfo->setTranslation('title', $translateLang, $request->input('title'));
            $teamsPageInfo->setTranslation('subtitle', $translateLang, $request->input('subtitle'));
            $teamsPageInfo->setTranslation('description', $translateLang, $request->input('content'));
            $teamsPageInfo->setTranslation('comment_title', $translateLang, $request->input('comment_title'));
            $teamsPageInfo->setTranslation('gallery_title', $translateLang, $request->input('gallery_title'));
            $teamsPageInfo->setTranslation('gallery_subtitle', $translateLang, $request->input('gallery_subtitle'));
            $teamsPageInfo->save();

            return redirect()->back()->with('success', 'Teams page updated successfully.');
        } elseif ($id == 'contact') {
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'content' => 'required|string|max:1000',
                'form_title' => 'required|string|max:255',
                'form_description' => 'required|string|max:1000',
            ]);

            $contactPageInfo = ContactPageInfo::firstOrCreate();
            $contactPageInfo->setTranslation('title', $translateLang, $request->input('title'));
            $contactPageInfo->setTranslation('subtitle', $translateLang, $request->input('subtitle'));
            $contactPageInfo->setTranslation('description', $translateLang, $request->input('content'));
            $contactPageInfo->setTranslation('form_title', $translateLang, $request->input('form_title'));
            $contactPageInfo->setTranslation('form_description', $translateLang, $request->input('form_description'));
            $contactPageInfo->save();

            return redirect()->back()->with('success', 'Contact page updated successfully.');
        } elseif ($id == 'projects') {
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'content' => 'required|string|max:1000',
                'reference_title' => 'required|string|max:255',
            ]);

            $projectPageInfo = ProjectsPageInfo::firstOrCreate();
            $projectPageInfo->setTranslation('title', $translateLang, $request->input('title'));
            $projectPageInfo->setTranslation('subtitle', $translateLang, $request->input('subtitle'));
            $projectPageInfo->setTranslation('description', $translateLang, $request->input('content'));
            $projectPageInfo->setTranslation('references_title', $translateLang, $request->input('reference_title'));
            $projectPageInfo->save();
        } elseif ($id == 'references') {
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'content' => 'required|string|max:1000',
                'contact_title' => 'required|string|max:255',
                'contact_button_title' => 'required|string|max:255',
                'contact_button_link' => 'required|string|max:255',
            ]);

            $referencesPageInfo = ReferencesPageInfo::firstOrCreate();
            $referencesPageInfo->setTranslation('title', $translateLang, $request->input('title'));
            $referencesPageInfo->setTranslation('subtitle', $translateLang, $request->input('subtitle'));
            $referencesPageInfo->setTranslation('description', $translateLang, $request->input('content'));
            $referencesPageInfo->setTranslation('contact_title', $translateLang, $request->input('contact_title'));
            $referencesPageInfo->setTranslation('contact_button_title', $translateLang, $request->input('contact_button_title'));
            $referencesPageInfo->setTranslation('contact_button_link', $translateLang, $request->input('contact_button_link'));
            $referencesPageInfo->save();
        } elseif ($id == 'services') {

            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'content' => 'nullable|string',
                'info_title' => 'nullable|string|max:255',
                'info_subtitle' => 'nullable|string|max:255',
                'info_content' => 'nullable|string',
                'info_skil_column_1' => 'nullable|string|max:255',
                'info_skil_column_2' => 'nullable|string|max:255',
                'info_skil_column_3' => 'nullable|string|max:255',
                'faq_title' => 'nullable|string|max:255',
            ]);


            $servicePageInfo = ServicesPageInfo::firstOrCreate();
            $servicePageInfo->setTranslation('title', $translateLang, $request->input('title'));
            $servicePageInfo->setTranslation('subtitle', $translateLang, $request->input('subtitle'));
            $servicePageInfo->setTranslation('description', $translateLang, $request->input('content'));
            $servicePageInfo->setTranslation('info_title', $translateLang, $request->input('info_title'));
            $servicePageInfo->setTranslation('info_subtitle', $translateLang, $request->input('info_subtitle'));
            $servicePageInfo->setTranslation('info_description', $translateLang, $request->input('info_description'));
            $servicePageInfo->setTranslation('info_skil_column_1', $translateLang, $request->input('info_skil_column_1'));
            $servicePageInfo->setTranslation('info_skil_column_2', $translateLang, $request->input('info_skil_column_2'));
            $servicePageInfo->setTranslation('info_skil_column_3', $translateLang, $request->input('info_skil_column_3'));
            $servicePageInfo->setTranslation('faq_title', $translateLang, $request->input('faq_title'));
            $servicePageInfo->save();
        } elseif ($id == 'about-us') {

            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'description' => 'nullable|string',

                'mision_title' => 'nullable|string|max:255',
                'mision_description_1' => 'nullable|string',
                'mision_description_2' => 'nullable|string',

                'gallery_title' => 'nullable|string|max:255',
                'gallery_subtitle' => 'nullable|string|max:255',

                'reference_title' => 'nullable|string|max:255',
            ]);
            $aboutUsPageInfo = AboutUsPageInfo::firstOrCreate();
            $aboutUsPageInfo->setTranslation('title', $translateLang, $request->input('title'));
            $aboutUsPageInfo->setTranslation('subtitle', $translateLang, $request->input('subtitle'));
            $aboutUsPageInfo->setTranslation('description', $translateLang, $request->input('description'));
            $aboutUsPageInfo->setTranslation('mision_title', $translateLang, $request->input('mision_title'));
            $aboutUsPageInfo->setTranslation('mision_description_1', $translateLang, $request->input('mision_description_1'));
            $aboutUsPageInfo->setTranslation('mision_description_2', $translateLang, $request->input('mision_description_2'));
            $aboutUsPageInfo->setTranslation('gallery_title', $translateLang, $request->input('gallery_title'));
            $aboutUsPageInfo->setTranslation('gallery_subtitle', $translateLang, $request->input('gallery_subtitle'));
            $aboutUsPageInfo->setTranslation('references_title', $translateLang, $request->input('references_title'));
            $aboutUsPageInfo->save();
        }
        return redirect()->back()->with('success', 'Page updated successfully.');
    }
    public function edit($id)
    {
        if ($id == 'teams') {
            $teamsPageInfo = TeamsPageInfo::firstOrCreate();
            $teamsPageGallery = TeamsPageGallery::get();
            $teamsPageComments = TeamComment::get();
            return view('admin.pages.edit-teams', [
                'teamsPageInfo' => $teamsPageInfo,
                'teamsPageGallery' => $teamsPageGallery,
                'teamsPageComments' => $teamsPageComments,
            ]);
        } elseif ($id == 'contact') {
            $contactPageInfo = ContactPageInfo::firstOrCreate();
            return view('admin.pages.edit-contact', [
                'contactPageInfo' => $contactPageInfo,
            ]);
        } elseif ($id == 'projects') {
            $projectPageInfo = ProjectsPageInfo::firstOrCreate();
            $references = References::get();
            return view('admin.pages.edit-projects', [
                'projectPageInfo' => $projectPageInfo,
                'references' => $references,
            ]);
        } elseif ($id == 'references') {
            $referencesPageInfo = ReferencesPageInfo::firstOrCreate();
            return view('admin.pages.edit-references', [
                'referencesPageInfo' => $referencesPageInfo,
            ]);
        } elseif ($id == 'services') {
            $servicesPageInfo = ServicesPageInfo::firstOrCreate();
            $faqs = Faq::get();
            return view('admin.pages.edit-services', [
                'servicesPageInfo' => $servicesPageInfo,
                'faqs' => $faqs
            ]);
        } elseif ($id == 'about-us') {
            $aboutUsPageInfo = AboutUsPageInfo::firstOrCreate();
            $references = References::get();
            $aboutUsPageGallery = TeamsPageGallery::get();
            return view('admin.pages.edit-about-us', [
                'aboutUsPageInfo' => $aboutUsPageInfo,
                'aboutUsPageGallery' => $aboutUsPageGallery,
                'references' => $references
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();



        if ($id == 'teams') {
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'content' => 'nullable|string',
                'comment_title' => 'nullable|string|max:255',
                'gallery_title' => 'nullable|string|max:255',
                'gallery_subtitle' => 'nullable|string|max:255',
                'comments' => 'array',
                'comments.*' => 'integer|exists:team_comments,id',
                'gallery_items' => 'array',
            ]);


            $teamsPageInfo = TeamsPageInfo::firstOrCreate();

            $teamsPageInfo->setTranslation('title', $translateLang, $request->input('title'));
            $teamsPageInfo->setTranslation('subtitle', $translateLang, $request->input('subtitle'));
            $teamsPageInfo->setTranslation('description', $translateLang, $request->input('content'));
            $teamsPageInfo->setTranslation('comment_title', $translateLang, $request->input('comment_title'));
            $teamsPageInfo->setTranslation('gallery_title', $translateLang, $request->input('gallery_title'));
            $teamsPageInfo->setTranslation('gallery_subtitle', $translateLang, $request->input('gallery_subtitle'));
            $teamsPageInfo->comments_ids = $request->input('comments', []);
            $teamsPageInfo->save();

            if ($request->has('gallery_items')) {
                $teamsPageOldGalleryItemsTitles = TeamsPageGallery::pluck('file_url')->toArray();
                $teamsPageNewGalleryItemsTitles = collect($request->gallery_items)->pluck('uploaded_file')->toArray();
                $galleryItemsToDelete = array_diff($teamsPageOldGalleryItemsTitles, $teamsPageNewGalleryItemsTitles);
                TeamsPageGallery::whereIn('file_url', $galleryItemsToDelete)
                    ->delete();
                foreach ($request->gallery_items as $gallery) {
                    if (isset($gallery['file']) && $gallery['file'] != '') {
                        $mimeType = $gallery['file']->getMimeType();

                        if (str_starts_with($mimeType, 'image/')) {
                            $type = true; // resim dosyası
                        } elseif (str_starts_with($mimeType, 'video/')) {
                            $type = false; // video dosyası
                        } else {
                            $type = true;
                        }

                        $galleryItem = new TeamsPageGallery();
                        $galleryItem->title = $gallery['title'];
                        $galleryItem->file_url = $gallery['uploaded_file'];
                        $galleryItem->is_image = $type;
                        $galleryItem->save();
                    }
                }
            }
            return redirect()->back()->with('success', 'Teams page updated successfully.');
        } elseif ($id == 'contact') {
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'content' => 'required|string|max:1000',
                'form_title' => 'required|string|max:255',
                'form_description' => 'required|string|max:1000',
            ]);

            $contactPageInfo = ContactPageInfo::firstOrCreate();
            $contactPageInfo->setTranslation('title', $translateLang, $request->input('title'));
            $contactPageInfo->setTranslation('subtitle', $translateLang, $request->input('subtitle'));
            $contactPageInfo->setTranslation('description', $translateLang, $request->input('content'));
            $contactPageInfo->setTranslation('form_title', $translateLang, $request->input('form_title'));
            $contactPageInfo->setTranslation('form_description', $translateLang, $request->input('form_description'));
            $contactPageInfo->save();

            return redirect()->back()->with('success', 'Contact page updated successfully.');
        } elseif ($id == 'projects') {
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'content' => 'required|string|max:1000',
                'reference_title' => 'required|string|max:255',
                'references' => 'array',
                'references.*' => 'required|integer|exists:references,id',
            ]);

            $projectPageInfo = ProjectsPageInfo::firstOrCreate();
            $projectPageInfo->setTranslation('title', $translateLang, $request->input('title'));
            $projectPageInfo->setTranslation('subtitle', $translateLang, $request->input('subtitle'));
            $projectPageInfo->setTranslation('description', $translateLang, $request->input('content'));
            $projectPageInfo->setTranslation('references_title', $translateLang, $request->input('reference_title'));
            $projectPageInfo->references_ids = $request->input('references');
            $projectPageInfo->save();
        } elseif ($id == 'references') {
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'content' => 'required|string|max:1000',
                'contact_title' => 'required|string|max:255',
                'contact_button_title' => 'required|string|max:255',
                'contact_button_link' => 'required|string|max:255',
            ]);

            $referencesPageInfo = ReferencesPageInfo::firstOrCreate();
            $referencesPageInfo->setTranslation('title', $translateLang, $request->input('title'));
            $referencesPageInfo->setTranslation('subtitle', $translateLang, $request->input('subtitle'));
            $referencesPageInfo->setTranslation('description', $translateLang, $request->input('content'));
            $referencesPageInfo->setTranslation('contact_title', $translateLang, $request->input('contact_title'));
            $referencesPageInfo->setTranslation('contact_button_title', $translateLang, $request->input('contact_button_title'));
            $referencesPageInfo->setTranslation('contact_button_link', $translateLang, $request->input('contact_button_link'));
            $referencesPageInfo->save();
        } elseif ($id == 'services') {

            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'content' => 'nullable|string',
                'info_title' => 'nullable|string|max:255',
                'info_subtitle' => 'nullable|string|max:255',
                'info_content' => 'nullable|string',
                'info_skil_column_1' => 'nullable|string|max:255',
                'info_skil_column_2' => 'nullable|string|max:255',
                'info_skil_column_3' => 'nullable|string|max:255',
                'file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'faq_title' => 'nullable|string|max:255',
                'faqs' => 'array',
                'faqs.*' => 'integer|exists:faqs,id',
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('pages', $filename, 'public');
            }

            $servicePageInfo = ServicesPageInfo::firstOrCreate();
            $servicePageInfo->setTranslation('title', $translateLang, $request->input('title'));
            $servicePageInfo->setTranslation('subtitle', $translateLang, $request->input('subtitle'));
            $servicePageInfo->setTranslation('description', $translateLang, $request->input('content'));
            $servicePageInfo->setTranslation('info_title', $translateLang, $request->input('info_title'));
            $servicePageInfo->setTranslation('info_subtitle', $translateLang, $request->input('info_subtitle'));
            $servicePageInfo->setTranslation('info_description', $translateLang, $request->input('info_description'));
            $servicePageInfo->setTranslation('info_skil_column_1', $translateLang, $request->input('info_skil_column_1'));
            $servicePageInfo->setTranslation('info_skil_column_2', $translateLang, $request->input('info_skil_column_2'));
            $servicePageInfo->setTranslation('info_skil_column_3', $translateLang, $request->input('info_skil_column_3'));
            $servicePageInfo->setTranslation('faq_title', $translateLang, $request->input('faq_title'));
            $servicePageInfo->info_image_url = $filename ?? null;
            $servicePageInfo->faq_ids = $request->input('faqs');
            $servicePageInfo->save();
        } elseif ($id == 'about-us') {

            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'description' => 'nullable|string',

                'mision_title' => 'nullable|string|max:255',
                'mision_description_1' => 'nullable|string',
                'mision_description_2' => 'nullable|string',

                'gallery_title' => 'nullable|string|max:255',
                'gallery_subtitle' => 'nullable|string|max:255',
                'gallery_items' => 'array',

                'reference_title' => 'nullable|string|max:255',
                'references' => 'array',
                'references.*' => 'integer|exists:references,id',
            ]);
            $aboutUsPageInfo = AboutUsPageInfo::firstOrCreate();
            $aboutUsPageInfo->setTranslation('title', $translateLang, $request->input('title'));
            $aboutUsPageInfo->setTranslation('subtitle', $translateLang, $request->input('subtitle'));
            $aboutUsPageInfo->setTranslation('description', $translateLang, $request->input('description'));
            $aboutUsPageInfo->setTranslation('mision_title', $translateLang, $request->input('mision_title'));
            $aboutUsPageInfo->setTranslation('mision_description_1', $translateLang, $request->input('mision_description_1'));
            $aboutUsPageInfo->setTranslation('mision_description_2', $translateLang, $request->input('mision_description_2'));
            $aboutUsPageInfo->setTranslation('gallery_title', $translateLang, $request->input('gallery_title'));
            $aboutUsPageInfo->setTranslation('gallery_subtitle', $translateLang, $request->input('gallery_subtitle'));
            $aboutUsPageInfo->setTranslation('references_title', $translateLang, $request->input('references_title'));
            $aboutUsPageInfo->references_ids = $request->input('references', []);
            $aboutUsPageInfo->save();

            if ($request->has('gallery_items')) {
                $aboutUsPageOldGalleryItemsTitles = AboutUsPageGallery::pluck('file_url')->toArray();
                $aboutUsPageNewGalleryItemsTitles = collect($request->gallery_items)->pluck('uploaded_file')->toArray();
                $galleryItemsToDelete = array_diff($aboutUsPageOldGalleryItemsTitles, $aboutUsPageNewGalleryItemsTitles);
                AboutUsPageGallery::whereIn('file_url', $galleryItemsToDelete)
                    ->delete();
                foreach ($request->gallery_items as $gallery) {
                    if (isset($gallery['file']) && $gallery['file'] != '') {
                        $mimeType = $gallery['file']->getMimeType();

                        if (str_starts_with($mimeType, 'image/')) {
                            $type = true; // resim dosyası
                        } elseif (str_starts_with($mimeType, 'video/')) {
                            $type = false; // video dosyası
                        } else {
                            $type = true;
                        }

                        $galleryItem = new AboutUsPageGallery();
                        $galleryItem->title = $gallery['title'];
                        $galleryItem->file_url = $gallery['uploaded_file'];
                        $galleryItem->is_image = $type;
                        $galleryItem->save();
                    }
                }
            }
        }
        return redirect()->back()->with('success', 'Page updated successfully.');
    }

    public function uploadGallery(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,gif,webp,mp4,webm,mov|max:51200', // 50 MB max
        ]);

        $file = $request->file('file');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('pages', $filename, 'public');

        return response()->json(['file_name' => $filename]);
    }
}
