<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;


    protected $fillable = ['id','name'];

    public function books(){

        return $this->belongsToMany(Book::class);
    }

// -------------------creation-----------------
    public function readingGroups(){

        return $this->hasMany(ReadingGroup::class);
    
    }
//------------------------------------------------


public function rgoups(){

    return $this->belongsToMany(ReadingGroup::class,'client_reading_groups');

}



}
