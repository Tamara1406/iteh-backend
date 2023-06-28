<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'ime',
        'struka',
        'brojDokumenata'
    ];

    public function document(){
        return $this->hasMany(Document::class);
    }
}
