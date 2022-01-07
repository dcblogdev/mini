@extends('layouts.app')

@section('content')
<div class="card">
    <h1>Serials</h1>

    <p><a class="btn btn-blue" href="{{ route('app.serials.create') }}">Add Serial</a></p>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($serials as $row)
            <tr>
                <td>{{ $row->name }}</td>
                <td>
                    <a href="{{ route('app.serials.edit', $row->id) }}">Edit</a>

                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</a>
                    <x-form id="delete-form" method="delete" action="{{ route('app.serials.delete', $row->id) }}" />
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $serials->links() }}
</div>
@endsection
