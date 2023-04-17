<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title','cover'];


    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function categories(){

        return $this->belongsToMany(Category::class);
    }

    public function clients(){

        return $this->belongsToMany(Client::class);
    }

    public function readingGroups(){

        return $this->hasMany(ReadingGroup::class);
    }

}
