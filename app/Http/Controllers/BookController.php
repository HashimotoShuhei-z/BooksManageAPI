<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\BookStoreRequest;
//use Illuminate\Database\Eloquent\Model;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //本の一覧取得
        $Books = Book::all();

        return response()->json([
            'books' => $Books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        //本のデータを作成
        $BookData = new Book;

        $BookData->title = $request->title;
        $BookData->author_id = $request->author_id;

        $BookData->save();

        return response()->json([
        'message' => "bookData created successfully!",
        'bookData' => $BookData
        ], 200);

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
        //
    }
}
