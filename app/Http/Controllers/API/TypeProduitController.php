<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeProduitRequest;
use App\Http\Resources\TypeProduitResource;
use App\Models\TypeProduit;
use Exception;
use Illuminate\Http\Request;

class TypeProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Affichage de tous les types de produit
        // $types_produit = TypeProduit::all();
        return response()->json([
            'message' => 'Liste de tous les types de produit',
            'type_produit' => TypeProduitResource::collection(TypeProduit::all()),
        ]);
        // return TypeProduitResource::collection(TypeProduit::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeProduitRequest $request)
    {
        try {
            $type_produit = new TypeProduit();
            $type_produit->nom = $request->nom;
            $type_produit->save();
            return response()->json([
                'message' => 'Type de produit créé avec succès',
                'type_produit' => $type_produit,
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
     * @param  \App\Models\TypeProduit  $typeProduit
     * @return \Illuminate\Http\Response
     */
    public function show(TypeProduit $typeProduit)
    {
        return response()->json([
            'message' => 'Produit affiché avec succès',
            'type_produit' => new TypeProduitResource($typeProduit),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeProduit  $typeProduit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeProduit $typeProduit)
    {
        //TODOOOOOO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeProduit  $typeProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeProduit $typeProduit)
    {
        //
    }
}
