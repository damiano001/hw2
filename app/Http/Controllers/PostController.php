<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function fetchPosts()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
    
        return response()->json($posts);
    }
    
    
public function likePost(Request $request)
{
    $postId = $request->input('postId');
    $username = Auth::user()->username;

    $post = Post::find($postId);

    if (!$post) {
        return response()->json(['status' => 'error', 'message' => 'Post not found']);
    }

    $like = Like::where('post_id', $postId)
        ->where('username', $username)
        ->first();

    if ($like) {
        return response()->json(['status' => 'error', 'message' => 'You have already liked this post']);
    }

    $like = new Like();
    $like->post_id = $postId;
    $like->username = $username;
    $like->save();

    DB::table('posts')->where('id', $postId)->increment('likes');

    return response()->json(['status' => 'success', 'message' => 'Post liked']);
}

public function unlikePost(Request $request)
{
    $postId = $request->input('postId');
    $username = Auth::user()->username;

    $post = Post::find($postId);

    if (!$post) {
        return response()->json(['status' => 'error', 'message' => 'Post not found']);
    }

    $like = Like::where('post_id', $postId)
        ->where('username', $username)
        ->first();

    if (!$like) {
        return response()->json(['status' => 'error', 'message' => 'You have not liked this post']);
    }

    $like->delete();

    $post->likes -= 1;
    $post->save();

    return response()->json(['status' => 'success', 'message' => 'Post unliked']);
}

public function removePost(Request $request)
{
    $postId = $request->input('postId');

    $post = Post::find($postId);

    if (!$post) {
        return response()->json(['status' => 'error', 'message' => 'Post not found']);
    }

    if ($post->username !== Auth::user()->username) {
        return response()->json(['status' => 'error', 'message' => 'Unauthorized']);
    }

    $post->delete();

    return response()->json(['status' => 'success', 'message' => 'Post removed']);
}


    public function fetchComments(Request $request)
{
    $postId = $request->input('postId');
    $comments = Comment::where('post_id', $postId)->get();

    return response()->json(['status' => 'success', 'comments' => $comments]);
}

    public function submitComment(Request $request)
{
    $postId = $request->input('postId');
    $commentContent = $request->input('commentContent');
    $username = Auth::user()->username;

    $comment = new Comment();
    $comment->post_id = $postId;
    $comment->username = $username;
    $comment->comment_content = $commentContent;
    $comment->save();

    return response()->json(['status' => 'success', 'message' => 'Comment submitted']);
}

    public function checkLike(Request $request)
    {
        $postId = $request->input('postId');
        $username = Auth::user()->username;

        $like = Like::where('post_id', $postId)
            ->where('username', $username)
            ->exists();

        return response()->json(['liked' => $like]);
    }
}
