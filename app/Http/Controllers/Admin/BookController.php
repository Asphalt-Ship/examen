<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    // importation du middleware
    public function __construct() 
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // mise en place des règles de validation
        $validator = Validator::make($request->all(), 
        [
            "title" => ["required", "string", "max:255", "unique:books"],
            "author" => ["required", "string", "max:255"],
            "rating" => ["required", "integer", "between:0,20"],
            "review" => ["required", "string"]
        ], 
        [
            "title.required" => "Ce champ est obligatoire.",
            "title.string" => "Veuillez entrer un titre valide.",
            "title.max" => "Veuillez entrer un titre de 255 caractères maximum.",
            "title.unique" => "Ce livre existe déjà.",
            "author.required" => "Ce champ est obligaoire.",
            "author.string" => "Veuillez entrer un nom d'auteur valide.",
            "author.max" => "Veuillez entrer un nom d'auteur de 255 caractères maximum.",
            "rating.required" => "Ce champ est obligatoire.",
            "rating.integer" => "Veuillez entrer un nombre entier.",
            "rating.between" => "La notation doit être comprise entre 0 et 20",
            "review.required" => "Ce champ est obligatoire.",
            "review.string" => "Veuillez entrer un avis valide."
        ]);

        // vérification des règles
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // stockage des données
        Book::create([
            "title" => $request->title,
            "author" => $request->author,
            "rating" => $request->rating,
            "review" => $request->review
        ]);

        // redirection
        return redirect()->route('admin.index')->with([
            "success" => "Livre ajouté avec succès."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
