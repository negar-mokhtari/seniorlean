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



Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [\App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['is_admin','auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Admin\Dashboard\DashboardController::class,'index'])->name('dashboard');
    Route::get('/users',[\App\Http\Controllers\Admin\User\UserController::class,'index'])->name('users');
    Route::put('/users/{id}/{is_admin}',[\App\Http\Controllers\Admin\User\UserController::class,'changeLevel'])->name('changeLevel');
    /*
    * sortable
    */
    Route::post('/sliders-datatable/',[\App\Http\Controllers\Admin\Slider\SortableController::class,'updatePrioritySliders'])->name('sliders.sortable');

    /*
    * ajax
    */
    Route::post('/courses-ajax/',[\App\Http\Controllers\Admin\Course\AjaxinfoController::class,'getCourses'])->name('courses.ajax');
    Route::post('/lessons-ajax/',[\App\Http\Controllers\Admin\Lesson\AjaxinfoController::class,'getLessons'])->name('lessons.ajax');
    Route::post('/categories-ajax/',[\App\Http\Controllers\Admin\Category\AjaxinfoController::class,'getCategories'])->name('categories.ajax');
    Route::post('/contents-ajax/',[\App\Http\Controllers\Admin\Content\AjaxinfoController::class,'getContents'])->name('contents.ajax');
    Route::post('/groups-ajax/',[\App\Http\Controllers\Admin\Group\AjaxinfoController::class,'getGroups'])->name('groups.ajax');


    /*
   * resource
   */
    Route::resource('courses',\App\Http\Controllers\Admin\Course\CourseController::class);
    Route::resource('parts',\App\Http\Controllers\Admin\Part\PartController::class);
    Route::resource('lessons',\App\Http\Controllers\Admin\Lesson\LessonController::class);
    Route::resource('quizzes',\App\Http\Controllers\Admin\Quiz\QuizController::class);
    Route::resource('questions',\App\Http\Controllers\Admin\Question\QuestionController::class);
    Route::resource('categories',\App\Http\Controllers\Admin\Category\CategoryController::class);
    Route::resource('contents',\App\Http\Controllers\Admin\Content\ContentController::class);
    Route::resource('groups',\App\Http\Controllers\Admin\Group\GroupController::class);
    Route::resource('cards',\App\Http\Controllers\Admin\Card\CardController::class);
    Route::resource('sliders',\App\Http\Controllers\Admin\Slider\SliderController::class);



    Route::get('/phpinfo', function () {
        return phpinfo();
    });

    /*
    * buy
    */
//    Route::post('cart/add/{course}','CartController@addToCart');
    Route::get('/cartA',function(){
//        dd(app('cart'));
        dd(Cart::get('2'));
    });

});









/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        echo 'hi user';
    })->name('dashboard');
    /*
    * buy
    */
    Route::post('cart/add/{course}', [\App\Http\Controllers\User\Cart\CartController::class,'addToCart'])->name('cart.add');
    Route::delete('cart/delete/{cart}', [\App\Http\Controllers\User\Cart\CartController::class,'deleteFromCart'])->name('cart.destroy');

    Route::post('payment' ,
        [\App\Http\Controllers\User\Payment\PaymentController::class,'payment'])
        ->name('cart.payment');

    Route::post('payment/callback' ,
        [\App\Http\Controllers\User\Payment\PaymentController::class,'callback'])
        ->name('payment.callback');
});


/*
|--------------------------------------------------------------------------
| EndUser Routes
|--------------------------------------------------------------------------
*/


Route::name('endUser.')->group(function(){
    Route::get('/', function () {return view('end-user.layout.welcome');})->name('welcome');
    Route::resource('contents',\App\Http\Controllers\EndUser\Content\ContentController::class)->only('index','show');
    Route::resource('courses',\App\Http\Controllers\EndUser\Course\CourseController::class)->only('index','show');
    Route::get('/app',function (){return view('end-user.layout.app');});
});
