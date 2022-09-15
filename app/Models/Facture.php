<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $table = 'facture';
    protected $fillable = ['client', 'montant', 'payee'];

    public function getCommande()
    {
        return $this->hasMany(Commande::class, 'facture');
    }

    public function getClient()
    {
        return $this->belongsTo(Client::class,'id');
    }
}
