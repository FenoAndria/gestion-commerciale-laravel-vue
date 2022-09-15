<?php

namespace App\Http\Requests\Stock;

use App\Http\Requests\LayoutRequest;

class StockRequest extends LayoutRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|numeric'
        ];
    }
}
