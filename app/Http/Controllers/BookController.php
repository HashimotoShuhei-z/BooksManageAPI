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
        $title = $request->input("title");
        $query = Book::query();

        //本のタイトルでの検索機能
        if(!empty($title)){
            $query->where('title', 'LIKE', "%{$title}%");
        }

        return response()->json([
            'books' => $query->get()
        ],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        //本のデータを作成
        $BookData = Book::create($request->all());

        return response()->json(
            [
                'message' => "BookData created successfully!",
                'book' => $BookData
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
                    'message' => 'Book not found'
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json($book,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookStoreRequest $request, string $id)
    {
        //本のデータを更新処理を実装
        $query = Book::query();
        $query->where('id', $id);
        
        if ($query) {
            $query->update($request->all());

            return response()->json([
                'message'=> 'Book update',
                'book' => $request->all()
            ], 200);
        } else {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Book not found',
            ], Response::HTTP_NOT_FOUND);
        }

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
                    'message' => 'Book not found'
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $book->delete();

        return response()->json(
            [
                'message' => "BookData deleted successfully!",
                'book' => $book
            ],
            200
        );
    }
}
