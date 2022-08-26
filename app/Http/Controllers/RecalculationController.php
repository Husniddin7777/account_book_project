<?php

namespace App\Http\Controllers;

use App\Models\RecalculationHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecalculationController extends Controller
{


    public function index(Request $request ){

        $income = 0;
        $outgo = 0;
        $user = Auth()->user();

        $histories = RecalculationHistory::all()->where('user_id',$user->id);

        $income_users = $histories->where('type_id', 1);
        $outgo_users = $histories->where('type_id',2);

        foreach ($income_users as $income_user){$income = $income + $income_user->sum;}
        foreach ($outgo_users as $outgo_user){$outgo = $outgo + $outgo_user->sum;}

        $total = $income - $outgo;

        return view('index', compact('histories', 'total', 'income', 'outgo'));
    }

}
