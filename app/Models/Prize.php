<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    //

    protected $fillable = [
        "title",
        "description",
        "price",
        "raffle_id",
    ];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function winners(){
        return $this->hasOne(Winner::class);
    }

}
