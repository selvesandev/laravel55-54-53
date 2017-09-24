<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '5.3'], function () {
    Route::get('query-builder', 'NewInFiveThree@queryBuilder');
    Route::get('cache-helper', 'NewInFiveThree@cacheHelper');

    Route::get('laravel-vue', 'NewInFiveThree@vueConnection');
    Route::get('pagination', 'NewInFiveThree@pagination');

    Route::get('mailables', 'NewInFiveThree@mailables');

    Route::get('loop-variable', 'NewInFiveThree@loopVariable');
    Route::get('closures', 'NewInFiveThree@closures');
    Route::get('toggle', 'NewInFiveThree@toggle');

    /**
     * Notification
     */
    Route::get('notification-email', 'NewInFiveThree@notification');
    Route::get('notification-database', 'NewInFiveThree@notificationDatabase');
    Route::get('get-users-notification', function () {
        Auth::loginUsingId(1);
        //We can directly accessed the users notification
        //we can do this because we have used the notifiable trait in the users model.
        return Auth::user()->notifications;
    });
    Route::get('unread-notification', function () {
        return view('notification');
    });

    //Example
    Route::get('lesion-updated-notification', 'NewInFiveThree@lesionUpdated');
    Route::delete('/mark-read', function (\App\User $user) {
//        $user->notifications->map(function ($n) {
//            $n->markAsRead();
//        });
        $user->unreadNotifications->map(function ($n) {
            $n->markAsRead();
        });
        return redirect()->back();
    })->name('mark-read');
    /**
     * Notification End
     */

    Route::get('file-upload');


    Route::group(['prefix' => 'passport'], function () {
        Route::get('/', 'NewInFiveThree@passport');
    });
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
