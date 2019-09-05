
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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Route::get('testing','PpcManagerController@refreshProfile')->name('testing');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'Auth\LoginController@login');

Route::get('/search','PpcManagerController@search');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/admin/dashboard', 'HomeController@index')->name('admin/dashboard');

//route test data from API
Route::get('/admin/addCampaignsDB', 'PpcManagerController@addCampaignsDB')->name('admin/addCampaignsDB');

//bulk operation
Route::get('/admin/bulk-operations', 'PpcManagerController@bulk_operations')->name('admin/bo');

Route::get('/auth', 'PpcManagerController@authView');

Route::get('/admin/ppcmanager', 'PpcManagerController@index')->name('admin/ppcmanager');

//route products
Route::get('/admin/Products','ProductsController@index')->name('/admin/Products');

//route AdGroups
Route::get('/admin/AdGroup','AdGroupController@index')->name('/admin/AdGroup');

//route keywords
Route::get('/admin/keywords','KeywordsController@index')->name('/admin/keywords');

//route ajax obtain data metric adGroup
Route::get('/admin/reportAdGroups','AdGroupsController@reports')->name('admin/r');

//route ajax obtain data metric keywords
Route::get('/admin/reportKeywords', 'KeywordsController@reports')->name('admin/reportKeywords');

//route ajax obtain data metric campaign
Route::get('/admin/reports', 'PpcManagerController@reports')->name('admin/reports');

// ruta para iniciar session con amazon
 Route::get('/logamazon', 'AmazonController@logAmazon');


// ruta para obtener el token
 Route::get('/token', 'AmazonController@token');

// ruta para obtener el codigo amazon
 Route::get('/code', 'AmazonController@code');


// rutas de testing sdk

Route::get('/register', 'AmazonController@registerPro');

// obtener el perfil por id
Route::get('/profile/id', 'AmazonController@listProById');


// obtener todos los perfiles
Route::get('/profiles', 'AmazonController@listPro');


// refrescar el token
Route::get('/refresh/token', 'AmazonController@refreshToken');

Route::get('/view/campaigns', 'AmazonController@listCamps');

Route::get('/update/campaigns', 'AmazonController@updatedCamps');

// pausar campaña
// Route::get('/pause/camp/{id}', 'AmazonController@pauseCamp');

Route::get('/pause/camp/{id}', 'PpcManagerController@pauseCamp')->name('/pause/camp/{id}');


// solicitar un reporte por 60 dias
Route::get('/report/request', 'AmazonController@reportRe');

// obtener la data del reporte
Route::get('/report', 'AmazonController@report');

Route::get('/list/ad', 'PpcManagerController@listAdGroup');

// metodos ad groups
Route::get('/pause/ad/{ida}', ['uses'=>'PpcManagerController@pauseAd'])->name('/pause/ad/{ida}');

Route::get('/enabled/ad/{ida}', ['uses'=>'PpcManagerController@enabledAd'])->name('/enabled/ad/{ida}');

Route::get('/testad', 'PpcManagerController@testad');

Route::post('budget', ['uses'=>'PpcManagerController@budget']);

Route::post('budget/increase', ['uses'=>'PpcManagerController@budgetIncrease']);

Route::post('budget/decrease', ['uses'=>'PpcManagerController@budgetDecrease']);

Route::post('campaign/edit', ['uses'=>'PpcManagerController@multiEditCampaigns']);

Route::get('/testn', 'PpcManagerController@testn');