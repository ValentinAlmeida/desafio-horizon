<?php

namespace App\Http\Controllers;

use App\Models\Bateria;
use Illuminate\Http\Request;

class BateriaController extends Controller
{
    public function index()
    {
        return Bateria::all();
    }

    public function store(Request $request)
    {
        return Bateria::create($request->all());
    }

    public function show(Bateria $bateria)
    {
        return $bateria;
    }

    public function update(Request $request, Bateria $bateria)
    {
        $bateria->update($request->all());

        return $bateria;
    }

    public function destroy(Bateria $bateria)
    {
        $bateria->delete();

        return response()->json(null, 204);
    }
}
