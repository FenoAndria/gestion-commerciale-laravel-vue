<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FactureRequest extends LayoutRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client' => 'required|exists:client,id'
        ];
    }
}
