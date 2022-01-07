@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Create Serial</h1>

        @include('errors.errors')

        <x-form action="{{ route('app.serials.store') }}">
            <x-form.input name="name" />
            <x-form.textarea name="serial" rows="10" />
            <x-form.textarea name="notes" rows="10" />
            <x-form.button>Submit</x-form.button>
        </x-form>
    </div>
@endsection
