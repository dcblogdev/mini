@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Edit Contact</h1>

        <x-form action="{{ route('app.contacts.update', $contact->id) }}" method="patch">
            <x-form.input name="name">{{ $contact->name }}</x-form.input>
            <x-form.input name="email">{{ $contact->email }}</x-form.input>
            <x-form.button>Update</x-form.button>
        </x-form>
    </div>
@endsection
