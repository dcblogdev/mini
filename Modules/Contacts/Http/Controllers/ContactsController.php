<?php

namespace Modules\Contacts\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Contacts\Models\Contact;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::get();

        return view('contacts::index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        Contact::create([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        return redirect(route('app.contacts.index'));
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);

        return view('contacts::edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        Contact::findOrFail($id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect(route('app.contacts.index'));
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();

        return redirect(route('app.contacts.index'));
    }
}
