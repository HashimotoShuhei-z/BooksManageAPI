<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\BookStoreRequest;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$Books = Book::all();
        $title = $request->input("title");
        $query = Book::query();

        //本のタイトルでの検索機能
        if(!empty($title)){
            $query->where('title', 'LIKE', "%{$title}%");
        }

        $books = $query->get();

        return response()->json([
            'booksData' => $books
        ],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        //本のデータを作成、更新
        $BookData = new Book;

        return response()->json(
            [
                'message' => "bookData created successfully!",
                'bookData' => $BookData->updateOrCreate(
                    ['id' => $request->id],
                    [
                        'title' => $request->title,
                        'author_id' => $request->author_id
                    ]
                )
            ],
            200
        );

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

        return response()->json($book,200);
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
        //本の削除処理を実装
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

        $book->delete();

        return response()->json(
            [
                'message' => "bookData deleted successfully!",
                'bookData' => $book
            ],
            200
        );
    }
}
