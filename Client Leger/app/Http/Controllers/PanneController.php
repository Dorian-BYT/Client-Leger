<?php

namespace App\Http\Controllers;

use App\Models\Panne;
use Illuminate\Http\Request;

class PanneController extends Controller
{
    public function show($id){

        $panne = Panne::find($id);
        return view('panneMateriel.panneMateriel', ['panneMateriel'=>$panne]);
    }

    public function showAll(){
        $pannes = Panne::all();
        return view('panne.panneAll', ['pannes'=>$pannes]);
    }

    public function materiels()
    {
        return $this->belongsToMany(Materiel::class, 'PanneMateriel', 'idPanne', 'idMateriel')
            ->withPivot(['dateDebut', 'dateFin']);
    }


    public function destroy($id)
    {
        $panne = Panne::findOrFail($id);
        $panne->delete();
        return redirect()->route('lesPannes');
    }

    public function edit($id)
    {
        $panne = Panne::findOrFail($id);

        return view('panne.update', compact('panne'));
    }

    public function update(Request $request, $id)
    {
        // Récupération de l'objet Panne correspondant à l'id
        $panne = Panne::findOrFail($id);

        // Définition des règles de validation
        $rules = [
            'description' => [
                'nullable',
                'string',
                'max:255',
                "regex:/^[a-zA-Z0-9_.'éàèçâêôù,!?\-()\s]*$/"
            ],
        ];

        // Définition des messages d'erreur personnalisés
        $messages = [
            'description.string' => 'Le champ description doit être une chaîne de caractères.',
            'description.max' => 'Le champ description ne doit pas dépasser 255 caractères.',
            'description.regex' => 'Le champ description contient des caractères non autorisés.',
        ];

        // Validation des données
        $validatedData = $request->validate($rules, $messages);

        $panne->description = $validatedData['description'];
        $panne->save();

        return redirect()->route('lesPannes');
    }

    public function create()
    {
        $panne = Panne::all();

        return view('panne.create', compact('panne'));
    }

    public function store(Request $request)
    {

        // Définition des règles de validation
        $rules = [
            'description' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9_.,!?\-()\s]*$/'
            ],
        ];

        // Définition des messages d'erreur personnalisés
        $messages = [
            'description.string' => 'Le champ description doit être une chaîne de caractères.',
            'description.max' => 'Le champ description ne doit pas dépasser 255 caractères.',
            'description.regex' => 'Le champ description contient des caractères non autorisés.',
        ];

        // Validation des données
        $validatedData = $request->validate($rules, $messages);

        $panne = new Panne();

        $panne->description = $validatedData['description'];
        $panne->save();

        return redirect()->route('lesPannes');
    }

}
