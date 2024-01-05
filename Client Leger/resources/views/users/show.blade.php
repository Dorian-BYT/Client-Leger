@extends('header')

@section('title')
    Information du titulaire
@endsection

@section('sidebar')
    <li class="nav-item ">
        <a class="nav-link text-white" href="http://127.0.0.1:8000/panneMateriel">
            <span data-feather="tool"></span>
            Pannes Materiels
        </a>
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Information du titulaire</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                    </tr>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
