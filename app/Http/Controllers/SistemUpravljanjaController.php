<?php

namespace App\Http\Controllers;

use App\Http\Resources\SistemUpravljanjaCollection;
use App\Http\Resources\SistemUpravljanjaResource;
use App\Models\SistemUpravljanja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SistemUpravljanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sistemi = SistemUpravljanja::all();
        return new SistemUpravljanjaCollection($sistemi);
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
            'operativniSistem'=>'required|string|max:255',
            'maxDocumenata'=>'required|integer|min:5',
            'brzinaUcitavanja'=>'required|double|min:1',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $sistem = SistemUpravljanja::create([
            'operativniSistem'=>$request->operativniSistem,
            'maxDokumenata'=>$request->maxDokumenata,
            'brzinaUcitavanja'=>$request->brzinaUcitavanja
        ]);

        return response()->json(new SistemUpravljanjaResource($sistem));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SistemUpravljanja  $sistemUpravljanja
     * @return \Illuminate\Http\Response
     */
    public function show($sistemUpravljanja_id)
    {
        $sistem = SistemUpravljanja::find($sistemUpravljanja_id);
        if(is_null($sistem)){
            return response()->json('Not found',404);
        }
        else{
            return response()->json(new SistemUpravljanjaResource($sistem));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SistemUpravljanja  $sistemUpravljanja
     * @return \Illuminate\Http\Response
     */
    public function edit(SistemUpravljanja $sistemUpravljanja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SistemUpravljanja  $sistemUpravljanja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sistemUpravljanja_id)
    {
        $validator = Validator::make($request->all(),[
            'operativniSistem'=>'required|string|max:255',
            'maxDocumenata'=>'required|integer|min:5',
            'brzinaUcitavanja'=>'required|double|min:1',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $sistem = SistemUpravljanja::find($sistemUpravljanja_id);
        if(is_null($sistem)){
            return response()->json('Not found',404);
        }
        else{
            $sistem->operativniSistem = $request->operativniSistem;
            $sistem->maxDokumenata = $request->maxDokumenata;
            $sistem->brzinaUcitavanja = $request->brzinaUcitavanja;
            $sistem->update();
            return response()->json('Successfull');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SistemUpravljanja  $sistemUpravljanja
     * @return \Illuminate\Http\Response
     */
    public function destroy($sistemUpravljanja_id)
    {
        try{
            $sistem = SistemUpravljanja::find($sistemUpravljanja_id);
            if(is_null($sistem)){
                return response()->json('Not found',404);
            }
            else{
                $sistem->delete();
                return response()->json("Successfull");
            }
        }
        catch(\Illuminate\Database\QueryException $e){
            return response()->json($e);
        }
    }
}
