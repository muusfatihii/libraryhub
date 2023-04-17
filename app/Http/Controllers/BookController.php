<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Client;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    
    public function index(){

        $this->update_rating();

       
        if(isset(Auth::user()->id)){

            $books = DB::table('books')
                ->select('books.id','books.mark', 'books.title', 'books.cover')
                ->where('books.archived', '=', 0)
                ->get();

                
            
            $rats = DB::table('book_client')
                ->where('book_client.client_id', '=', Auth::user()->id)
                ->get();

                // var_dump($rats);
                // die();

            
            return view('books', [
                'books' => $books,
                'rats' => $rats
            ]);


        }else{


            $books = DB::table('books')
                     ->select('books.id','books.mark', 'books.title', 'books.cover')
                     ->where('books.archived', '=', 0)
                     ->get();

        }
        
        return view('books', [
            'books' => $books
        ]);


    }


    public function addbook(){
        
        return view('addbook');

    }


    public function addcategory(){
        
        return view('addcategory');

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


    public function booksadmin(){


        return view('booksadmin');


    }


    
}
