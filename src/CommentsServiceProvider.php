<?php
namespace Aldawoud\Comments;
use Illuminate\Support\ServiceProvider;

class CommentsServiceProvider extends ServiceProvider {


    public function boot(){
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([
            __DIR__.'/migrations' => database_path('migrations')
        ], 'migrations');
    }

    public function register(){
        
    }
}