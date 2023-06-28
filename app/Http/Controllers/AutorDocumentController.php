<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentCollection;
use App\Models\Document;
use Illuminate\Http\Request;

class AutorDocumentController extends Controller
{
    public function index($autor_id){
        $documents = Document::get()->where('autor_id',$autor_id);
        if(is_null($documents)){
            return response()->json('Documents not found',404);
        }
        return response()->json(new DocumentCollection($documents));
    }
}
