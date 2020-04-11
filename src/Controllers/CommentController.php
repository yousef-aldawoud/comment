<?php

namespace Aldawoud\Comments\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Aldawoud\Comments\CommentSection;
use Aldawoud\Comments\Comment;
use Aldawoud\Comments\Requests\CreateCommentRequest;
use App\User;

class CommentController extends Controller {

    public function get(CommentSection $commentSection){
        $comments = $commentSection->comments()->where("reply_user_id",null)->paginate();
        $comments->map(function($comment){
            $user = $comment->user()->first();
            $comment['user']= $user !== null ? $user->name : "" ;
            $comment['number_of_replies']= $comment->replies()->count();
            return $comment;
        });
        return $comments;

        
    }

    public function create(CommentSection $commentSection, CreateCommentRequest $request){
        return Comment::createComment($commentSection, $request->comment);
    }

    public function getReplies(Comment $comment){
        $comments = $comment->replies()->paginate();
        $comments->map(function($comment){
            $user = $comment->user()->first();
            $comment['user']= $user !== null ? $user->name : "" ;
            $replyUser = User::find($comment->reply_user_id);
            $comment['reply_user_name'] = $replyUser !== null ? $replyUser->name : "Anonymos";
            $comment['number_of_replies']= $comment->replies()->count();
            return $comment;
        });
        return $comments;
    }

    public function reply(Comment $comment,CreateCommentRequest $request){
        return $comment->reply($request->comment);
    }
}
