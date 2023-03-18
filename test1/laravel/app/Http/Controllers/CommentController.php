<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        // 驗證輸入資料
        $request->validate([
            'message' => 'required',
        ]);

        // 檢查該 post 是否存在
        $post = Post::find($post_id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // 新增 Comment 資料，並將該 comment 與該 post 相關聯
        $comment = new Comment([
            'message' => $request->input('message'),
        ]);
        $post->comments()->save($comment);

        // 回傳新增成功訊息
        return response()->json(['message' => 'Comment created successfully'], 201);
    }
}
