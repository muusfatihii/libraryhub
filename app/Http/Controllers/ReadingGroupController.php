<?php

namespace App\Http\Controllers;

use App\Models\ReadingGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class ReadingGroupController extends Controller
{
    public function index(){

        if(isset(Auth::user()->id)){

            $allOtherReadingGroups = DB::table('reading_groups')
                                ->where('client_id', '<>', Auth::user()->id)
                                ->get();

        }else{

            $allOtherReadingGroups = DB::table('reading_groups')
                                     ->get();

        }

        

        return view('readinggroup', [
            'readinggroups' => $allOtherReadingGroups
        ]);

    }


    public function readinggroups(){

        return view('readinggroups');

    }


    public function myreadgroups(){

        return view('myreadgroups');
        
    }

}
