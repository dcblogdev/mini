@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Edit Serial</h1>

        @include('errors.errors')

        <x-form action="{{ route('app.serials.update', $serial->id) }}" method="patch">
            <x-form.input name="name">{{ $serial->name }}</x-form.input>
            <x-form.textarea name="serial" rows="10">{{ $serial->serial }}</x-form.textarea>
            <x-form.textarea name="notes" rows="10">{{ $serial->notes }}</x-form.textarea>
            <x-form.button>Submit</x-form.button>
        </x-form>
    </div>
@endsection
