<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\SkillController;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\UniverseController;
use App\Http\Controllers\RechercherHeroesController;
use App\Http\Controllers\Auth\RegisteredUserController;

// lignes Gestion routes home
Route::get('/', [HomeController::class, 'index'])->name('home');


// ligne hero
Route::resource('heroes', HeroController::class);

// ligne rechercher
Route::resource('rechercherheroes', ContactsController::class);
Route::get('/rechercherheroes', [RechercherHeroesController::class, 'index'])->name('rechercherheroes.index');
Route::get('rechercherheroes', [RechercherHeroesController::class, 'index'])->name('rechercherheroes.index');

Route::middleware('auth')->group(function () {
    // lignes Gestion routes user
    Route::resource('user', UserController::class);
    Route::patch('user/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('user.toggleRole');

    // lignes Gestion routes profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // lignes Gestion routes heroes

    Route::resource('skills', SkillController::class);
    Route::resource('universes', UniverseController::class);
    Route::resource('articles', ArticleController::class);


});
// lignes contact 
Route::resource('contacts', ContactsController::class);
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::get('/contacts/show/', [ContactsController::class, 'show'])->name('contacts.show');
Route::delete('/contacts/{id}', [ContactsController::class, 'destroy'])->name('contacts.destroy');



// lignes register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);



// lignes auth
require __DIR__ . '/auth.php';