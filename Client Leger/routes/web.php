<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});*/

/**Route::get('/', function () {
    return view('accueil');
})->name('accueil');

Route::get('/information', function () {
    return view('information');
})->name('information');

Route::get('/foo', [\App\Http\Controllers\TestController::class, 'foo']);
Route::get('/bar', [\App\Http\Controllers\TestController::class, 'bar']);

Route::group(['middleware' => ['role:admin']], function () {
    Route::get("/usersAll/",[\App\Http\Controllers\UserController::class, "showAll"])
        ->name('lesUsers');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [DashboardController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [DashboardController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [DashboardController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';

#----- View Emprunteur -----#
Route::get("/emprunteur/{id}",[\App\Http\Controllers\UserController::class, "show"])
    ->where("name","[0-9]+");

Route::get("/emprunteurAll/",[\App\Http\Controllers\UserController::class, "showAll"])
    ->where("name","[0-9]+");

#----- View Users -----#
Route::get("/users/{id}",[\App\Http\Controllers\UserController::class, "show"])->name('users.show');



Route::post("/usersDelete/{id}",[\App\Http\Controllers\UserController::class, "destroy"])
    ->name('users.destroy');

Route::post("/usersUpdate/{id}",[\App\Http\Controllers\UserController::class, "update"])
    ->name('users.update');


#----- View Materiel -----#

Route::get("/materiel/{id}",[\App\Http\Controllers\MaterielController::class, "show"])
    ->where("name","[0-9]+");

Route::get("/materielAll/",[\App\Http\Controllers\MaterielController::class, "showAll"])
    ->name('lesMateriels');

Route::post("/materielsDelete/{id}",[\App\Http\Controllers\MaterielController::class, "destroy"])
    ->name('materiel.destroy');

Route::get("/materielsUpdate/{id}",[\App\Http\Controllers\MaterielController::class, "edit"])
    ->name('materiel.edit');

Route::post("/update/{id}",[\App\Http\Controllers\MaterielController::class, "update"])
    ->name('materiel.update');


Route::get("/newMateriel/",[\App\Http\Controllers\MaterielController::class, "create"])
    ->name('materiel.create');

Route::post("/newMateriel/",[\App\Http\Controllers\MaterielController::class, "store"])
    ->name('materiel.store');

#----- View Panne -----#

Route::get("/materiel/{id}",[\App\Http\Controllers\PanneController::class, "show"])
    ->where("name","[0-9]+");

Route::get("/panneAll/",[\App\Http\Controllers\PanneController::class, "showAll"])
    ->name('lesPannes');

Route::post("/pannesDelete/{id}",[\App\Http\Controllers\PanneController::class, "destroy"])
    ->name('panne.destroy');

Route::get("/pannesUpdate/{id}",[\App\Http\Controllers\PanneController::class, "edit"])
    ->name('panne.edit');

Route::post("/update/{id}",[\App\Http\Controllers\PanneController::class, "update"])
    ->name('panne.update');


Route::get("/newPanne/panne",[\App\Http\Controllers\PanneController::class, "create"])
    ->name('panne.create');

Route::post('/newPanne/panne', [\App\Http\Controllers\PanneController::class, 'store'])->name('panne.store');


#----- View Reservation -----#

Route::get('/reservation/create', [\App\Http\Controllers\ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservation', [\App\Http\Controllers\ReservationController::class, 'store'])->name('storeReserv');

#----- View Stock -----#

Route::get('/stock', [\App\Http\Controllers\EmpruntMaterielController::class,'stock'])->name('stock');
Route::post('/stock/{libelle}/{dateDebut}/{dateFin}/rendu', [\App\Http\Controllers\EmpruntMaterielController::class,'rendu'])->name('rendu');


#----- View Panne Materiel -----#

Route::get('/panneMateriel', [\App\Http\Controllers\PanneMaterielController::class,'panneMateriel'])->name('panneMateriel');
Route::post('/pannes/{idPanne}/{idMateriel}/{date}/reparer', [\App\Http\Controllers\PanneMaterielController::class,'reparer'])->name('reparer');
Route::post('/pannes/{idPanne}/{idMateriel}/{date}/irreparable', [\App\Http\Controllers\PanneMaterielController::class,'supprimer'])->name('supprimer');


Route::get('/panneUser', [\App\Http\Controllers\PanneMaterielController::class,'panneUser']);


Route::get('/newPanne/create/{libelle}/{dateDebut}', [\App\Http\Controllers\PanneMaterielController::class, 'create'])->name('panneMateriel.create');
Route::post('/newPanne', [\App\Http\Controllers\PanneMaterielController::class, 'store'])->name('storePanne');

**/


use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('accueil');
})->name('accueil');

