<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillabel = ['name'];

    public function book(){
        return $this->hasMany(Book::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}
