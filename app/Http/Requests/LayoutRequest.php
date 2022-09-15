<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LayoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'required' => ':attribute ne doit pas être vide',
            'exists' => ':attribute introuvable',
            'numeric' => ':attribute doit être numérique',
            'mimes' => ':attribute : format invalide',
            'size' => ':attribute : nombre de caractères invalide',
            'email' => ':attribute invalide',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 404));
    }
}
