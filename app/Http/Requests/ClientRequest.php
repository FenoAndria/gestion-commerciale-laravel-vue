<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends LayoutRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom'=>'required',
            'adresse'=>'required',
            'telephone'=>'required|size:10',
            'email'=>'nullable|email',
        ];
    }
}
