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
            'status' => true,
            'Books' => $Books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        //本のデータを作成
        $BookData = new Book;

        $BookData->id = $request->id;
        $BookData->title = $request->title;
        $BookData->author_id = $request->author_id;

        //なぜかupdate_atとcreated_atが自動的に追加されてしまうため、記述
        $BookData->timestamps = false;

        $BookData->save();

        return response()->json([
        'status' => true,
        'message' => "BookData Created successfully!",
        'BookData' => $BookData
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
