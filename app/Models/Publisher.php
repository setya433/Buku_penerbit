<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillabel = ['name'];

    public function book(){
        return $this->hasMany(Book::class);
    }
}
