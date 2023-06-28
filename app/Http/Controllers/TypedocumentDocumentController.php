<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentCollection;
use App\Models\Document;
use App\Models\TypeDocument;
use Illuminate\Http\Request;

class TypedocumentDocumentController extends Controller
{
    public function index($typedocument_id){
        $documents = Document::get()->where('typedocument_id',$typedocument_id);
        if(is_null($documents)){
            return response()->json('Documents not found',404);
        }
        return response()->json(new DocumentCollection($documents));
    }
}
