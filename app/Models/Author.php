<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $dates =  ['created_at', 'updated_at'];

    public function CatchBooks()
    {
        return $this->hasMany('App\Models\Book');
    }
}
