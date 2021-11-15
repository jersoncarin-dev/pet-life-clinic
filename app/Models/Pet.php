<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory,SearchableTrait;

    public $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
