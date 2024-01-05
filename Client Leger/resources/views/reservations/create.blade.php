@extends('header')

@section('title')
    Reservation
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
        <a class="nav-link active text-white" href="/reservation/create">
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
        <a class="nav-link text-white" href="/newPanne/create/0/0">
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
                    <div class="card-header">{{ __('Nouvelle réservation') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('storeReserv') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Email utilisateur') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ auth()->user()->email }}" readonly disabled>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="idMateriel" class="col-md-4 col-form-label text-md-right">{{ __('Nom du matériel') }}</label>
                                <div class="col-md-6">
                                    <select id="idMateriel" name="idMateriel" class="form-control" required>
                                        <option value="">Sélectionner un matériel</option>
                                        @foreach(App\Models\Materiel::select('libelle', 'idMateriel')->get() as $materiel)
                                            <option value="{{ $materiel->idMateriel }}" @if(old('idMateriel') == $materiel->idMateriel) selected @endif>{{ $materiel->libelle }}</option>                                        @endforeach
                                    </select>
                                    @error('idMateriel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dateDebut"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Date début') }}</label>

                                <div class="col-md-6">
                                    <input id="dateDebut" type="date"
                                           class="form-control @error('dateDebut') is-invalid @enderror" name="dateDebut"
                                           value="{{ old('dateDebut') }}" required>

                                    @error('dateDebut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dateFin"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Date fin') }}</label>

                                <div class="col-md-6">
                                    <input id="dateFin" type="date"
                                           class="form-control @error('dateFin') is-invalid @enderror" name="dateFin"
                                           value="{{ old('dateFin') }}">

                                    @error('dateFin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="quantite"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Quantité') }}</label>

                                <div class="col-md-6">
                                    <input id="quantite" type="number"
                                           class="form-control @error('quantite') is-invalid @enderror" name="quantite"
                                           value="{{ old('quantite') }}" required>
                                    @error('quantite')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Ajouter') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
