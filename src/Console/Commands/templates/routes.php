// Listing
Route::get('resources', 'ResourcesController@index');
Route::get('resources/{id}', 'ResourcesController@show');

// Changing
Route::post('resources', 'ResourcesController@store');
Route::post('resources/{id}', 'ResourcesController@update');
Route::delete('resources/{id}', 'ResourcesController@destroy');
