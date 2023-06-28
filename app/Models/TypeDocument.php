<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocument extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'naziv',
        'nivoTerminologije'
    ];

    public function document(){
        return $this->hasMany(Document::class);
    }
}


