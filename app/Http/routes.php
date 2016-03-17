<?php
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect']
    ],
    function () {
        Route::get('/', ['as' => 'index', 'uses' => 'SongController@listCategory']);
        Route::post('/', ['as' => 'index', 'uses' => 'SongController@listCategory']);
        /** List category **/
        Route::get('categories', ['as' => 'categories', 'uses' => 'SongController@listCategory']);
        Route::post('categories', ['as' => 'categories', 'uses' => 'SongController@listCategory']);
        /** List chords **/
        Route::get('chords', ['as' => 'chords', 'uses' => 'IndexController@chords']);
        /** List songs **/
        Route::get('songs', ['as' => 'songs', 'uses' => 'SongController@listSongs']);
        Route::post('songs', ['as' => 'songs', 'uses' => 'SongController@listSongs']);
        /** List song sort **/
        Route::get('song_sort', ['as' => 'songs', 'uses' => 'SongController@listSongs']);
        Route::get('song_sort/{item}', ['as' => 'songs', 'uses' => 'SongController@listSongsSort']);
        Route::post('song_sort/{item}', ['as' => 'songs', 'uses' => 'SongController@listSongsSort']);
        /** songs **/
        Route::get('songs/{slug}', ['as' => 'songs.cart', 'uses' => 'SongController@cartSongs']);
        Route::post('songs/{slug}', ['as' => 'songs.cart', 'uses' => 'SongController@cartSongs']);
        /** List song in category **/
        Route::get('song/{title_eng}', ['as' => 'song.record', 'uses' => 'SongController@songsInCategory']);
        Route::post('song/{title_eng}', ['as' => 'song.record', 'uses' => 'SongController@songsInCategory']);
        /** Song in category **/
        Route::get('song/{title_eng}/{slug}', ['as' => 'song.record', 'uses' => 'SongController@cartSongInCategory']);
        Route::post('song/{title_eng}/{slug}', ['as' => 'song.record', 'uses' => 'SongController@cartSongInCategory']);
        /** add song **/
        Route::get('add', ['as' => 'add', 'uses' => 'SongController@addSong']);
        Route::post('add', ['as' => 'add', 'uses' => 'SongController@addSong']);
        /** Performers **/
        Route::get('performers', ['as' => 'add', 'uses' => 'PerformerController@performers']);
        Route::post('performers', ['as' => 'add', 'uses' => 'PerformerController@performers']);
        Route::get('performers/{slug}', ['as' => 'add', 'uses' => 'PerformerController@cartPerformers']);
        /** Search **/
        Route::get('search', ['as' => 'search', 'uses' => 'IndexController@search']);
        /** Lessons **/
        Route::get('lessons', ['as' => 'lessons', 'uses' => 'LessonsController@index']);
        Route::get('lessons/{id}', ['as' => 'lessons.cart', 'uses' => 'LessonsController@cart']);
        Route::post('lessons/{id}', ['as' => 'lessons.cart', 'uses' => 'LessonsController@add']);
        /** Feedback **/
        Route::get('feedback', ['as' => 'feedback', 'uses' => 'IndexController@feedback']);
        Route::post('feedback', ['as' => 'feedback', 'uses' => 'IndexController@feedback']);
    });
/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

