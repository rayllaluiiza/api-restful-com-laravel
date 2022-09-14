<?php

namespace App\Http\Controllers;

use App\Http\Requests\RevenueRequest;
use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index(){
        return Revenue::all();
    }

    public function store(RevenueRequest $request){
        return response()->json(Revenue::create($request->all()), 201);
    }

    public function show(int $id){
        $revenue = Revenue::find($id);
        if($revenue === null){
            return response()->json(['message' => 'Receita não encontrada.'], 404);
        }

        return $revenue;
    }

    public function update(int $id, Request $request){
        $revenue = Revenue::find($id);

        if($revenue === null){
            return response()->json(['message' => 'Receita não encontrada.'], 404);
        }

        $revenue->fill($request->all());
        $revenue->save();

        return $revenue;
    }

    public function destroy(int $id){
        $revenue = Revenue::find($id);

        if($revenue === null){
            return response()->json(['message' => 'Receita não encontrada.'], 404);
        }

        Revenue::destroy($id);

        return response()->noContent();
    }
}
