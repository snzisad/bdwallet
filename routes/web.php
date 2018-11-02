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

Route::get('/reviews', 'HomeController@viewAllReview');

Route::get('/about', function () {
    return view('about');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact', 'HomeController@sendMessage')->name('sendmessage');

Route::get('/track/{new}/{id}','ExchangeController@trackExchange');
Route::post('/track','HomeController@trackExchange')->name('track');

Auth::routes();

Route::middleware('auth')->group(function(){

    Route::get('/sendexchangerequest', function(){
        return redirect('/');
    });

    Route::get('/profile', 'ProfileController@index');

    Route::get('/wallet', 'WalletController@index');

    Route::post('saveReview',[
        'uses' => "ProfileController@saveReview",
        'as' => 'saveReview'
    ]);

    Route::post('changePassword', [
        'uses' => "ProfileController@changePassword",
        'as' => 'changePassword'
    ]);


    Route::post('/getwallet', 'WalletController@getWalletInfo')->name('getwalletinfo');

    Route::post('/getwalletbalance', 'WalletController@getWalletBalance')->name('getwalletbalance');

    Route::post('/walletexchange', [
        'uses' => 'WalletController@walletexchange',
        'as' => 'walletexchange'
    ]);

    Route::post('/walletdeposit', [
        'uses' => 'WalletController@walletDeposit',
        'as' => 'walletdeposit'
    ]);

    Route::post('/walletwithdraw', [
        'uses' => 'WalletController@walletWithdraw',
        'as' => 'walletwithdraw'
    ]);

    Route::post('/sendexchangerequest', [
        'uses' => 'ExchangeController@sendExchangeRequest',
        'as' => 'sendexchangerequest'
    ]);

    Route::post('/confirmexchangerequest', [
        'uses' => 'ExchangeController@confirmExchangeRequest',
        'as' => 'confirmexchangerequest'
    ]);
});

Route::get('/home', function(){
    return redirect("/");
});

Route::get('/', 'HomeController@index')->name('home');
Route::post('/getinfo','HomeController@getExchangeInfo')->name('getexchangeinfo');

Route::middleware('admin')->group(function(){
    Route::get('/adminpanel/',function(){
        return redirect('/adminpanel/exchangerequest');
    });

    Route::get('/adminpanel/exchangerequest', 'ExchangeController@viewExchangeRequest')->name("exchangerequest");
    Route::get('/adminpanel/depositrequest', 'AdminController@viewDepositRequest')->name("depositrequest");
    Route::get('/adminpanel/withdrawrequest', 'AdminController@viewWithdrawRequest')->name("withdrawrequest");
    Route::get('/adminpanel/messages', 'AdminController@viewuserMessage');

    Route::get('/adminpanel/news', 'NewsController@index');
    Route::post('/adminpanel/news', 'NewsController@saveNews')->name('news');

    Route::get('/adminpanel/exchangerate', 'ExchangeController@viewExchangeRate');
    Route::post('/adminpanel/exchangerate', 'ExchangeController@saveExchangeRate')->name('exchangerate');

    Route::get('/adminpanel/gateway', 'GatewayController@index');
    Route::post('/adminpanel/gateway', 'GatewayController@addGateway')->name('addGateway');
    Route::post('/adminpanel/gateway/edit', 'GatewayController@editGateway')->name('editGateway');
    Route::get('/adminpanel/gateway/remove/{id}', 'GatewayController@removeGateway');

    Route::get('/adminpanel/acceptorder/{id}', 'AdminController@acceptExchangeRequest');
    Route::get('/adminpanel/rejectorder/{id}', 'AdminController@rejectExchangeRequest');
    
    Route::get('/adminpanel/acceptdeposit/{id}', 'AdminController@acceptDepositRequest');
    Route::get('/adminpanel/rejectdeposit/{id}', 'AdminController@rejectDepositRequest');
    
    Route::get('/adminpanel/acceptwithdraw/{id}', 'AdminController@acceptWithdrawRequest');
    Route::get('/adminpanel/rejectwithdraw/{id}', 'AdminController@rejectWithdrawRequest');
});

Route::get('/picture/{filetype}/{filename}', function ($filetype, $filename) {
    // Check if file exists in app/storage/file folder
    $file_path = storage_path() .'/app/public/'.$filetype.'/'. $filename;
    if (file_exists($file_path))
    {
        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
});
