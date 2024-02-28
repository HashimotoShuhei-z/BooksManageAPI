<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\AuthorStoreRequest;
use Symfony\Component\HttpFoundation\Response;

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

            return response()->json([
                'authorName' => $answer->name,
                'authorBookData' => $Books
            ]);
     }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorStoreRequest $request)
    {
        //著者のデータを作成,更新
        $AuthorData = new Author;

        return response()->json([
            'message' => "authorData created successfully!",
            'authorData' => $AuthorData->updateOrCreate(
                ['id' => $request->id],
                ['name' => $request->name,
                 'author_id' => $request->author_id])
            ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //著者の詳細を表示
        if (!is_numeric($id) || $id <= 0) {
            return response()->json(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Invalid ID'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        $author = Author::find($id);

        if (!$author) {
            return response()->json(
                [
                    'code' => Response::HTTP_NOT_FOUND,
                    'message' => 'author not found'
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $Books[] = Author::find($id)->books;
        /* foreach ($Books as $Book) {
            $Data[] = $Book;
        } */

            return response()->json([
                'authorName' => $author->name,
                'authorBookData' => $Books
            ]);
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
