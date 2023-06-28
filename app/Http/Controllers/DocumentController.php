<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentCollection;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokumenti = Document::all();
        return new DocumentCollection($dokumenti);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'naziv'=>'required|string|max:255',
            'sadrzaj'=>'required|string|max:100',
            'brojStrana'=>'required|integer|min:0',
            'autor_id'=>'required',
            'sistemupravljanja_id'=>'required',
            'typedocument_id'=>'required'

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $dokument = Document::create([
            'naziv'=>$request->naziv,
            'sadrzaj'=>$request->sadrzaj,
            'brojStrana'=>$request->brojStrana,
            'autor_id'=>$request->autor_id,
            'sistemupravljanja_id'=>$request->sistemupravljanja_id,
            'typedocument_id'=>$request->typedocument_id
        ]);

        return response()->json(new DocumentResource($dokument));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show($document_id)
    {
        $dokument = Document::find($document_id);
        if(is_null($dokument)){
            return response()->json('Not found',404);
        }
        else{
            return response()->json(new DocumentResource($dokument));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $document_id)
    {
        $validator = Validator::make($request->all(),[
            'naziv'=>'required|string|max:255',
            'sadrzaj'=>'required|string|max:100',
            'brojStrana'=>'required|integer|min:0',
            'autor_id'=>'required',
            'sistemupravljanja_id'=>'required',
            'typedocument_id'=>'required'

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $dokument = Document::find($document_id);
        if(is_null($dokument)){
            return response()->json('Not found',404);
        }
        else{
            $dokument->naziv = $request->naziv;
            $dokument->sadrzaj = $request->sadrzaj;
            $dokument->brojStrana = $request->brojStrana;
            $dokument->autor_id = $request->autor_id;
            $dokument->sistemupravljanja_id = $request->sistemupravljanja_id;
            $dokument->typedocument_id = $request->typedocument_id;
            $dokument->update();
            return response()->json('Successfull');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($document_id)
    {
        try{
            $dokument = Document::find($document_id);
            if(is_null($dokument)){
                return response()->json('Not found',404);
            }
            else{
                $dokument->delete();
                return response()->json("Successfull");
            }
        }
        catch(\Illuminate\Database\QueryException $e){
            return response()->json($e);
        }
    }
}
