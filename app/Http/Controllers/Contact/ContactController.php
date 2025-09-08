<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first();
        if (!$contact) {
            $contact = new Contact();
            $contact->maps_section = null;
            $contact->phone_title = null;
            $contact->email_title = null;
            $contact->save();
        }

        return view('admin.contact.create', [
            'contact' => $contact,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'maps_url' => 'required|string|max:255',
            'phone_title' => 'required|string|max:255',
            'email_title' => 'required|string|max:255',

            'addresses' => 'required|array',
            'addresses.*.title' => 'required|string|max:255',
            'addresses.*.address' => 'required|string|max:255',

            'phone_numbers' => 'required|array',
            'phone_numbers.*.phone' => 'required|string|max:15',

            'email_addresses' => 'required|array',
            'email_addresses.*.email' => 'required|email|max:255',
        ]);

        $contact = Contact::first();
        if (!$contact) {
            $contact = new Contact();
            $contact->maps_section = null;
            $contact->phone_title = null;
            $contact->email_title = null;
            $contact->save();
        }

        $contact->maps_section = $request->input('maps_url');
        $contact->phone_title = $request->input('phone_title');
        $contact->email_title = $request->input('email_title');
        $contact->save();
        $contact->addresses()->delete();
        $contact->phones()->delete();
        $contact->mails()->delete();
        if ($request->has('addresses')) {
            foreach ($request->input('addresses') as $address) {
                $contact->addresses()->create([
                    'title' => $address['title'],
                    'address' => $address['address'],
                ]);
            }
        }
        if ($request->has('phone_numbers')) {
            foreach ($request->input('phone_numbers') as $phone) {
                $contact->phones()->create([
                    'phone' => $phone['phone'],
                ]);
            }
        }
        if ($request->has('email_addresses')) {
            foreach ($request->input('email_addresses') as $mail) {
                $contact->mails()->create([
                    'email' => $mail['email'],
                ]);
            }
        }

        return redirect()->route('contacts.index')->with('success', 'İletişim bilgileri başarıyla kaydedildi.');
    }
}
