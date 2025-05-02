<?php


use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\web\backend\CategoryController;
use App\Http\Controllers\web\backend\SessionController;
use App\Http\Controllers\web\backend\SiteController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::match(['get','post'],'/home', [HomeController::class, 'home']);
Route::match(['get','post'],'/contact', [HomeController::class, 'contact']);

Route::get('/category', [CategoryController::class, 'category']);
Route::get('/user-form', [CategoryController::class, 'userForm']);
Route::post('/user-form-update/{id}', [CategoryController::class, 'userFormUpdate']);
Route::post('/user-form-delete/{id}', [CategoryController::class, 'userFormDelete']);

Route::get('/', [SiteController::class, 'home']);
Route::get('/about', [SiteController::class, 'about']);
Route::get('/course', [SiteController::class, 'course']);
Route::get('/signin', [SiteController::class, 'signin']);
Route::get('/signup', [SiteController::class, 'signup']);
Route::get('/form', [SiteController::class, 'form']);


// Route::get('/test', [HomeController::class, 'test'])->middleware(AdminMiddleware::class);

Route::middleware([AdminMiddleware::class])->group(function(){
    Route::get('/test', [HomeController::class, 'test']);
});


Route::get('/set-session', [SessionController::class, 'setSession']);
Route::get('/get-session', [SessionController::class, 'getSession']);

Route::get('/view-show', [SessionController::class, 'viewShow']);
Route::get('/update-session', [SessionController::class, 'updateSession']);
Route::get('/delete-session', [SessionController::class, 'deleteSession']);


Route::get('/show', [QueryController::class,'show']);
Route::get('/book', [QueryController::class,'book']);

Route::get('/form-create', [FormController::class, 'formCreate']);
Route::post('/form-store', [FormController::class, 'storeForm']);
Route::get('/form-index', [FormController::class, 'index']);
Route::get('/form-read', [FormController::class, 'redForm'])->name('read.data');
Route::delete('/form-delete/{id}', [FormController::class, 'deleteForm'])->name('delete.data');
