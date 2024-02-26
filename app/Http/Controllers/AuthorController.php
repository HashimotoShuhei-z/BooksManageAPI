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
        //著者の一覧取得
        $Authors = Author::all();

        return response()->json([
            'status' => true,
            'Authors' => $Authors
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorStoreRequest $request)
    {
        //著者のデータを作成
        $AuthorData = new Author;

        $AuthorData->id = $request->id;
        $AuthorData->name = $request->name;

        //なぜかupdate_atとcreated_atが自動的に追加されてしまうため、記述
        $AuthorData->timestamps = false;

        $AuthorData->save();

        return response()->json([
        'status' => true,
        'message' => "AuthorData Created successfully!",
        'AuthorData' => $AuthorData
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
