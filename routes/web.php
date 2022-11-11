<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

use Illuminate\Support\Facades\DB;

/*
// CRUD With DB ROW
Route::get('insert', function() {
    $title = 'Second Title';
    $description = 'Second Description';
    DB::insert("INSERT INTO custom (title, description) VALUES ('$title','$description')");
});

Route::get('show', function() {
    return DB::select('SELECT * FROM custom ORDER BY id DESC');
});

Route::get('update', function() {
    $id = 2;
    $ttl = 'Updated title 2';
    $desc = 'Updated description 2';
    DB::update("UPDATE custom SET title='$ttl',description='$desc' WHERE id=$id");
});

Route::get('{id}/delete', function($id) {
    $delete = DB::delete("DELETE FROM `custom` WHERE id='$id'");
    if($delete) {
        echo "deleted Ok";
    } else {
        echo "deleted Failed";
    }
});
*/

/*
// CRUD With Eloquents

use App\Models\Post;
Route::get('/insert', function() {
    // Post::create([
    //     'title' => 'Post title 2', 
    //     'description' => 'Post description 2'
    // ]);
    $post = new Post;
    $post->title = 'Post title Two';
    $post->description = 'Post description Two';
    $post->save();
});

Route::get('/show', function() {
    return Post::all();
});

Route::get('/update', function() {
    $post = Post::find(1);
    $post->title = 'new Title 1';
    $post->description = 'new Description 1';
    $post->update();
});

Route::get('{id}/delete', function($id) {
    // $post = Post::findOrFail(1);
    // $post->delete();
    Post::destroy($id);
});

Route::get('/all', function() {
    return Post::withoutTrashed()->get();
});

Route::get('restore', function() {
    $deleted = Post::onlyTrashed();
    $deleted->restore();
});

Route::get('{id}/forcedelete', function($id) {
    Post::find($id)->forceDelete();
});
*/

// posts --> users 
// posts->user_id?

use App\Models\User;
use App\Models\Post;
// One To One Relationship
Route::get('user/{id}/post', function($id) {
    $user = User::findOrFail($id);
    return $user->post;
});

Route::get('post/{id}/user', function($id) {
    $post = Post::findOrFail($id);
    return $post->user;
});

// One To Many Relationship
Route::get('user/{id}/posts', function($id) {
    $user = User::findOrFail($id);
    return $user->posts;
});

// Many To Many Relationship
Route::get('user/{id}/roles', function($id) {
    $user = User::findOrFail($id);
    foreach($user->roles as $role) {
        echo $role->name;
        echo "<br />";
    }
});

use App\Models\Role;
Route::get('role/{id}/users', function($a) {
    $role = Role::where('id',1)->first();
    foreach($role->users as $user) {
        echo $user->name;
        echo $user->pivot->created_at;
        echo "<br />";
    }
});

use App\Models\Country;
Route::get('country/{id}/posts', function ($id) {
    $country = Country::find($id);
    foreach($country->posts as $post) {
        echo $post->title;
        echo "<br />";
    }
}); 

Route::get('user/{id}/images', function ($id) {
    $user = User::findOrFail($id);
    foreach($user->images as $image) {
        echo '<p>'.$image->image_alt.' '.$image->image_url.'</p>';
    }
});

use App\Models\Photo;
Route::get('image/{id}/user', function($id) {
    $image = Photo::findOrFail($id);
    return $image->imagable;
});

Route::get('post/{id}/images', function($id) {
    $post = Post::findOrFail($id);
    foreach($post->images as $image) {
        echo $image->image_url;
        echo "<br />";
    }
});

Route::get('image/{id}/post', function($id){
    $image = Photo::findOrFail($id);
    return $image->imagable;
});

// Many to Many PolyMorphic

use App\Models\Video;
Route::get('video/{id}/tags', function($id) {
    $video = Video::findOrFail($id);
    return $video->tags;
    // foreach($video->tags as $tag) {
    //     echo $tag->name;
    //     echo "<br />";
    // }
});

use App\Models\Tag;

Route::get('tag/{id}/videos', function($id) {
    $tag = Tag::findOrFail($id);
    return $tag->videos;
});

Route::get('post/{id}/tags', function($id) {
    $post = Post::findOrFail($id);
    return $post->tags;
});

Route::get('tag/{id}/posts', function($id) {
    $tag = Tag::findOrFail($id);
    return $tag->posts;
});

