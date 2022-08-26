<?php

namespace App\Http\Controllers;

use App\Models\RecalculationHistory;
use App\Models\Type;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;

class FilterController extends Controller
{
    public function index()
    {
        $income = 0;
        $outgo = 0;
        $user = Auth()->user();

        $histories = RecalculationHistory::all()->where('user_id',$user->id);

        $income_users = $histories->where('type_id', 1);
        $outgo_users = $histories->where('type_id',2);

        foreach ($income_users as $income_user){$income = $income + $income_user->sum;}
        foreach ($outgo_users as $outgo_user){$outgo = $outgo + $outgo_user->sum;}

        $total = $income - $outgo;

        $types = Type::all();
        $dt = new DateTime();
        //dd($dt);

        return view('filter', compact('histories', 'types', 'dt', 'total', 'income', 'outgo'));
    }

    public function store(Request $request)
    {
        $user = Auth()->user();
        $from = $request->from;
        $to = $request->to;
        $type_id = $request->type_id;

        $dt = new DateTime();
        $types = Type::all();

        $histories = RecalculationHistory::all()->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->where('type_id', $type_id)
            ->where('user_id', $user);

        $total = 0;
        foreach ($histories as $history)
        {
            $total = $total + $history->sum;
        }

        return view('filter_answer', compact('histories', 'types', 'dt', 'total'));
    }
}


