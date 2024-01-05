@extends('header')

@section('title')
    Utilisateurs
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
            <a class="nav-link active text-white"  href="/usersAll">
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
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Nouveau role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->nom }}</td>
                            <td>{{ $user->prenom }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <form method="POST" action="{{ route('users.update', $user->id) }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required autocomplete="role" autofocus>
                                                <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User</option>
                                                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="Technicien" {{ $user->role == 'Technicien' ? 'selected' : '' }}>Technicien</option>
                                            </select>
                                            @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Modifier') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </td>

                            <td>
                                <form id="rendu-form-{{ $user->id }}" method="POST" action="{{ route('users.destroy', $user->id) }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="button" class="btn btn-danger" onclick="confirmerRendu({{ $user->id }})">Supprimer</button>
                                </form>
                            </td>

                            <script>
                                function confirmerRendu(userId) {
                                    if (confirm("Êtes-vous sûr de vouloir rendre ce matériel ?")) {
                                        // Désactiver le bouton pour éviter la soumission multiple
                                        document.querySelector(`#rendu-form-${userId} button[type='button']`).disabled = true;
                                        // Soumettre le formulaire
                                        document.querySelector(`#rendu-form-${userId}`).submit();
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
