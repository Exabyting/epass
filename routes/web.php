<?php

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

Route::middleware(['auth'])->group(function () {
    Route::middleware(['force_password'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/', 'HomeController@landing')->name('welcome');
        Route::get('/system-is-now-shutdown', 'HomeController@shutdown')->name('shutdown.message');

        Route::middleware(['auth', 'can:system-super-admin'])->group(function () {
            Route::resource('system/user', 'UserController');
            Route::post('system/user/special', 'UserController@changeSpecialStatus')->name('user.special');

            Route::resource('user/role', 'RoleController');
            Route::resource('user/permission', 'PermissionController');

            Route::resource('system-settings', 'SystemController');
            Route::post('system-settings', 'SystemController@changeValue')->name('system-settings.changeValue');
        });

        Route::middleware(['site_admin', 'can:site-admin'])->group(function () {
            Route::resource('system-config', 'SystemConfigController');
        });
    });

    Route::get('/change/password', 'ChangePasswordController@change');
    Route::post('/change/password', 'ChangePasswordController@update');


    //Notifications
    Route::get('/notification/count', 'AppNotificationController@countUnread')->name('notification.count');
    Route::get('/unread/notifications', 'AppNotificationController@getUnreadNotification')->name('notification.unread');
    Route::get('/latest/notifications', 'AppNotificationController@getLatestNotifications')->name('notification.latest');
    Route::get('/all/notifications', 'AppNotificationController@index')->name('notification.index');
    Route::get('/read/notifications', 'AppNotificationController@markAsRead')->name('notification.read');
    Route::get('/clear/notifications', 'AppNotificationController@clearAll')->name('notification.clear');

});


Route::get('/lang/{key}', function ($key) {
    Session::put('locale', $key);
    Session::save();
    return redirect()->back();
});

Route::get('/test/upload', 'AttachmentController@index')->name('test.upload-index');
Route::post('/test/upload', 'AttachmentController@uploadFile')->name('test.upload');
Route::get('/file/download', 'AttachmentController@downloadFile')->name('file.download');
Route::get('/file/get', 'AttachmentController@get')->name('file.getFile');
Route::get('/test/url/{fileName}', 'AttachmentController@fileUrl')->name('test.fileUrl');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
