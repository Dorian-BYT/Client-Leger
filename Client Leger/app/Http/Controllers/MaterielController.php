<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    public function show($id){

        $materiel = Materiel::find($id);
        return view('materiel.materiel', ['materiel'=>$materiel]);
    }

    public function showAll(){
        $materiels = Materiel::all();
        return view('materiel.materielAll', ['materiels'=>$materiels]);
    }

    public function pannes()
    {
        return $this->belongsToMany(Panne::class, 'PanneMateriel', 'idMateriel', 'idPanne')
            ->withPivot(['dateDebut', 'dateFin']);
    }

    public function destroy($id)
    {
        $materiel = Materiel::findOrFail($id);
        $materiel->delete();
        return redirect()->route('lesMateriels');
    }

    public function edit($id)
    {
        $materiel = Materiel::findOrFail($id);

        return view('materiel.update', compact('materiel'));
    }

    public function update(Request $request, $id)
    {
        // Récupération de l'objet Materiel correspondant à l'id
        $materiel = Materiel::findOrFail($id);

        // Définition des règles de validation
        $rules = [
            'libelle' => [
                'string',
                'max:100',
                'regex:/^[a-zA-Z0-9_.,!?\-()\s]*$/'
            ],

            'description' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9_.,!?\-()\s]*$/'
            ],

            'quantite' => [
                'required',
                'integer',
                'min:1',
            ],
        ];

        // Définition des messages d'erreur personnalisés
        $messages = [
            'description.string' => 'Le champ description doit être une chaîne de caractères.',
            'description.max' => 'Le champ description ne doit pas dépasser 255 caractères.',
            'description.regex' => 'Le champ description contient des caractères non autorisés.',
            'quantite.required' => 'La quantité est obligatoire.',
            'quantite.integer' => 'La quantité doit être un nombre entier.',
            'quantite.min' => 'La quantité doit être supérieure ou égale à 1.',
        ];

        // Validation des données
        $validatedData = $request->validate($rules, $messages);

        $materiel->libelle = $validatedData['libelle'];
        $materiel->description = $validatedData['description'];
        $materiel->quantite = $validatedData['quantite'];
        $materiel->save();

        return redirect()->route('lesMateriels');
    }

    public function create()
    {
        $materiel = Materiel::all();

        return view('materiel.create', compact('materiel'));
    }

    public function store(Request $request)
    {

        // Définition des règles de validation
        $rules = [
            'libelle' => [
                'string',
                'max:100',
                'regex:/^[a-zA-Z0-9_.,!?\-()\s]*$/'
            ],

            'description' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9_.,!?\-()\s]*$/'
            ],

            'quantite' => [
                'required',
                'integer',
                'min:1',
            ],
        ];

        // Définition des messages d'erreur personnalisés
        $messages = [
            'description.string' => 'Le champ description doit être une chaîne de caractères.',
            'description.max' => 'Le champ description ne doit pas dépasser 255 caractères.',
            'description.regex' => 'Le champ description contient des caractères non autorisés.',
            'quantite.required' => 'La quantité est obligatoire.',
            'quantite.integer' => 'La quantité doit être un nombre entier.',
            'quantite.min' => 'La quantité doit être supérieure ou égale à 1.',
        ];

        // Validation des données
        $validatedData = $request->validate($rules, $messages);


        $materiel = new Materiel();

        $materiel->libelle = $validatedData['libelle'];
        $materiel->description = $validatedData['description'];
        $materiel->quantite = $validatedData['quantite'];
        $materiel->save();

        return redirect()->route('lesMateriels');
    }

}
