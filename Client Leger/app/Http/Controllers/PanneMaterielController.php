<?php

namespace App\Http\Controllers;

use App\Models\EmpruntMateriel;
use App\Models\Materiel;
use App\Models\Panne;
use App\Models\PanneMateriel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanneMaterielController extends Controller
{
    public function panneMateriel()
    {
        $pannes = PanneMateriel::all();
        return view('panneMateriel.AllpanneMateriel', ['pannes' => $pannes]);
    }

    public function panneUser()
    {
        $pannes = Auth::user()->pannes;
        return view('panneMateriel.panneUser', ['pannes' => $pannes]);
    }

    public function create()
    {
        // Récupérer la liste des utilisateurs et des matériels disponibles
        $users = User::all();
        $materiels = Materiel::all();
        $pannes = Panne::all();
        return view('panneMateriel.create', compact('users', 'materiels', 'pannes'));
    }


    public function store(Request $request)
    {

        // Valider les données de la requête
        $validatedData = $request->validate([
            'idPanne' => 'required|integer',
            'idMateriel' => 'required|integer',
            'infos_supplementaires' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z0-9_.,!?\-()\s]*$/'],
        ], [
            'idPanne.required' => 'Le champ ID Panne est obligatoire.',
            'idMateriel.required' => 'Le champ ID Matériel est obligatoire.',
            'idPanne.integer' => 'Le champ ID Panne doit être un entier.',
            'idMateriel.integer' => 'Le champ ID Matériel doit être un entier.',
            'infos_supplementaires.string' => 'Le champ Infos supplémentaires doit être une chaîne de caractères.',
            'infos_supplementaires.max' => 'Le champ Infos supplémentaires ne doit pas dépasser 255 caractères.',
            'infos_supplementaires.regex' => 'Le champ Infos supplémentaires contient des caractères non autorisés.',
        ]);

        // Créer une nouvelle réservation avec les données validées
        $newPanne = new PanneMateriel();
        $panne = Panne::where('idPanne', $request->input('idPanne'))->first();
        $newPanne->idPanne = $panne->idPanne;
        $newPanne->idMateriel = $request->input('idMateriel');
        $user = User::where('email', auth()->user()->email)->first();
        $newPanne->idUser = $user->id;
        $newPanne->infos_supplementaires = $validatedData['infos_supplementaires'];
        $newPanne->save();




        $empruntMateriel = EmpruntMateriel::where('idMateriel', $request->input('idMateriel'))
            ->where('idUser', $user->id)
            ->where('dateDebut', $request->input('dateDebut'))
            ->first();


        if ($empruntMateriel->quantite > 1) {
            // sauvegarder l'emprunt modifié

            $empruntMateriel->quantite -= 1;
            $empruntMateriel->save();
        }else {
            $empruntMateriel->delete();
        }



        $Materiel = Materiel::where('idMateriel', $request->input('idMateriel'))
            ->first();
        // modifier la quantité
        $Materiel->quantite = $Materiel->quantite - 1;

        // sauvegarder l'emprunt modifié
        $Materiel->save();

        // Rediriger l'utilisateur vers la page de liste des réservations avec un message de confirmation
        return redirect()->route('stock');
    }

    public function reparer($idPanne, $idMateriel, $date)
    {

        $Materiel = Materiel::where('idMateriel', $idMateriel)
            ->first();
        $Materiel->quantite = $Materiel->quantite + 1;

        $Materiel->save();

        $PanneMateriel = PanneMateriel::where('idPanne', $idPanne)
            ->where('idMateriel', $idMateriel)
            ->where('created_at', $date)
            ->first();
        $PanneMateriel->delete();

        return redirect()->route('panneMateriel');
    }

    public function supprimer($idPanne, $idMateriel, $date)
    {

        $PanneMateriel = PanneMateriel::where('idPanne', $idPanne)
            ->where('idMateriel', $idMateriel)
            ->where('created_at', $date)
            ->first();
        $PanneMateriel->delete();

        return redirect()->route('panneMateriel');
    }

}
