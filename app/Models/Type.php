<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //use HasFactory;
    const INCOME = 1;
    const OUTGO = 2;

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function recalculationHistories()
    {
        return $this->hasMany(RecalculationHistory::class);
    }

}