Route::get('/information', function () {
    return view('information');
})->name('information');

Route::get('/foo', [\App\Http\Controllers\TestController::class, 'foo']);
Route::get('/bar', [\App\Http\Controllers\TestController::class, 'bar']);

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['middleware' => ['role:admin']], function () {

        #----- View Users -----#
        Route::get("/users/{id}", [\App\Http\Controllers\UserController::class, "show"])->name('users.show');

        Route::get("/usersAll/", [\App\Http\Controllers\UserController::class, "showAll"])
            ->name('lesUsers');

        Route::post("/usersDelete/{id}", [\App\Http\Controllers\UserController::class, "destroy"])
            ->name('users.destroy');

        Route::post("/usersUpdate/{id}", [\App\Http\Controllers\UserController::class, "update"])
            ->name('users.update');


        #----- View Materiel -----#

        Route::get("/materiel/{id}", [\App\Http\Controllers\MaterielController::class, "show"])
            ->where("name", "[0-9]+");

        Route::get("/materielAll/", [\App\Http\Controllers\MaterielController::class, "showAll"])
            ->name('lesMateriels');

        Route::post("/materielsDelete/{id}", [\App\Http\Controllers\MaterielController::class, "destroy"])
            ->name('materiel.destroy');

        Route::get("/materielsUpdate/{id}", [\App\Http\Controllers\MaterielController::class, "edit"])
            ->name('materiel.edit');

        Route::post("/update/{id}", [\App\Http\Controllers\MaterielController::class, "update"])
            ->name('materiel.update');


        Route::get("/newMateriel/", [\App\Http\Controllers\MaterielController::class, "create"])
            ->name('materiel.create');

        Route::post("/newMateriel/", [\App\Http\Controllers\MaterielController::class, "store"])
            ->name('materiel.store');

        #----- View Panne -----#

        Route::get("/materiel/{id}", [\App\Http\Controllers\PanneController::class, "show"])
            ->where("name", "[0-9]+");

        Route::get("/panneAll/", [\App\Http\Controllers\PanneController::class, "showAll"])
            ->name('lesPannes');

        Route::post("/pannesDelete/{id}", [\App\Http\Controllers\PanneController::class, "destroy"])
            ->name('panne.destroy');

        Route::get("/pannesUpdate/{id}", [\App\Http\Controllers\PanneController::class, "edit"])
            ->name('panne.edit');

        Route::post("/update/{id}", [\App\Http\Controllers\PanneController::class, "update"])
            ->name('panne.update');


        Route::get("/newPanne/panne", [\App\Http\Controllers\PanneController::class, "create"])
            ->name('panne.create');

        Route::post('/newPanne/panne', [\App\Http\Controllers\PanneController::class, 'store'])->name('panne.store');


    });

    #---------------------------------------- UTILISATEUR ----------------------------------------#

    Route::group(['middleware' => ['role:utilisateur|admin']], function () {


        #----- View Reservation -----#

        Route::get('/reservation/create', [\App\Http\Controllers\ReservationController::class, 'create'])->name('reservation.create');
        Route::post('/reservation', [\App\Http\Controllers\ReservationController::class, 'store'])->name('storeReserv');

        #----- View Stock -----#

        Route::get('/stock', [\App\Http\Controllers\EmpruntMaterielController::class, 'stock'])->name('stock');
        Route::post('/stock/{libelle}/{dateDebut}/{dateFin}/rendu', [\App\Http\Controllers\EmpruntMaterielController::class, 'rendu'])->name('rendu');


        #----- View Panne Materiel -----#

        Route::get('/panneUser', [\App\Http\Controllers\PanneMaterielController::class, 'panneUser']);


        Route::get('/newPanne/create/{libelle}/{dateDebut}', [\App\Http\Controllers\PanneMaterielController::class, 'create'])->name('panneMateriel.create');
        Route::post('/newPanne', [\App\Http\Controllers\PanneMaterielController::class, 'store'])->name('storePanne');

    });


    #---------------------------------------- TECHNICIEN ----------------------------------------#

    Route::group(['middleware' => ['role:technicien|admin']], function () {

        #----- View Panne Materiel -----#

        Route::get('/panneMateriel', [\App\Http\Controllers\PanneMaterielController::class, 'panneMateriel'])->name('panneMateriel');
        Route::post('/pannes/{idPanne}/{idMateriel}/{date}/reparer', [\App\Http\Controllers\PanneMaterielController::class, 'reparer'])->name('reparer');
        Route::post('/pannes/{idPanne}/{idMateriel}/{date}/irreparable', [\App\Http\Controllers\PanneMaterielController::class, 'supprimer'])->name('supprimer');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [DashboardController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [DashboardController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [DashboardController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__ . '/auth.php';




