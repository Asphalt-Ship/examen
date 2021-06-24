<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // importation du middleware
    // on contrôle que l'utilisateur soit authentifié ET admin
    public function __construct() 
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        return view('admin.index');
    }
}
