<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    //

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
        'lottery_name'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function prizes()
    {
        return $this->hasMany(Prize::class);
    }

    public function winners()
    {
        return $this->hasMany(Winner::class);
    }
}
