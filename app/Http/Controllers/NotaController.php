<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function index()
    {
        return Nota::all();
    }

    public function store(Request $request)
    {
        return Nota::create($request->all());
    }

    public function show(Nota $nota)
    {
        return $nota;
    }

    public function update(Request $request, Nota $nota)
    {
        $nota->update($request->all());

        return $nota;
    }

    public function destroy(Nota $nota)
    {
        $nota->delete();

        return response()->json(null, 204);
    }
}
