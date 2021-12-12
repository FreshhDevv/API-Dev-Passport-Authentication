<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
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

    }

    // SINGLE BOOK METHOD -GET
    public function singleBook($book_id) {

    }

    // UPDATE METHOD -POST 
    public function updateBook(Request $request, $book_id) {

    }

    // DELETE METHOD -GET
    public function deleteBook($book_id) {
        
    }
}
