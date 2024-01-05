<?php

namespace App\Http\Controllers;

use App\Models\EmpruntMateriel;
use App\Models\Materiel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\After;

class ReservationController extends Controller
{
    function checkQuantite($idMateriel, $quantite_voulu)
    {
        // Récupérer la quantité disponible dans la table Materiel
        $materiel = Materiel::find($idMateriel);

        // Récupérer la quantité totale empruntée pour ce matériel
        $quantite_empruntee = EmpruntMateriel::where('idMateriel', $idMateriel)->sum('quantite');
        $quantite_restante = $materiel->quantite - $quantite_empruntee;

        // Vérifier si la quantité totale empruntée plus la quantité demandée est supérieure à la quantité disponible
        if ($quantite_empruntee + $quantite_voulu > $materiel->quantite) {
            return "Erreur : il ne reste que ".$quantite_restante." ".$materiel->libelle." disponibles.";
        } else {
            $materiel->quantite = $materiel->quantite - $quantite_empruntee;
            $materiel->save();
            return "La quantité demandée est disponible.";
        }
    }

    public function create()
    {
        // Récupérer la liste des utilisateurs et des matériels disponibles
        $users = User::all();
        $materiels = Materiel::all();

        // Afficher la vue de création de réservation avec la liste des utilisateurs et des matériels disponibles
        return view('reservations.create', compact('users', 'materiels'));
    }

    public function store(Request $request)
    {
        $user = User::where('email', auth()->user()->email)->first();
        $materiel = Materiel::where('idMateriel', $request->input('idMateriel'))->first();
        /**if($materiel == null){
            $message = ("Vous devez sélectionner un matériel.");
        }*/
        // Définition des règles de validation
        $rules = [
            'idMateriel' => [
                'required',
                function ($attribute, $value, $fail) use ($materiel) {
                    if ($materiel == null){
                        $fail("Aucun materiel n'a été sélectionné");
                    }
                },
            ],
            'dateDebut' => [
                'required',
                'date',
                function($attribute, $value, $fail) use ($request) {
                    $dateToDay = Carbon::now();
                    $dateDebut = Carbon::createFromFormat('Y-m-d', $value);
                    // empeche la selection d'une date posterieur a la date du jour
                    if ($dateToDay->lt($dateDebut ) -1) {
                        $fail("La date de début doit être postérieure à la date d'aujourd'hui.");
                    }
                },
                ],
            'dateFin' => [
                'required',
                'date',
                Rule::requiredIf(function () use ($request) {
                    return !empty($request->input('dateDebut'));
                }),
                function($attribute, $value, $fail) use ($request) {
                    $dateDebut = Carbon::createFromFormat('Y-m-d', $request->input('dateDebut'));
                    $dateFin = Carbon::createFromFormat('Y-m-d', $value);
                    if ($dateFin->lt($dateDebut)) {
                        $fail('La date de fin doit être postérieure à la date de début.');
                    }
                },
            ],
            'quantite' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($materiel) {
                    if ($materiel == null){
                        $fail("Aucun materiel n'a été sélectionné");
                    }elseif ($value > $materiel->quantite) {
                        $fail('La quantité demandée est supérieure à la quantité disponible (' . $materiel->quantite . ').');
                    }
                },
            ],
        ];

        // Définition des messages d'erreur personnalisés
        $messages = [
            'dateDebut.required' => 'La date de début est obligatoire.',
            'dateDebut.date' => 'La date de début doit être une date valide.',
            'dateFin.required' => 'La date de fin est obligatoire.',
            'dateFin.date' => 'La date de fin doit être une date valide.',
            'dateFin.after' => 'La date de fin doit être supérieure à la date de début.',
            'quantite.required' => 'La quantité est obligatoire.',
            'quantite.integer' => 'La quantité doit être un nombre entier.',
            'quantite.min' => 'La quantité doit être supérieure ou égale à 1.',
        ];

        // Validation des données
        $validatedData = $request->validate($rules, $messages);

        // Créer une nouvelle réservation avec les données validées
        $reservation = new EmpruntMateriel();
        $reservation->idUser = $user->id;
        $reservation->idMateriel = $materiel->idMateriel;
        $reservation->dateDebut = $validatedData['dateDebut'];
        $reservation->dateFin = $validatedData['dateFin'];
        $reservation->quantite = $validatedData['quantite'];

        $message = $this->checkQuantite($reservation->idMateriel, $reservation->quantite);

        if ($message !== "La quantité demandée est disponible.") {
            return redirect()->back()->withInput()->withErrors(['quantite' => $message]);
        }

        $reservation->save();

        // Rediriger l'utilisateur vers la page de liste des réservations avec un message de confirmation
        return redirect()->route('dashboard')->with('success', 'La réservation a été créée avec succès.');
    }


}
