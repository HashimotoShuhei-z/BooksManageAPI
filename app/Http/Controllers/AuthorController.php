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
                $author_data[] = [
                    'authorName' => $answer->name,
                    'book' => $answer->books
                ];
            }
                //著者の名前も一緒に表示したい
                return response()->json([
                    'answer' => $author_data
                ],200);

        } else {
            //検索されなかった場合は著者の一覧を表示
            return response()->json([
                'authors' => $query->get()
            ],200);
        }
     }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorStoreRequest $request)
    {
        //著者のデータを作成
        $AuthorData = Author::create($request->all());

        return response()->json(
            [
                'message' => "authorData created successfully!",
                'book' => $AuthorData
            ],
            200
        );
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

        $Books[] = $author->books;

            return response()->json(
                [
                    'authorName' => $author->name,
                    'book' => $Books
                ]
                ,200
            );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorStoreRequest $request, string $id)
    {
        //著者のデータを更新処理を実装
        $query = Author::query();
        $query->where('id', $id);

        if ($query) {
            $query->update($request->all());

            return response()->json([
                'message'=> 'Author update',
                'Author' => $request->all()
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
        //著者の削除処理を実装
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

        $author->delete();

        return response()->json(
            [
                'message' => "authorData deleted successfully!",
                'book' => $author
            ],
            200
        );
    }
}
