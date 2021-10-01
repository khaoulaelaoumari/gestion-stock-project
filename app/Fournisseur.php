<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $fillable = ['id', 'Ice', 'phone','adresse','logo','NomSociete'];
    use HasFactory;
}
