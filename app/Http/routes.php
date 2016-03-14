<?php
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect']
    ],
    function () {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

        Route::get('/', ['as' => 'index', 'uses' => 'SongController@listCategory']);
        Route::post('/', ['as' => 'index', 'uses' => 'SongController@listCategory']);
        /** Список Категорій **/
        Route::get('categories', ['as' => 'categories', 'uses' => 'SongController@listCategory']);
        Route::post('categories', ['as' => 'categories', 'uses' => 'SongController@listCategory']);
        /** Список Акордів **/
        Route::get('chords', ['as' => 'chords', 'uses' => 'IndexController@chords']);
        /** Список Пісень **/
        Route::get('songs', ['as' => 'songs', 'uses' => 'SongController@listSongs']);
        Route::post('songs', ['as' => 'songs', 'uses' => 'SongController@listSongs']);
        /** Список Пісень відсортованих **/
        Route::get('song_sort', ['as' => 'songs', 'uses' => 'SongController@listSongs']);
        Route::get('song_sort/{item}', ['as' => 'songs', 'uses' => 'SongController@listSongsSort']);
        Route::post('song_sort/{item}', ['as' => 'songs', 'uses' => 'SongController@listSongsSort']);
        /** Пісня **/
        Route::get('songs/{slug}', ['as' => 'songs.cart', 'uses' => 'SongController@cartSongs']);
        Route::post('songs/{slug}', ['as' => 'songs.cart', 'uses' => 'SongController@cartSongs']);
        /** Список пісень в категорії **/
        Route::get('song/{title_eng}', ['as' => 'song.record', 'uses' => 'SongController@songsInCategory']);
        Route::post('song/{title_eng}', ['as' => 'song.record', 'uses' => 'SongController@songsInCategory']);
        /** Пісня в категорії **/
        Route::get('song/{title_eng}/{slug}', ['as' => 'song.record', 'uses' => 'SongController@cartSongInCategory']);
        Route::post('song/{title_eng}/{slug}', ['as' => 'song.record', 'uses' => 'SongController@cartSongInCategory']);
        /** Додати пісню **/
        Route::get('add', ['as' => 'add', 'uses' => 'SongController@addSong']);
        Route::post('add', ['as' => 'add', 'uses' => 'SongController@addSong']);
        /** Виконавці **/
        Route::get('performers', ['as' => 'add', 'uses' => 'PerformerController@performers']);
        Route::post('performers', ['as' => 'add', 'uses' => 'PerformerController@performers']);
        Route::get('performers/{title}', ['as' => 'add', 'uses' => 'PerformerController@cartPerformers']);
        /** Пошук **/
        Route::get('search', ['as' => 'search', 'uses' => 'IndexController@search']);
        /** Lessons **/
        Route::get('lessons', ['as' => 'lessons', 'uses' => 'LessonsController@index']);
        Route::get('lessons/{id}', ['as' => 'lessons.cart', 'uses' => 'LessonsController@cart']);
        Route::post('lessons/{id}', ['as' => 'lessons.cart', 'uses' => 'LessonsController@add']);
    });
/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

