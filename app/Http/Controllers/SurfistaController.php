<?php

namespace App\Http\Controllers;

use App\Models\Surfista;
use Illuminate\Http\Request;

class SurfistaController extends Controller
{
    public function index()
    {
        return Surfista::all();
    }

    public function store(Request $request)
    {
        return Surfista::create($request->all());
    }

    public function show(Surfista $surfista)
    {
        return $surfista;
    }

    public function update(Request $request, Surfista $surfista)
    {
        $surfista->update($request->all());

        return $surfista;
    }

    public function destroy(Surfista $surfista)
    {
        $surfista->delete();

        return response()->json(null, 204);
    }
}
