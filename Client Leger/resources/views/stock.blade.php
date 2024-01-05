@extends('header')

@section('title')
    Materiels empruntés
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
        <a class="nav-link active text-white" href="/stock">
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Materiels empruntés</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nom du matériel</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Quantité</th>
                        <th>Rapport de panne</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($emprunts as $empruntMateriel)
                        <tr>
                            <td>{{ $empruntMateriel->materiel->libelle }}</td>
                            <td>{{ $empruntMateriel->dateDebut }}</td>
                            <td>{{ $empruntMateriel->dateFin }}</td>
                            <td>{{ $empruntMateriel->quantite }}</td>
                            <td>
                                <form action="{{ route('panneMateriel.create', [$empruntMateriel->materiel->libelle, $empruntMateriel->dateDebut]) }}" method="GET">
                                    <button type="submit" class="btn btn-primary">Report</button>
                                </form>
                            </td>
                            <td>
                                <form id="rendu-form-{{ $empruntMateriel->idEmpruntMateriel }}" method="POST" action="{{ route('rendu', [$empruntMateriel->materiel->libelle, $empruntMateriel->dateDebut, $empruntMateriel->dateFin]) }}">
                                    @csrf
                                    <input type="hidden" name="emprunt_id" value="{{ $empruntMateriel->idEmpruntMateriel }}">
                                    <button type="button" class="btn btn-danger" onclick="confirmerRendu({{ $empruntMateriel->idEmpruntMateriel }})">Rendu</button>
                                </form>
                            </td>

                            <script>
                                function confirmerRendu(empruntId) {
                                    if (confirm("Êtes-vous sûr de vouloir rendre ce matériel ?")) {
                                        // Désactiver le bouton pour éviter la soumission multiple
                                        document.querySelector(`#rendu-form-${empruntId} button[type='button']`).disabled = true;
                                        // Soumettre le formulaire
                                        document.querySelector(`#rendu-form-${empruntId}`).submit();
                                    }
                                }
                            </script>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
