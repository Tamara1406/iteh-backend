<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'naziv',
        'sadrzaj',
        'brojStrana',
        'autor_id',
        'sistemupravljanja_id',
        'typedocument_id'
    ];

    public function typedocument(){
        return $this->belongsTo(TypeDocument::class);
    }

    public function autor(){
        return $this->belongsTo(Autor::class);
    }

    public function sistemupravljanja(){
        return $this->belongsTo(SistemUpravljanja::class);
    }
}
