<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request){
        if(isset($request->descricao)){
            return Expense::where('description', 'like', "%$request->descricao%")->get();
        }

        return Expense::all();
    }

    public function store(ExpenseRequest $request){
        return response()->json(Expense::create($request->all()), 201);
    }

    public function show(int $id){
        $expense = Expense::find($id);

        if($expense === null){
            return response()->json(['message' => 'Despesa não encontrada.'], 404);
        }

        return $expense;
    }

    public function update(int $id, Request $request){
        $expense = Expense::find($id);

        if($expense === null){
            return response()->json(['message' => 'Despesa não encontrada.'], 404);
        }

        $expense->fill($request->all());
        $expense->save();

        return $expense;
    }

    public function destroy(int $id){
        $expense = Expense::find($id);

        if($expense === null){
            return response()->json(['message' => 'Despesa não encontrada.'], 404);
        }

        Expense::destroy($id);
        return response()->noContent();
    }

    public function listingByMonth(int $year, int $month){
        $expense = Expense::whereYear('date', $year)->whereMonth('date', $month)->get();

        if(count($expense) == 0){
            return response()->json(['message' => 'Despesa não encontrada.'], 404);
        }

        return $expense;
    }
}
