<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Post $post, Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['uuid'] = Str::orderedUuid();
        $data['post_id'] = $post->id;

        Comment::create($data);
        return response()->json(['id' => $post->id]);
    }

    public function render_news($id)
    {
        $data = Comment::where('post_id', $id)->get();
        return response()->json(['data' => $data]);
    }
}
