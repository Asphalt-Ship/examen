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
*/

Route::get('/', function () {
    return view('welcome');
});

    // cette route permet de se déconnecter si l'on se trouve dans une partie du site où, pour une raison ou pour une autre, il n'y a pas de bouton "se déconnecter"
Route::get('/logout', function() {
    Auth::logout();
    Session::flush();
    return redirect()->route('login');
});

Auth::routes();

// cette route empêche l'accès à la page 'register' car ce site est privé : il n'a qu'un seul utilisateur.
Route::any('/register', function() {
    return redirect('/');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// route pour la page d'accueil de l'admin
Route::get('/admin/index', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');

// route pour la page d'accueil des utilisateurs
Route::get('/user/index', [App\Http\Controllers\User\UserController::class, 'index'])->name('user.index');
