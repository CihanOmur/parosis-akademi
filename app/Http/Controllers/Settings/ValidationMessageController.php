<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ValidationMessageController extends Controller
{
    public function index()
    {
        $modules = ValidationMessageService::getModules();

        // Her form için mevcut mesajları (default + DB override) hazırla
        $formMessages = [];
        $formDefaults = [];
        foreach ($modules as $moduleKey => $module) {
            foreach ($module['forms'] as $formKey => $form) {
                $defaults = ValidationMessageService::generateFormMessages($form);
                $overrides = Setting::getGroup("vm_{$formKey}");
                $formDefaults[$formKey] = $defaults;
                $formMessages[$formKey] = array_merge($defaults, $overrides);
            }
        }

        $activeModule = request('module', array_key_first($modules));
        $activeForm = request('form', '');

        return view('admin.settings.validation-messages', compact(
            'modules', 'formMessages', 'formDefaults', 'activeModule', 'activeForm'
        ));
    }

    public function updateForm(Request $request, string $formKey)
    {
        $form = ValidationMessageService::getForm($formKey);
        if (!$form) {
            abort(404);
        }

        $messages = $request->input('messages', []);
        $defaults = ValidationMessageService::generateFormMessages($form);

        // Sadece default'tan farklı olanları kaydet
        $overrides = [];
        foreach ($messages as $key => $value) {
            $value = trim($value);
            if ($value !== '' && (!isset($defaults[$key]) || $defaults[$key] !== $value)) {
                $overrides[$key] = $value;
            }
        }

        // Eski override'ları temizle
        Setting::where('group', "vm_{$formKey}")->delete();
        Cache::forget("settings.group.vm_{$formKey}");

        // Yeni override'ları kaydet
        if (!empty($overrides)) {
            Setting::saveGroup("vm_{$formKey}", $overrides);
        }

        // Modül key'ini bul
        $moduleKey = '';
        foreach (ValidationMessageService::getModules() as $mk => $module) {
            if (isset($module['forms'][$formKey])) {
                $moduleKey = $mk;
                break;
            }
        }

        return redirect()->route('settings.validationMessages.index', [
            'module' => $moduleKey,
            'form' => $formKey,
        ])->with('success', "'{$form['label']}' mesajları kaydedildi.");
    }

    public function resetForm(string $formKey)
    {
        $form = ValidationMessageService::getForm($formKey);
        if (!$form) {
            abort(404);
        }

        Setting::where('group', "vm_{$formKey}")->delete();
        Cache::forget("settings.group.vm_{$formKey}");

        $moduleKey = '';
        foreach (ValidationMessageService::getModules() as $mk => $module) {
            if (isset($module['forms'][$formKey])) {
                $moduleKey = $mk;
                break;
            }
        }

        return redirect()->route('settings.validationMessages.index', [
            'module' => $moduleKey,
            'form' => $formKey,
        ])->with('success', "'{$form['label']}' mesajları varsayılanlara sıfırlandı.");
    }
}
