<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProduitRequest;
use App\Http\Resources\ProduitResource;
use App\Models\Produit;
use Exception;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Affichage de tous les produits
        $produits = Produit::all();
        return response()->json([
            'message' => 'Liste de tous les produits',
            'produits' => ProduitResource::collection(Produit::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProduitRequest $request)
    {
        try {
            //Récupération de la photo
            $photo = $request->file('photo');
            $path = $photo->store('public/photo-produit');
            //Enregistrement ds la bdd
            $produit = new Produit;
            $produit->nom = $request->nom;
            $produit->type = $request->type;
            $produit->prix = $request->prix;
            $produit->photo = $path;
            $produit->save();
            return response()->json([
                'message' => 'Produit créé avec succès',
                'produit' => $produit,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'erreur' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        //Affichage d'un seul produit (spécifié par $produit)
        return response()->json([
            'message' => 'Produit affiché avec succès',
            'produit' => $produit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        //Modification les informations concernant un produit hormis 'Stock' qui sera modifié autrement dans l'insertion - modification Stock
        // $this->validate($request, [
        //     'nom' => 'required',
        //     'type' => 'required|exists:type_produit,id',
        //     'prix' => 'required|numeric',
        //     'photo' => 'required|mimes:png,jpg',
        // ]);
        // return response()->json([
        //     'message' => 'Produit modifié avec succès',
        //     'produit' => $request->all(),
        // ]);
        /**
         * 
         * TODOOOOOOO
         * 
         */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        //
    }
}
