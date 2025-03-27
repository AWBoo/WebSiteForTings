<?php

namespace App\Http\Controllers;

use App\Models\ImagePost;
use App\Models\TextPost;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\Relation;


use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postType, $postId)
    {
        $request->validate([
            'comment' => 'required|max:250',
        ]);
    
        // Resolve the model based on the morph map
        $postModel = Relation::getMorphedModel($postType);
    
        if (!$postModel) {
            return back()->with('error', 'Invalid post type.');
        }
    
        // Find the post
        $post = $postModel::find($postId);
    
        if (!$post) {
            return back()->with('error', 'Post not found.');
        }
    
        // Save the comment
        $comment = new Comment([
            'user_id' => auth()->id(),
            'content' => $request->comment,
        ]);
    
        // Save comment to the post's comments relation
        $post->comments()->save($comment);
    
        return back();
    }
}
