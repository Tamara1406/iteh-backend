<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SistemUpravljanja extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'operativniSistem',
        'maxDokumenata',
        'brzinaUcitavanja'
    ];

    public function document(){
        return $this->hasMany(Document::class);
    }
}
