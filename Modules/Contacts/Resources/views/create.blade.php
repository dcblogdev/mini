@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Add Contact</h1>

        <x-form action="{{ route('app.contacts.create') }}">
            <x-form.input name="name" />
            <x-form.input name="email" />
            <x-form.button>Submit</x-form.button>
        </x-form>
    </div>
@endsection
