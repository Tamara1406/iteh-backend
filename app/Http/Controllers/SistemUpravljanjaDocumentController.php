<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentCollection;
use App\Models\Document;
use Illuminate\Http\Request;

class SistemUpravljanjaDocumentController extends Controller
{
    public function index($sistemupravljanja_id){
        $documents = Document::get()->where('sistemupravljanja_id',$sistemupravljanja_id);
        if(is_null($documents)){
            return response()->json('Documents not found',404);
        }
        return response()->json(new DocumentCollection($documents));
    }
}
