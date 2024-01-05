@extends('header')

@section('title')
    Panne
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
        <a class="nav-link active text-white" href="/panneUser">
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
            <h3 class="card-title">Pannes Materiels</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nom matériel</th>
                        <th>Description de la panne</th>
                        <th>Date de la panne</th>
                        <th>Informations supplémentaires</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pannes as $panneMateriel)
                        <tr>
                            <td>{{ $panneMateriel->materiel->libelle }}</td>
                            <td>{{ $panneMateriel->panne->description }}</td>
                            <td>{{ $panneMateriel->created_at }}</td>
                            <td>{{$panneMateriel->infos_supplementaires}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
