<?php

namespace App\Http\Controllers;

use App\Models\EmpruntMateriel;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpruntMaterielController extends Controller
{
    public function stock()
    {
        $emprunts = Auth::user()->emprunts;
        return view('stock', ['emprunts' => $emprunts]);
    }

    public function create()
    {
        $materiels = Materiel::all();
        return view('reservation', compact('materiels'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idMateriel' => 'required',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after:dateDebut',
            'quantite' => 'required',
        ]);
        $empruntMateriel = new EmpruntMateriel;
        $empruntMateriel->idMateriel = $validatedData['idMateriel'];
        $empruntMateriel->dateDebut = $validatedData['dateDebut'];
        $empruntMateriel->dateFin = $validatedData['dateFin'];
        $empruntMateriel->quantite = $validatedData['quantite'];
        $empruntMateriel->save();
        return redirect()->route('confirmation')->with('success', 'Réservation enregistrée avec succès');
    }

    public function rendu($libelle, $dateDebut, $dateFin)
    {
        $materiel = Materiel::where('libelle', $libelle)->firstOrFail();
        $empruntMateriel = EmpruntMateriel::where('idMateriel', $materiel->idMateriel)
            ->where('dateDebut', $dateDebut)
            ->where('dateFin', $dateFin)
            ->firstOrFail();

        $materiel->quantite = $materiel->quantite + $empruntMateriel->quantite;

        $empruntMateriel->delete();


        return redirect()->route('stock');
    }
}
