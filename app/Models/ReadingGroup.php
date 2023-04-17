<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingGroup extends Model
{
    use HasFactory;


    protected $fillable = ['book_id','client_id'];


    public function creator(){

        return $this->belongsTo(Client::class);

    }


    public function book(){

        return $this->hasOne(Book::class);
    }


    public function members(){

        return $this->belongsToMany(Client::class,'client_reading_groups');

    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
