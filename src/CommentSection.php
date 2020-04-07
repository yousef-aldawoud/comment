<?php

namespace Aldawoud\Comments;

use Illuminate\Database\Eloquent\Model;

class CommentSection extends Model{
    protected $table = 'comment_sections';

    public function comments(){
        return $this->hasMany("Aldawoud\Comments\Comment");
    }
} 
