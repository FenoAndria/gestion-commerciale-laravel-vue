<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commande';
    protected $fillable = ['produit', 'quantite', 'facture'];

    public function getProduit()
    {
        return $this->belongsTo(Produit::class,'produit');
    }
}
