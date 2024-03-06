<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title','author_id'];
    protected $dates =  ['created_at', 'updated_at'];

    public function CatchAuthors()
    {
        return $this->belongsTo('App\Models\Author');
    }
}
