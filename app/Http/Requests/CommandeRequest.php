<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandeRequest extends LayoutRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'produit' => 'required|exists:produit,id',
            'quantite' => 'required|numeric',
            'facture' => 'required|exists:facture,id',
        ];
    }
}
