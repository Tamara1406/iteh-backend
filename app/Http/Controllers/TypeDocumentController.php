<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeDocumentCollection;
use App\Http\Resources\TypeDocumentResource;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipovi = TypeDocument::all();
        return new TypeDocumentCollection($tipovi);
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
            'nivoTerminologije'=>'required|integer|min:0',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $tip = TypeDocument::create([
            'naziv'=>$request->naziv,
            'nivoTerminologije'=>$request->nivoTerminologije
        ]);

        return response()->json(new TypeDocumentResource($tip));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function show($typeDocument_id)
    {
        $tip = TypeDocument::find($typeDocument_id);
        if(is_null($tip)){
            return response()->json('Not found',404);
        }
        else{
            return response()->json(new TypeDocumentResource($tip));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeDocument $typeDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $typeDocument_id)
    {
        $validator = Validator::make($request->all(),[
            'naziv'=>'required|string|max:255',
            'nivoTerminologije'=>'required|integer|min:0',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $tip = TypeDocument::find($typeDocument_id);
        if(is_null($tip)){
            return response()->json('Not found',404);
        }
        else{
            $tip->naziv = $request->naziv;
            $tip->nivoTerminologije = $request->nivoTerminologije;
            $tip->update();
            return response()->json('Successfull');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy($typeDocument_id)
    {
        try{
            $tip = TypeDocument::find($typeDocument_id);
            if(is_null($tip)){
                return response()->json('Not found',404);
            }
            else{
                $tip->delete();
                return response()->json("Successfull");
            }
        }
        catch(\Illuminate\Database\QueryException $e){
            return response()->json($e);
        }
    }
}
