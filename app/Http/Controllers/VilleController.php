<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;


class VilleController extends Controller
{
    public function ville(Request $request, $nom = null)
    {
        $nom = $nom ?? $request->query('ville');
        $villes = Ville::where('ville_nom', 'LIKE', "{$nom}%")->get();
        return response()->json($villes);
    }

    public function departement(Request $request, $dep = null)
    {
        $dep = $dep ?? $request->query('departement');
        $villes = Ville::where('ville_departement', $dep)->get();
        return response()->json($villes);
    }

    public function code(Request $request, $code = null)
    {
        $code = $code ?? $request->query('code');
        $villes = Ville::where('ville_code_postal', $code)->get();
        return response()->json($villes);
    }
public function autocomplete(Request $request)
{
    $term = $request->get('term');
    if (!$term) return response()->json([]);

    $villes = \App\Models\Ville::where('ville_nom', 'LIKE', "{$term}%")
        ->orderBy('ville_nom')
        ->limit(10)
        ->pluck('ville_nom'); 

    return response()->json($villes);
}


}
