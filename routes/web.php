<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;


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

use App\Models\Image;

Route::get('/', function () {
    /*
    $images = Image::all();
    foreach($images as $image) {
        echo $image->image_path . '<br>';
        echo $image->description . '<br>';
        echo $image->user->name.' '.$image->user->surname . '<br>';
        if(count($image->comments) >= 1) {
            echo '<strong>Comentarios</strong>' . '<br>';
            foreach($image->comments as $comment) {
                echo $comment->user->name.' '.$comment->user->surname . '<br>';
                echo $comment->content . '<br>';
            }
            
        }
        echo 'LIKES: ' . count($image->likes) . '<br>';
        echo "<hr>";
    }
    die();
    */
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/configuracion', [UserController::class, 'config'])->name('config');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [UserController::class, 'getImage'])->name('user.avatar');
Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
Route::get('/fetch-all', [UserController::class, 'fetchAll'])->name('users.all');
Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
//Route::post('/user/update', [UserController::class, 'up'])->name('user.updates');