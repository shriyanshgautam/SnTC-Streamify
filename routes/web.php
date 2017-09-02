<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/','LoginController@login_form');

Route::post('login','LoginController@login');

Route::post('logout','LoginController@logout');

Route::resource('authors', 'AuthorController');

Route::resource('bodies', 'BodyController');

Route::resource('locations', 'LocationController');

Route::resource('position_holders', 'PositionHolderController');

Route::resource('tags', 'TagController');

Route::resource('colleges', 'CollegeController');

Route::resource('app_users', 'AppUserController');

Route::resource('streams', 'StreamController');

Route::resource('events', 'EventController');

Route::resource('notifications', 'NotificationController');

Route::resource('feedbacks', 'FeedbackController');

Route::resource('app_posts', 'AppPostController');

Route::resource('contents', 'ContentController');

Route::post('app/register','RegistrationController@register');

Route::post('app/get_streams','AppController@get_streams');

Route::post('app/get_events','AppController@get_events');

Route::post('app/get_notifications','AppController@get_notifications');

Route::post('app/subscribe','AppController@subscribe');

Route::post('app/unsubscribe','AppController@unsubscribe');

Route::post('app/feedback','AppController@feedback');

Route::post('app/post','AppController@app_post');




Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/some',function(){
    // DB::table('position_holders')->insert(
    //     ['name' => 'Gopal',
    //      'position' => 'Gen Secy',
    //      'email'=>'gopal@gmail.com',
    //      'contact'=>'8765003288',
    //      'image'=>'gopal.jpg']
    // );

    // DB::table('authors')->insert(
    //     ['name' => 'Shriyansh', 'email' => 'shriyansh@gmail.com','contact'=>'8765003288','image'=>'abc.jpg']
    // );

    // DB::table('streams')->insert(
    //     ['title' => 'COPS',
    //      'subtitle' => 'Club of programmers',
    //      'description'=>'coding club',
    //      'image'=>'abc.jpg',
    //      'author_id'=>1
    //     ]
    // );

    // DB::table('position_holder_stream')->insert(
    //     ['position_holder_id' => 2, 'stream_id' => 1,'level'=>2]
    // );

    // $record = App\Stream::find(1);
    // $author = $record->author()->get();
    // $names=$record->positionHolders()->get();
    // $actual='n';
    // foreach($names as $name){
    //     $actual = 'f';
    // }

    //return response($record->get().'- '.$names.'- '.$author);
    return response('hi');
});
