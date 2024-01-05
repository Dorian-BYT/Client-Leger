@extends('header')

@section('title')
    Nouvelle Panne
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link text-white" href="/dashboard">
            <span data-feather="home"></span>
            Dashboard <span class="sr-only"></span>
        </a>
    </li>
    @role('admin|utilisateur')
    <li class="nav-item">
        <a class="nav-link text-white" href="/stock">
            <span data-feather="layers"></span>
            Materiels empruntés
        </a>
    </li>
    <li class="nav-item ">
        <a class="nav-link text-white" href="/reservation/create">
            <span data-feather="shopping-cart"></span>
            Nouvelle Reservation
        </a>
    </li>
    @endrole
    @role('admin|technicien')
    <li class="nav-item ">
        <a class="nav-link text-white" href="/panneMateriel">
            <span data-feather="tool"></span>
            Reparer les Pannes
        </a>
    </li>
    @endrole
    @role('admin|utilisateur')
    <li class="nav-item ">
        <a class="nav-link text-white" href="/panneUser">
            <span data-feather="tool"></span>
            Pannes Materiels
        </a>
    </li>
    <li class="nav-item ">
        <a class="nav-link active text-white" href="/newPanne/create/0/0">
            <span data-feather="tool"></span>
            Nouvelles Pannes
        </a>
    </li>
    @endrole

    @role('admin')
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Edit Action Admin</span>
    </h6>

    <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <a class="nav-link text-white"  href="/usersAll">
                <span data-feather="users"></span>
                Les Utilisateurs
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="/materielAll">
                <span data-feather="filter"></span>
                Les Materiels
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="/panneAll">
                <span data-feather="tool"></span>
                Les Pannes
            </a>
        </li>
    </ul>
    @endrole

