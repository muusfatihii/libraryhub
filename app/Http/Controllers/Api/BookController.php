<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Client;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->update_rating();



        return Book::all();

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'bookName' => 'required',
            'bookCover' => 'required|image',
            'bookCat' => 'required'
        ]);

        $pathCover = $request->file('bookCover')
                    ->store('public/covers');

        $filepath = explode('/',$pathCover);

        $lastpart = $filepath[count($filepath)-1];


        $book = Book::create([
            'title' => $request->bookName,
            'cover' => $lastpart
        ]);

        $book->categories()->attach($request->bookCat);


    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {   
        if($request->name!=''){

            DB::table('books')->where('id', '=', $id)->update(['title' => $request->name]);

        }

        if($request->cat!=''){


            DB::table('book_category')
                ->where('book_id', '=', $id)
                ->update(['category_id' => $request->cat]);

        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        DB::table('books')->where('id', '=', $id)->delete();
    }



    public function like(Request $request)
    {

        $created = DB::table('book_client')
        ->where('book_id','=',$request->bookid)
        ->where('client_id','=',$request->clientid)
        ->count();


        $liked = DB::table('book_client')
        ->where('book_id','=',$request->bookid)
        ->where('client_id','=',$request->clientid)
        ->where('like','=',1)
        ->count();


        $client = Client::find($request->clientid);

        if($created==0){

            $client->books()->attach($request->bookid,['like'=>1]);

        }else{

            if($liked==1){

                $client->books()->updateExistingPivot($request->bookid, [
                    'like' => 0,
                ]);
    
            }else{
    
                $client->books()->updateExistingPivot($request->bookid, [
                    'like' => 1,
                ]);
                     
            }

        }
        
    }


    public function rate(Request $request)
    {

        $created = DB::table('book_client')
        ->where('book_id','=',$request->bookid)
        ->where('client_id','=',$request->clientid)
        ->count();



        $client = Client::find($request->clientid);

        if($created==0){

            $client->books()->attach($request->bookid,['mark'=>$request->mark]);

        }else{

            $client->books()->updateExistingPivot($request->bookid,['mark'=>$request->mark]);

        }
        
    }



    public function addfav(Request $request)
    {

        $created = DB::table('book_client')
        ->where('book_id','=',$request->bookid)
        ->where('client_id','=',$request->clientid)
        ->count();

        $addedfav = DB::table('book_client')
        ->where('book_id','=',$request->bookid)
        ->where('client_id','=',$request->clientid)
        ->where('favourite','=',1)
        ->count();



        $client = Client::find($request->clientid);

        if($created==0){

            $client->books()->attach($request->bookid,['favourite'=>1]);

        }else{

            if($addedfav==1){

                $client->books()->updateExistingPivot($request->bookid,['favourite'=>0]);

            }else{

                $client->books()->updateExistingPivot($request->bookid,['favourite'=>1]);

            }

        }
        
    }


    public function createreadgrp(Request $request){

        $client = Client::find($request->clientid);

    
        $client->readingGroups()->create([
            'book_id' => $request->bookid,
        ]);


    }


    public function archive(Request $request)
    {
        DB::table('books')->where('id', '=', $request->idbook)->update(['archived' => true]);

    }


    public function unarchive(Request $request)
    {
        DB::table('books')->where('id', '=', $request->idbook)->update(['archived' => false]);

    }


    private function update_rating(){

        $books = Book::all();
        
        for($i=0;$i<count($books);$i++){

            $avg_mark = 0;

            $avg_mark = DB::table('book_client')
                ->where('book_id','=',$books[$i]->id)
                ->avg('mark');
            
            Book::where('id',$books[$i]->id)->update([

                'mark' => ceil($avg_mark)

            ]);
        
        }
    }


    public function myfavoris(){

        $idClient = $_GET['idClient'];

        $mayfavoris = DB::table('book_client')
                    ->join('books', 'book_client.book_id', '=', 'books.id')
                    ->where('book_client.client_id', '=', $idClient)
                    ->where('book_client.favourite', '=', 1)
                    ->select('book_client.like','book_client.mark as markk', 'books.id', 'books.title','books.cover','books.mark')
                    ->get();
                    
        return $mayfavoris;

    }


    public function filter(Request $request){

        if($request->desc==''){

            if($request->title=='' && $request->category==''){

                return Book::all();
    
            }else{
    
                if($request->title!='' && $request->category!=''){
    
                    return DB::table('book_category')
                            ->join('books', 'book_category.book_id', '=', 'books.id')
                            ->where('book_category.category_id', '=', $request->category)
                            ->where('books.title', 'like', '%'.$request->title.'%')
                            ->select('books.*')
                            ->get();
    
                    
    
    
                }else{
    
                    if($request->title!=''){
    
                        return DB::table('books')
                            ->where('title', 'like', '%'.$request->title.'%')
                            ->get();
    
    
                    }
    
                    if($request->category!=''){
    
                        return DB::table('book_category')
                            ->join('books', 'book_category.book_id', '=', 'books.id')
                            ->where('book_category.category_id', '=', $request->category)
                            ->select('books.*')
                            ->get();
    
                    }
    
                }
    
            }


        }else{

            if($request->title=='' && $request->category==''){

                return DB::table('books')
                       ->orderBy('created_at', 'desc')
                       ->get();
    
            }else{
    
                if($request->title!='' && $request->category!=''){
    
                    return DB::table('book_category')
                            ->join('books', 'book_category.book_id', '=', 'books.id')
                            ->where('book_category.category_id', '=', $request->category)
                            ->where('books.title', 'like', '%'.$request->title.'%')
                            ->select('books.*')
                            ->orderBy('created_at', 'desc')
                            ->get();
    
                    
    
    
                }else{
    
                    if($request->title!=''){
    
                        return DB::table('books')
                            ->where('title', 'like', '%'.$request->title.'%')
                            ->orderBy('created_at', 'desc')
                            ->get();
    
    
                    }
    
                    if($request->category!=''){
    
                        return DB::table('book_category')
                            ->join('books', 'book_category.book_id', '=', 'books.id')
                            ->where('book_category.category_id', '=', $request->category)
                            ->select('books.*')
                            ->orderBy('created_at', 'desc')
                            ->get();
    
                    }
    
                }
    
            }





        }
        
        
         
    }



    public function getratingdata(Request $request){

        $rats = DB::table('book_client')
                ->where('book_client.client_id', '=', $request->idclient)
                ->get();
        
        $result = [];

        for($i=0;$i<count($rats);$i++){

            $result[$i] =  $rats[$i]->book_id.$rats[$i]->mark.$rats[$i]->favourite.$rats[$i]->like;


        }

        return $result;

    }

}
