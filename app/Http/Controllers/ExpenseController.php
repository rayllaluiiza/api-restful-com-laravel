<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(){
        return Expense::all();
    }

    public function store(ExpenseRequest $request){
        return response()->json(Expense::create($request->all()), 201);
    }

    public function show(int $id){
        return Expense::find($id);
    }

    public function update(int $id, Request $request){
        $expense = Expense::find($id);

        $expense->fill($request->all());
        $expense->save();

        return $expense;
    }

    public function destroy(int $id){
        Expense::destroy($id);
        
        return response()->noContent();
    }
}
