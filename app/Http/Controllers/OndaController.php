<?php

namespace App\Http\Controllers;

use App\Models\Onda;
use Illuminate\Http\Request;

class OndaController extends Controller
{
    public function index()
    {
        return Onda::all();
    }

    public function store(Request $request)
    {
        return Onda::create($request->all());
    }

    public function show(Onda $onda)
    {
        return $onda;
    }

    public function update(Request $request, Onda $onda)
    {
        $onda->update($request->all());

        return $onda;
    }

    public function destroy(Onda $onda)
    {
        $onda->delete();

        return response()->json(null, 204);
    }
}
