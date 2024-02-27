<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\AuthorStoreRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Books = Author::find(1)->books;

        foreach ($Books as $Book) {
            $Data[] = $Book;
        }
        
            return response()->json([
                'author_id=1_Data' => $Data
            ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorStoreRequest $request)
    {
        //著者のデータを作成
        $AuthorData = new Author;

        $AuthorData->name = $request->name;

        $AuthorData->save();

        return response()->json([
        'message' => "authorData Created successfully!",
        'authorData' => $AuthorData
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
