<?php
namespace Aldawoud\Comments;
use Illuminate\Support\ServiceProvider;

class CommentsServiceProvider extends ServiceProvider {


    public function boot(){
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([
            __DIR__.'/migrations' => database_path('migrations'),
            __DIR__.'/Comment.php' => base_path('app/Comments/Comment.php'),
            __DIR__.'/CommentSection.php' => base_path('app/Comments/CommentSection.php'),
            __DIR__.'/Controllers' => base_path('app/Http/Controllers/CommentsController/'),
        ], 'comments-migrations');
        
    }

    public function register(){
        
    }
}
