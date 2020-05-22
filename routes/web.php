<?php

use App\Bulong\Feeds\Feed;

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

// Route::get('test', function () {
//     auth()->user()->createToken('MyApp')->accessToken;
//     dd('ok');
// });


// Route::get('/{any}', 'SpaController@index')->where('any', '.*');

Auth::routes();
Route::get('admin/login', 'Admin\LoginController@showLoginForm');

/** Frontend Routes */
Route::group(['namespace' => 'Front', 'middleware' => 'auth'], function () {
    Route::get('/', 'IndexController@index')->name('index');
});
/** Frontend Routes */

Route::get('/background-images', 'Front\BackgroundImagesController@index');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');

Route::get('user/{username}', 'Front\UserProfileController@index');
Route::get('{userId}/confessions', 'Front\ConfessionController@getUserConfessions');
Route::patch('confession/{id}/update', 'Front\ConfessionController@update');
Route::delete('confessions/{id}', 'Front\ConfessionController@destroy');

Route::get('feeds', 'Front\HomeController@index')->name('feeds');
Route::post('feeds/store', 'Front\HomeController@store')->name('feeds.store');
Route::post('feeds/like', 'Front\FeedController@like')->name('feeds.like');
Route::post('feeds/comment', 'Front\CommentController@store')->name('feeds.comment');

/** Report Confession Controller */
Route::post('report-confession/{id}', 'Front\ReportConfessionController@report');

/** Follow Routes */
Route::post('follow/{username}', 'Front\FollowController@follow');
Route::post('unfollow/{username}', 'Front\FollowController@unfollow');


/** Confession Routes */
Route::get('confessions', 'Front\ConfessionController@index');
Route::post('confession/create', 'Front\ConfessionController@store');
Route::get('trending-confessions', 'Front\TrendingConfessionController@index');
Route::get('following-people-confessions', 'Front\FollowingPeopleConfessionController@index');

Route::get('my-confessions', 'Front\MyConfessionController@myConfessions');
Route::get('felt-confessions', 'Front\MyConfessionController@myFeltConfessions');

Route::get('confessions/latest', 'Front\ConfessionController@latest');
Route::get('confessions/trending', 'Front\ConfessionController@trending');
Route::get('confessions/most-felt', 'Front\ConfessionController@mostFelt');
// Route::get('confessions/{id}/comments', 'Front\CommentController@index');
Route::get('confessions/{id}/comments', 'Front\CommentConfessionController@getComments');

Route::get('confessions/{confession}', 'Front\ConfessionController@show')->name('confessions.show');
/** Confession Routes */

/** Like Confession Routes */
Route::post('like-confession', 'Front\LikeConfessionController@store');
/** Like Confession Routes */

/** Like Confession Comment Routes */
Route::post('like-comment', 'Front\LikeConfessionCommentController@store');
/** Like Confession Comment Routes */

Route::post('comment-confession', 'Front\CommentConfessionController@store');
Route::delete('comments/{comment}', 'Front\CommentConfessionController@destroy');
Route::patch('comments/{id}/edit', 'Front\CommentConfessionController@update');

/** Follow User Route */
Route::post('follow-user', 'Front\FollowUserController@store');
Route::get('followings', 'Front\FollowingController@index');
Route::get('followers', 'Front\FollowersController@index');
/** Follow User Route */

/** Confession Category Routes */
Route::get('categories', 'Front\CategoryController@index');
Route::any('category/{slug}', 'Front\CategoryConfession@index')->name('confession-categories.index');
// Route::any('category/{slug}', 'Front\ConfessionCategoryController@index')->name('confession-categories.index');
/** Confession Category Routes */

Route::get('category/{id}/confessions', 'Front\ConfessionCategoryController@getConfessions');

// if (!strpos(Request::url(), "admin")) {
//     Route::get('{username}/confessions', 'Front\UserConfessionController@myConfession');
// }
Route::get('my-felt-confessions', 'Front\UserConfessionController@myFeltConfessions')->name('user.felt-confessions');

Route::delete('confession/{id}/delete', 'Front\UserConfessionController@destroy')->name('confession.destroy');
Route::get('confession/{id}/edit', 'Front\ConfessionController@edit');

Route::any('/search', 'Front\SearchController@index')->name('search');

/** Search Routes */
// Route::any('/search', function () {
//     $q = request('q');
//     $feeds = Feed::where('text', 'LIKE', '%'.$q.'%')->get();
//     return view('front.search.index')->withFeeds($feeds)->withQuery($q);
// });
/** Search Routes */

/** Notifications Routes */
Route::get('notifications', 'Front\NotificationController@index')->name('notifications.index');
Route::get('notifications/mark-all-as-read', 'Front\NotificationController@markAllAsRead')->name('notifications.markAllAsRead');
/** Notifications Routes */

/** Tags Routes */
Route::get('tag/{slug}', 'Front\TagController@show')->name('tags.show');
/** Tags Routes */

/** Blogs Routes */
Route::get('blogs', 'Front\BlogController@index')->name('blogs');
Route::get('blog/{slug}', 'Front\BlogController@show')->name('blogs.show');
/** Blogs Routes */

/** Advertisement Routes */
Route::get('advertisements', 'Front\AdvertisementController@index');
/** Advertisement Routes */

/** Profile Route */
Route::get('profile', 'Front\ProfileController@index')->name('user.profile');
Route::post('profile', 'Front\ProfileController@update')->name('profile.update');
Route::post('change-password', 'Front\ProfileController@changePassword')->name('profile.change-password');
Route::delete('accounts/{id}/delete', 'Front\AccountController@destroy')->name('accounts.destroy');
/** Profile Route */


/**
 * Admin routes
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::namespace('Admin')->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::namespace('Categories')->group(function () {
            Route::resource('categories', 'CategoryController');
        });

        Route::namespace('Users')->group(function () {
            Route::resource('users', 'UserController');
        });

        Route::namespace('News')->group(function () {
            Route::resource('news', 'NewsController');
        });

        Route::namespace('Confessions')->group(function () {
            Route::resource('confessions', 'ConfessionController');
        });

        Route::get('advertisements', 'AdvertisementController@index')->name('advertisements.index');
        Route::get('advertisements/create', 'AdvertisementController@create')->name('advertisements.create');
        Route::get('advertisements/{advertisement}/edit', 'AdvertisementController@edit')->name('advertisements.edit');
        Route::post('advertisements/{advertisement}/update', 'AdvertisementController@update')->name('advertisements.update');
        Route::post('advertisements/create', 'AdvertisementController@store')->name('advertisements.store');
        Route::delete('advertisements/{advertisement}', 'AdvertisementController@destroy')->name('advertisements.destroy');

        /** Settings Route */
        Route::get('settings', 'SettingController@index')->name('settings');
        Route::post('settings', 'SettingController@update')->name('settings.update');
        /** Settings Route */
    });
});
