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
        return Revenue::find($id);
    }

    public function update(int $id, Request $request){
        $revenue = Revenue::find($id);

        $revenue->fill($request->all());
        $revenue->save();

        return $revenue;
    }

    public function destroy(int $id){
        Revenue::destroy($id);

        return response()->noContent();
    }
}
