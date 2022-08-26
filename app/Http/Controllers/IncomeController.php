<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RecalculationHistory;
use App\Models\Type;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $income_categories = Category::where('type_id', Type::INCOME)->get();
        return view('income', compact('income_categories'));
    }

    public function store(Request $request)
    {
           $this->validate($request, [
               'sum'=>'required|integer',
               'comment' => 'nullable|string'
           ]);

           if($request->sum <= 0){
               return back()->withErrors(['msg' => 'Даход не должен быть менше нуля'])
                   ->withInput();
           }

           $previous_total = RecalculationHistory::latest()->first();
           $user = Auth()->user();
           //dd($user);

           $history = new RecalculationHistory($request->all());
           if(empty($previous_total->total))
           {
               $history->total = 0 + $request->sum;
           }
           else{
               $history->total = $previous_total->total + $request->sum;
           }

           $history->category()->associate($request->category_id);
           $history->type()->associate(Type::INCOME);
           //$history->type()->associate($request->type_id);
           $history->user()->associate($user->id);
           $history->save();

           if($history)
           {
               return redirect()->route('income.index')
                   ->with(['success' => 'Успешно сохранено']);
           }

           else
           {
               return back()->withErrors(['msg' => 'Ошибка сохранения'])
                   ->withInput();
           }


    }
}
