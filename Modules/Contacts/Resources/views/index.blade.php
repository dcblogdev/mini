@extends('layouts.app')

@section('content')

    <div class="card">
    <h1>Contacts</h1>

    <p><a class="btn-blue" href="{{ route('app.contacts.create') }}">Add Contact</a> </p>

    <table>
        <thead>
        <tr>
            <td>Name</td>
            <td>Email</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>
                    <a href="{{ route('app.contacts.edit', $contact->id) }}">Edit</a>

                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</a>
                    <x-form id="delete-form" method="delete" action="{{ route('app.contacts.delete', $contact->id) }}" />
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection
