<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Revenue;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function showResume(int $year, int $month){
        $totalRevenue = Revenue::whereYear('date', $year)->whereMonth('date', $month)->sum('value');
        $totalExpense = Expense::whereYear('date', $year)->whereMonth('date', $month)->sum('value');

        $expenses = Expense::whereYear('date', $year)->whereMonth('date', $month)
            ->selectRaw('sum(value) as value')->selectRaw("category")->groupBy('category')->get();

        $category = array(
            'Alimentação' =>  0,
            'Saúde' =>  0,
            'Moradia' =>  0,
            'Transporte' =>  0,
            'Educação' =>  0,
            'Lazer' =>  0,
            'Imprevistos' =>  0,
            'Outras' =>  0,
        );

        foreach ($expenses as $expense){
            if($expense->category == 'Alimentação'){
                $category['Alimentação'] = $expense->value;
            }
            if($expense->category == 'Saúde'){
                $category['Saúde'] = $expense->value;
            }
            if($expense->category == 'Moradia'){
                $category['Moradia'] = $expense->value;
            }
            if($expense->category == 'Transporte'){
                $category['Transporte'] = $expense->value;
            }
            if($expense->category == 'Educação'){
                $category['Educação'] = $expense->value;
            }
            if($expense->category == 'Lazer'){
                $category['Lazer'] = $expense->value;
            }
            if($expense->category == 'Imprevistos'){
                $category['Imprevistos'] = $expense->value;
            }
            if($expense->category == 'Outras'){
                $category['Outras'] = $expense->value;
            }
        }

        $total = $totalRevenue + $totalExpense;

        return response()->json(
            ['message' => [
                            'Valor total das receitas no mês: R$' . number_format($totalRevenue, 2, ',', '.'),
                            'Valor total das despesas no mês: R$' . number_format($totalExpense, 2, ',', '.'),
                            'Saldo final no mês: R$' . number_format($total, 2, ',', '.'),
                            'Valor total gasto Alimentação: R$' . number_format($category['Alimentação'], 2, ',', '.'),
                            'Valor total gasto Saúde: R$' . number_format($category['Saúde'], 2, ',', '.'),
                            'Valor total gasto Moradia: R$' . number_format($category['Moradia'], 2, ',', '.'),
                            'Valor total gasto Transporte: R$' . number_format($category['Transporte'], 2, ',', '.'),
                            'Valor total gasto Educação: R$' . number_format($category['Educação'], 2, ',', '.'),
                            'Valor total gasto Lazer: R$' . number_format($category['Lazer'], 2, ',', '.'),
                            'Valor total gasto Imprevistos: R$' . number_format($category['Imprevistos'], 2, ',', '.'),
                            'Valor total gasto Outras: R$' . number_format($category['Outras'], 2, ',', '.'),
                        ]
            ], 200);

    }
}
