<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RecalculationHistory extends Model
{

    protected $table ='recalculation_histories';
    protected $fillable = ['sum','total','comment'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
