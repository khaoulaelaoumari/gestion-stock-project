<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = ['id', 'fournis_id', 'Nom','Prix_Achat','ref-prod','quantite','tva'];

    use HasFactory;
}
