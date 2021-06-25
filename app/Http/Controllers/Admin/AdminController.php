<?php

namespace App\Http\Controllers\Admin;

use App\Models\Livre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $livres = Livre::all();
        
        return view('admin.index', compact('livres'));
    }
}
