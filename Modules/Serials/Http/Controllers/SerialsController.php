<?php

namespace Modules\Serials\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Serials\Models\Serial;

class SerialsController extends Controller
{
    public function index()
    {
        $serials = Serial::paginate();

        return view('serials::index', compact('serials'));
    }

    public function create()
    {
        return view('serials::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'serial' => 'string',
            'notes' => 'string'
        ]);

        Serial::create([
           'name' => $request->input('name'),
           'serial' => $request->input('serial'),
           'notes' => $request->input('notes'),
        ]);

        flash('Serial added')->success();

        return redirect(route('app.serials.index'));
    }

    public function edit($id)
    {
        $serial = Serial::findOrFail($id);

        return view('serials::edit', compact('serial'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Serial::findOrFail($id)->update([
            'name' => $request->input('name'),
            'serial' => $request->input('serial'),
            'notes' => $request->input('notes'),
        ]);

        flash('Serial updated')->success();

        return redirect(route('app.serials.index'));
    }

    public function destroy($id)
    {
        Serial::findOrFail($id)->delete();

        return redirect(route('app.serials.index'));
    }
}