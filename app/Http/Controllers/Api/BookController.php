<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author; 
use Illuminate\Http\Request;

class BookController extends Controller
{
    // CREATE METHOD - POST
    public function createBook(Request $request) {
        // validation
        $request -> validate([
            'title' => 'required',
            'book_cost' => 'required'
        ]);

        // create book data
        $book = new Book();

        $book -> author_id = auth()->user()->id;
        $book -> title = $request -> title;
        $book -> description = $request -> description;
        $book -> book_cost = $request -> book_cost;

        // save
        $book->save();
        // send response
        return response()->json([
            'status' => 1,
            'message' => 'Book created successfully'
        ]);

    }

    // LIST METHOD -GET
    public function listBooks() {
        $books = Book::get();

        return response()->json([
            'status' => 1,
            'message' => 'All Books',
            'data' => $books
        ]);

    }

    // AUTHOR BOOK METHOD -GET
    public function authorBooks() {
        $author_id = auth()->user()->id;
        $books = Author::find($author_id)->books;

        return response()->json([
            'status' => 1,
            'message' => 'Author Books',
            'data' => $books
        ]);
    }

    // SINGLE BOOK METHOD -GET
    public function singleBook($book_id) {
        $author_id = auth()->user()->id;

        if(Book::where([
            'author_id' => $author_id,
            'id' => $book_id
        ]) -> exists()){
            $book = Book::find($book_id);

            return response()->json([
                'status' => true,
                'message' => 'Book data found',
                'data' => $book
            ]);

        } else{
            return response()->json([
                'status' => false,
                'message' =>'Author Book does not exist'
            ]);
        }

    }

    // UPDATE METHOD -POST 
    public function updateBook(Request $request, $book_id) {
        $author_id = auth()->user()->id;

        if(Book::where([
            'author_id' => $author_id,
            'id' => $book_id
        ])->exists()){

            $book = Book::find($book_id);

            $book->title = isset($request->title)? $request->title : $book->title;
            $book->description = isset($request->description)? $request->description : $book->description;
            $book->book_cost = isset($request->book_cost)? $request->title : $book->book_cost;

            $book->save();

            return response()->json([
                'status' => 1,
                'message' => 'Book data has been updated'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'message' =>'Author Book does not exist'
            ]);

        }

    }

    // DELETE METHOD -GET
    public function deleteBook($book_id) {
        
    }
}
