@extends('header')

@section('title')
    Pannes
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
            <a class="nav-link active text-white" href="/panneAll">
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
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Liste des pannes</h3>
                <a href="{{ route('panne.create') }}" class="btn btn-success">Ajouter une panne</a>
            </div>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Description de la panne</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pannes as $panne)
                        <tr>
                            <td>{{ $panne->description }}</td>
                            <td>
                                <form id="delete-form-{{ $panne->idPanne }}" method="POST" action="{{ route('panne.destroy', $panne->idPanne) }}">
                                    @csrf
                                    @method('POST')
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $panne->idPanne }})">Supprimer</button>
                                </form>
                                <a href="{{ route('panne.edit', $panne->idPanne) }}" class="btn btn-primary">Modifier</a>
                            </td>
                            <script>
                                function confirmDelete(id) {
                                    if (confirm("Êtes-vous sûr de vouloir supprimer cette panne ?")) {
                                        document.querySelector(`#delete-form-${id} button[type='button']`).disabled = true;
                                        document.querySelector(`#delete-form-${id}`).submit();
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
