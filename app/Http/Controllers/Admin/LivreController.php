<?php

namespace App\Http\Controllers\Admin;

use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LivreController extends Controller
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
        return view('admin.livres.create');
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
            "title" => ["required", "string", "max:255", "unique:livres"],
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
        Livre::create([
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
        $livre = Livre::find($id);

        if ($livre)
        {
            return view('admin.livres.show', compact('livre'));
        }
        else
        {
            return redirect()->route('admin.index')->with([
                "warning" => "Ce livre n'existe pas."
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livre = Livre::find($id);

        if (!$livre)
        {
            return redirect()->route('admin.index')->with([
                "warning" => "Ce livre n'existe pas."
            ]);
        }
        else 
        {
            return view('admin.livres.edit', compact('livre'));
        }
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
        $livre = Livre::find($id);

        // mise en place des règles de validation
        $validator = Validator::make($request->all(), 
        [
            "title" => ["required", "string", "max:255", Rule::unique('livres')->ignore($livre->id)],
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

        // réinitialisation du slug
        $livre->slug = null;

        // stockage des données
        $livre->update([
            "title" => $request->title,
            "author" => $request->author,
            "rating" => $request->rating,
            "review" => $request->review
        ]);

        // redirection
        return redirect()->route('admin.index')->with([
            "success" => "Livre modifié avec succès."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livre = Livre::find($id);

        $livre->delete();

        return redirect()->route('admin.index')->with([
            "warning" => "Le livre <i>$livre->name</i> a été supprimé avec succès."
        ]);
    }
}
