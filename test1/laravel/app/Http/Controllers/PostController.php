<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // 驗證輸入資料
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // 新增 Post 資料
        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        // 回傳新增成功訊息
        return response()->json(['message' => 'Post created successfully'], 201);
    }
}