@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nouvelle Panne') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('storePanne') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Email utilisateur') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text"
                                       class="form-control" name="email"
                                       value="{{ auth()->user()->email }}" readonly disabled>
                            </div>
                        </div>

                        @php
                            $libelle = request()->route('libelle'); // Récupère le libellé depuis l'URL

                            if ($libelle == '0') {
                        @endphp
                        <div class="form-group row">
                            <label for="idMateriel" class="col-md-4 col-form-label text-md-right">{{ __('Nom du matériel') }}</label>

                            <div class="col-md-6">
                                @php

                                @endphp
                                <select id="idMateriel" type="text" class="form-control" name="idMateriel" required>
                                    <option value="">Sélectionner un matériel</option>
                                    @foreach(App\Models\EmpruntMateriel::select('idMateriel')->distinct()->where('idUser', auth()->id())->get() as $emprunt)
                                        @php
                                            $materiel = App\Models\Materiel::find($emprunt->idMateriel);
                                        @endphp
                                        <option value="{{ $materiel->idMateriel }}" {{ $materiel->idMateriel == old('idMateriel') ? 'selected' : '' }}>{{ $materiel->libelle }}</option>
                                    @endforeach
                                </select>

                                <a onclick="redirectToSelected()" class="btn btn-primary">Valider le materiel</a>

                                <script>
                                    function redirectToSelected() {
                                        var selectBox = document.getElementById("idMateriel");
                                        var selectedLabel = selectBox.options[selectBox.selectedIndex].text; // récupère le libellé correspondant à l'ID sélectionné
                                        window.location.href = "http://127.0.0.1:8000/newPanne/create/" + selectedLabel + "/{{request()->route('dateDebut')}}";                                    }
                                </script>
                            </div>
                        </div>
                        @php
                            }else {
                        @endphp
                        <div class="form-group row">
                            <label for="idMateriel" class="col-md-4 col-form-label text-md-right">{{ __('Nom du matériel') }}</label>

                            <div class="col-md-6">
                                @php
                                    $idUser = auth()->user()->id;
                                    $libelle = request()->route('libelle'); // Récupère le libellé depuis l'URL
                                    $emprunts = App\Models\EmpruntMateriel::where('idUser', $idUser)
                                        ->whereHas('materiel', function($query) use($libelle) {
                                            $query->where('libelle', $libelle);
                                        })->get();

                                    if ($emprunts->count() > 0) {
                                            $materiel = App\Models\Materiel::where('libelle', $libelle)->first(); // Récupère l'objet Materiel correspondant au libellé
                                @endphp
                                <input id="idMateriel" type="text" class="form-control" name="idMateriel" value="{{ $materiel->libelle }}" required disabled>
                                <input type="hidden" name="idMateriel" value="{{ $materiel->idMateriel }}">
                                @php
                                    } else {
                                        header("Location: http://127.0.0.1:8000/panneUser", true, 302);
                                        exit();
                                    }
                                @endphp
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateDebut"
                                   class="col-md-4 col-form-label text-md-right">{{ __("Date début d'emprunt") }}</label>

                            <div class="col-md-6">
                                @php
                                    $dateDebut = request()->route('dateDebut');; // Récupère le libellé depuis l'URL
                                    $lesDates = App\Models\EmpruntMateriel::pluck('dateDebut')->toArray(); // Récupère tous les libellés de la table Materiel
                                    $idUser = auth()->user()->id;

                                    $libelle = request()->route('libelle');


                                    // Récupère toutes les noms des materiels empruntés en fonction de l'id utilisateur

                                    $emprunts = App\Models\EmpruntMateriel::where('idUser', $idUser)
                                        ->whereHas('materiel', function($query) use($libelle) {
                                            $query->where('libelle', $libelle);
                                        })
                                        ->where('dateDebut', $dateDebut)
                                        ->first();

                                    if ($dateDebut == '0') {

                                        // Récupère toutes les datesDebut possibles pour le libellé et l'id utilisateur donnés
                                    $datesDebut = App\Models\EmpruntMateriel::where('idUser', $idUser)
                                       ->whereHas('materiel', function($query) use($libelle) {
                                            $query->where('libelle', $libelle);
                                        })
                                       ->pluck('dateDebut')
                                       ->unique()
                                       ->toArray();

                                @endphp

                                    <select id="dateDebut" type="text" class="form-control @error('dateDebut') is-invalid @enderror" name="dateDebut" required>
                                        <option value="">Sélectionner une date de début</option>
                                        @foreach ($datesDebut as $dateDebut)
                                            <option value="{{ $dateDebut }}" {{ old('dateDebut') == $dateDebut ? 'selected' : '' }}>{{ $dateDebut }}</option>
                                        @endforeach
                                    </select>


                                @php


                                    }elseif (!$emprunts) {
                                        // la dateDebut ne correspond pas à un emprunt pour le matériel et l'utilisateur donnés
                                        header("Location: http://127.0.0.1:8000/panneUser", true, 302);
                                        exit();
                                    }else {
                                @endphp
                                <input id="dateDebut" type="text"
                                       class="form-control" name="dateDebut"
                                       value="{{ $dateDebut }}" readonly disabled>
                                <input type="hidden" name="dateDebut" value="{{ $dateDebut }}">

                                @php
                                    }
                                @endphp

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idPanne" class="col-md-4 col-form-label text-md-right">{{ __('Description de la Panne') }}</label>
                            <div class="col-md-6">
                                <select id="idPanne" name="idPanne" class="form-control @error('idPanne') is-invalid @enderror" required>
                                    <option value="">Sélectionner une description</option>
                                    @foreach(App\Models\Panne::select('description', 'idPanne')->get() as $panne)
                                        <option value="{{ $panne->idPanne }}" {{ old('idPanne') == $panne->idPanne ? 'selected' : '' }}>
                                            {{ $panne->description }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idPanne')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="infos_supplementaires" class="col-md-4 col-form-label text-md-right">{{ __('Informations complémentaires') }}</label>

                            <div class="col-md-6">
                                <textarea id="infos_supplementaires" type="text"
                                          class="form-control @error('infos_supplementaires') is-invalid @enderror"
                                          name="infos_supplementaires">{{ old('infos_supplementaires') }}</textarea>
                                <div class="d-flex justify-content-end">
                                    <div id="infos_supplementaires_counter">0/255</div>
                                </div>
                                @error('infos_supplementaires')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <script>
                                const infosSuppInput = document.querySelector('#infos_supplementaires');
                                const infosSuppCounter = document.querySelector('#infos_supplementaires_counter');

                                infosSuppInput.addEventListener('input', () => {
                                    const count = infosSuppInput.value.length;
                                    infosSuppCounter.textContent = count + '/255';
                                });
                            </script>



                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ajouter') }}
                                </button>
                            </div>
                        </div>
                        @php
                            }
                        @endphp
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
