<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\BookStoreRequest;
use Symfony\Component\HttpFoundation\Response;
//use Illuminate\Database\Eloquent\Model;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Books = Book::all();
        $title = $request->input("title");
        $query = Book::query();

        //本のタイトルでの検索機能
        if(!empty($title)){
            $answer = $query->where('title', 'LIKE', "%{$title}%")->get();
            return response()->json([
                'answerBooks' => $answer
            ]);
        } else {
        //検索しなかった場合は全ての本の一覧表示
            return response()->json([
            'books' => $Books
        ]);
        }
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
        //本の詳細を表示
        if (!is_numeric($id) || $id <= 0) {
            return response()->json(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Invalid ID'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        $book = Book::find($id);

        if (!$book) {
            return response()->json(
                [
                    'code' => Response::HTTP_NOT_FOUND,
                    'message' => 'book not found'
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json($book);
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
