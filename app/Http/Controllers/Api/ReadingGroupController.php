<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\ReadingGroup;

use Illuminate\Support\Facades\DB;


class ReadingGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ReadingGroup::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('reading_groups')->where('id', '=', $id)->delete();
    }


    public function joinreadgrp(Request $request){


        $rdgrp = ReadingGroup::find($request->readgrpid);

        $rdgrp->members()->attach($request->clientid);

        $this->updateRdgrpMembers($request->readgrpid);


    }

    public function myreadgroups(Request $request){

        return  DB::table('reading_groups')
                ->where('client_id', '=', $request->idclient)
                ->get();

    }

    public function myreadinggroups(){

        $idclient = $_GET['idclient'];

        return  DB::table('reading_groups')
                ->join('books', 'reading_groups.book_id', '=', 'books.id')
                ->where('client_id', '=', $idclient)
                ->select('reading_groups.id', 'reading_groups.name','reading_groups.members', 'books.title')
                ->get();



    }

    public function readinggroups(Request $request){

        return  DB::table('client_reading_groups')
                ->join('reading_groups', 'client_reading_groups.reading_group_id', '=', 'reading_groups.id')
                ->join('books', 'reading_groups.book_id', '=', 'books.id')                
                ->where('client_reading_groups.client_id', '=', $request->idclient)
                ->select('reading_groups.id', 'reading_groups.name','reading_groups.members', 'books.title')
                ->get();

    }

    public function quitter(Request $request){

        DB::table('client_reading_groups')
            ->where('reading_group_id', '=', $request->idreadgroup)
            ->where('client_id', '=', $request->idclient)
            ->delete();
        
        $this->updateeRdgrpMembers($request->idreadgroup);

    }


    


    public function comments(Request $request){

       
        return  DB::table('comments')
                ->where('reading_group_id', '=', $request->idreadgroup)
                ->get();


    }


    public function deletecomment(Request $request){

        return  DB::table('comments')
                ->where('id', '=', $request->idcomment)
                ->where('client_id', '=', $request->idclient)
                ->delete();

    }


    public function addcomment(Request $request){


        Comment::create(['client_id' => $request->idclient,
        'reading_group_id' => $request->idreadinggroup,
        'content' => $request->content
        ]);


    }

    private function updateRdgrpMembers($readgrpid){

        DB::table('reading_groups')->where('id', '=', $readgrpid)->increment('members');

    }

    private function updateeRdgrpMembers($readgrpid){

        DB::table('reading_groups')->where('id', '=', $readgrpid)->decrement('members');

    }


    

}
