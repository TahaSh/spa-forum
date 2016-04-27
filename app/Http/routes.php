<?php

# Category
Route::get('/api/categories', 'CategoryController@index');
Route::get('/api/categories/{id}/topics', 'CategoryController@topics');

# Topic
Route::get('/api/topics', 'TopicController@index');
Route::get('/api/topics/{id}', 'TopicController@show');
Route::post('/api/topics', 'TopicController@store');
Route::put('/api/topics/{id}', 'TopicController@update');
Route::patch('/api/topics/{id}', 'TopicController@incrementViews');
Route::delete('/api/topics/{id}', 'TopicController@destroy');
Route::post('/api/topics/{id}/comments', 'TopicController@addComment');

# Authentication
Route::post('/api/login', 'AuthController@login');
Route::post('/api/register', 'AuthController@register');
Route::get('/api/me', 'AuthController@userInfo');

# Vue
Route::any('{all}', function () {
    return view('index');
})
->where(['all' => '.*']);

