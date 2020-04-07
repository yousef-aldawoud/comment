<?php
namespace Aldawoud\Comments;
use Illuminate\Support\ServiceProvider;

class CommentsServiceProvider extends ServiceProvider {


    public function boot(){
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    public function register(){
        
    }
}