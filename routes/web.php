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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/index', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');

Route::get('/admin/livres/create', [App\Http\Controllers\Admin\LivreController::class, 'create'])->name('admin.livres.create');

Route::post('/admin/livres/store', [App\Http\Controllers\Admin\LivreController::class, 'store'])->name('admin.livres.store');

Route::get('/admin/livres/show/{id}', [App\Http\Controllers\Admin\LivreController::class, 'show'])->name('admin.livres.show');

Route::get('/admin/livres/edit/{id}', [App\Http\Controllers\Admin\LivreController::class, 'edit'])->name('admin.livres.edit');

Route::put('/admin/livres/update/{id}', [App\Http\Controllers\Admin\LivreController::class, 'update'])->name('admin.livres.update');

Route::delete('/admin/livres/delete/{id}', [App\Http\Controllers\Admin\LivreController::class, 'destroy'])->name('admin.livres.delete');
