<?php

namespace Aldawoud\Comments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Comment extends Model{
    protected $table = 'comments';

    protected static $nested = true;

    public function user(){
        return $this->belongsTo("App\User");
    }
    
    public function replies(){
        return $this->hasMany("\Aldawoud\Comments\Comment","reply_comment_id");
    }

    public static function routes(){
        Route::namespace('\Aldawoud\Comments\Controllers')->group(function () {
            Route::get("comment-section/{commentSection}/comments","CommentController@get")->name("get-comments");
            Route::post("comment-section/{commentSection}/","CommentController@create")->name("create-comment");
            Route::get("comment/{comment}/replies","CommentController@getReplies")->name("get-comment-replies");
            Route::post("comment/{comment}/reply","CommentController@reply")->name("reply-to-comment");
        });
    }

    public function reply(string $comment){
        if(auth()->user()===null){
            return false;
        }
        $reply = new Comment;
        $reply->comment = $comment;
        $reply->comment_section_id = $this->comment_section_id;
        $reply->reply_user_id = $this->user_id;
        if(self::$nested){
            $reply->reply_comment_id = $this->id;
        }else{
            $reply->reply_comment_id = $this->reply_comment_id === null ? $this->id : $this->reply_comment_id;
        }
        $reply->user_id = auth()->user()->id;
        $reply->save();
        return $reply;

    }

    public static function createComment(CommentSection $commentSection,string $commentTxt){
        if(auth()->user()===null){
            return false;
        }
        $comment = new Comment;
        $comment->comment = $commentTxt;
        $comment->comment_section_id = $commentSection->id;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return $comment;
    }
    
} 

