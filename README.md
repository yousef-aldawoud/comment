# Comments package

Comment package is a laravel package that allows users to comment on any other model after setup.

# Installation

Installing package

```bash
composer require aldawoud/comments
```
Add routes to the `web.php` file by adding the following code.

```php
//web.php

Comment::routes();
```


# Implementation

Add an comment section ID column to the model you want to implement on.


```php
// 2020_01_01_create_blog_table.php
...
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("content");
            $table->string("comment_section_id");
            $table->timestamps();
        });
    }
...
```

# Routes

| Name | Request method | URL | Description | Example | Request parameters |
| --- | --- | --- | --- | --- | --- |
| get-comments | GET | /comment-section/{commentSectionId}/comments | Gets the comments for a comment section | /comment-section/1/comments | NONE |
| create-comment | POST | /comment-section/{commentSectionId}/ | creates new comment in a comment section | /comment-section/1/ | comment(the comment text) |
| get-comment-replies | GET | comment/{comment}/replies | Get replies for a comment using the id | /comment/1/replies | NONE |
| reply-to-comment | POST | comment/{comment}/reply | Replies to a comment | /comment/1/reply | comment(the comment text) |



# Customization

The comments replies can be nested or can be done into two layers only.
To change that you need to publish the package first.

```bash
php artisan vendor:publish 
```

*Output*
```
Which provider or tag's files would you like to publish?:
```

Select  `Provider: Aldawoud\Comments\CommentsServiceProvider` number

Then you can modify `nested` property in the comment model to true if you want replies to be nested and false if you want the replies to be two layered.

```php
protected static $nested = true;
```

