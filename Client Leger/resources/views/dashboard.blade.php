@extends('header')

@section('title')
    Dashboard
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link active text-white" href="/dashboard">
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
            <a class="nav-link text-white" href="/panneAll">
                <span data-feather="tool"></span>
                Les Pannes
            </a>
        </li>
    </ul>
    @endrole

@endsection


        @section('content')

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>
            @php

                $emprunts = App\Models\EmpruntMateriel::where('idUser', auth()->id())
                     ->whereRaw('DATE_ADD(CURDATE(), INTERVAL 10 DAY) >= dateFin')
                        ->orderby('dateFin', 'asc')
                        ->get();

            @endphp
            @if (!$emprunts->isEmpty())
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informations sur vos remises de materiels empruntés</h3>
                </div>
                <div class="card-body">

                    <dl class="row">
                        @foreach($emprunts as $emprunt)
                            @php
                                $dateAvantRendu = now()->diffInDays($emprunt->dateFin, false);
                                if($dateAvantRendu < 0){
                            @endphp
                            <dt class="col-sm-3 text-danger">RETARD : {{$emprunt->materiel->libelle}}</dt>
                            <dd class="col-sm-9">
                                <p class="text-danger">Vous êtes en retard de {{ abs($dateAvantRendu)}} jours, vous devez rendre le materiel.</p>
                            </dd>

                            @php
                                }else{
                            @endphp
                            <dt class="col-sm-3">Infos : {{$emprunt->materiel->libelle}}</dt>
                            <dd class="col-sm-9">
                                <p>Il vous reste {{ $dateAvantRendu + 1}} jour(s) avant de devoir rendre le matériel.</p>
                            </dd>
                            @php
                                }
                            @endphp
                        @endforeach


                    </dl>
                </div>
            </div>
            @endif

            <br><br>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informations de l'utilisateur</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nom</dt>
                        <dd class="col-sm-9">{{ Auth::user()->nom }}</dd>
                        <dt class="col-sm-3">Prenom</dt>
                        <dd class="col-sm-9">{{ Auth::user()->prenom }}</dd>
                        <dt class="col-sm-3">Adresse</dt>
                        <dd class="col-sm-9">{{ Auth::user()->adresse }}</dd>
                        <dt class="col-sm-3">Telephone</dt>
                        <dd class="col-sm-9">{{ Auth::user()->telephone }}</dd>
                        <dt class="col-sm-3">Rôle</dt>
                        <dd class="col-sm-9">{{ Auth::user()->role }}</dd>
                    </dl>
                </div>
            </div>
            @endsection


