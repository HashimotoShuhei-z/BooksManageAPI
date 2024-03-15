<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    //ユーザーログイン機能
    public function userLogin(Request $request)
    {
        $email = $request->email;
        //バリデーション,$thisの部分が謎
        $credentials = $this->validator($request);

        //ログイン成功した場合
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $email)->first();
            //tokenを取得するユーザーの権限を設定
            $abilities = ['user'];

            //既存トークン削除
            $user->tokens()->delete();

            $user->email_verified_at = new Carbon('now');
            //userデータを更新
            $user->save();

            $result = [
                'token' => $user->createToken("login:user{$user->id}", $abilities)->plainTextToken,
            ];

            return response()->json($result, Response::HTTP_OK);
        }

        //ログイン失敗した場合
        return response()->json([
            'code' => Response::HTTP_UNAUTHORIZED,
            'message' => 'Unauthorized',
        ], Response::HTTP_UNAUTHORIZED);
    }

    //管理者ログイン機能
    public function adminLogin(Request $request)
    {
        $email = $request->email;
        //バリデーション,$thisの部分が謎
        $credentials = $this->validator($request);

        //ログイン成功した場合
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Admin::where('email', $email)->first();
            //tokenを取得するユーザーの権限を設定
            $abilities = ['admin'];

            //既存トークン削除
            $admin->tokens()->delete();

            $admin->email_verified_at = new Carbon('now');
            //adminデータを更新
            $admin->save();

            $result = [
                'token' => $admin->createToken("login:admin{$admin->id}", $abilities)->plainTextToken,
            ];

            return response()->json($result, Response::HTTP_OK);
        }

        //ログイン失敗した場合
        return response()->json([
            'code' => Response::HTTP_UNAUTHORIZED,
            'message' => 'Unauthorized',
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @return array
     */
    protected function validator(Request $request)
    {
        return $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
    }

    //ログインしたユーザー情報取得
    public function user(Request $request)
    {
        return response()->json([
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }

    //ログアウト機能
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'ログアウトしました。'], 200);
    }
}
