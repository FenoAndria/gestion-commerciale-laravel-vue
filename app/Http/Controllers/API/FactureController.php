<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FactureRequest;
use App\Models\Facture;
use Illuminate\Http\Request;

class FactureController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FactureRequest $request)
    {
        //Créer une facture
        $facture = new Facture;
        $facture->client = $request->client;
        $facture->save();
        return response()->json([
            'message' => 'Facture du client établie avec succès',
            'facture' => $facture,
        ]);
    }

    public function finaliser(Facture $facture)
    {
        if ($facture->payee) {
            return response()->json([
                'message' => "Facture du client {$facture->getClient->nom} déjà payée ",
                'facture' => $facture
            ]);
        }
        //Finaliser les commandes - le montant à payer
        $montantTotal = 0;
        foreach ($facture->getCommande as $commande) {
            $montantTotal = $montantTotal + ($commande->getProduit->prix * $commande->quantite);
        }
        $facture->montant = $montantTotal;
        $facture->save();
        return response()->json([
            'message' => 'Facture du client finalisée avec succès',
            'facture' => $facture,
        ]);
        /**
         * l'ID de Facture établie [store] doit être la même que ID de Facture insérée dans la commande [à valider sur le front :)]
         */
    }

    public function payer(Facture $facture)
    {
        // Payer la facture - Boolean TRUE
        if ($facture->payee) {
            return response()->json([
                'message' => "Facture du client {$facture->getClient->nom} déjà payée ",
                'facture' => $facture
            ]);
        }
        // $facture->payee = !$facture->payee;
        $facture->payee = true;
        $facture->save();
        return response()->json([
            'message' => "Facture du client {$facture->getClient->nom} payée avec succès",
            'facture' => $facture
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        //
    }
}
