<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RecalculationHistory;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutgoController extends Controller
{
    public function index()
    {
        $outgo_categories = Category::where('type_id', Type::OUTGO)->get();
        return view('outgo', compact('outgo_categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sum'=>'required|integer',
            'comment' => 'nullable|string'
        ]);

        $user = Auth::user();

        $previous_total = RecalculationHistory::latest()->first();

        if(empty($previous_total->total))
        {
            return back()->withErrors(['msg' => 'у чету нету денег'])
                ->withInput();
        }

        if($request->sum > $previous_total->total)
        {
         return back()->withErrors(['msg' => 'Итог не должын быть меньше Суммы'])
             ->withInput();
        }

        $history = new RecalculationHistory($request->all());
        $history->total = $previous_total->total - $request->sum;

        $history->category()->associate($request->category_id);
        $history->type()->associate(Type::OUTGO);
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
