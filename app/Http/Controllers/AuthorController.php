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
    public function index(Request $request)
    {
        $name = $request->input("name");
        $query = Author::query();
        //著者の名前での検索機能
        if(!empty($name)){
            $answers = $query->where('name', 'LIKE', "%{$name}%")->get();
            foreach($answers as $answer){
            $Books[] = Author::find($answer->id)->books;
            }
        }

         foreach ($Books as $Book) {
            $Data[] = $Book;
        }
            return response()->json([
                'authorName' => $answer->name,
                'authorBookData' => $Data
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
