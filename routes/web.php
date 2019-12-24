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

Route::get('draw-tag','Front\PagesController@test_pdf');
Route::get('calculate-tax','Front\PagesController@getTax');

Route::get('draw-front','Front\PagesController@front_pdf');
Route::get('get-shiprate','Front\PagesController@getRate');
Route::get('draw-image','Front\PagesController@imageTest');

Route::get('cache-clear',function(){
    \Artisan::call('cache:clear');
    \Artisan::call('config:cache');
    \Artisan::call('config:clear');
});

Route::get('migrate',function(){
    \Artisan::call('migrate:fresh');
    \Artisan::call('db:seed');
    echo 'done';
});

Route::get('change-password',function(){
    \App\Cloudsa9\Entities\Models\User\User::where('email','johndoe@fowndapp.com')->first()->update([
        'password'=>bcrypt('password')
    ]);
    echo 'done';
});

Route::get('/', 'Front\PagesController@index')->name('home');
Route::get('/return-found-pet', 'Front\PagesController@getReturnFoundPet')->name('return-found-pet');
Route::get('/rfp/{any}', 'Front\PagesController@getReturnFoundPet')->name('rfp');
//Route::get('/how-to-set-lock-screen', 'Front\PagesController@getHowToSetLockScreen')->name('how-to-set-lock-screen');
Route::get('/contact', 'Front\PagesController@getContact')->name('contact');
Route::post('/contact', 'Front\PagesController@postContact')->name('contact.store');
Route::get('/faq', 'Front\PagesController@getFAQ')->name('faq');
Route::get('/community', 'Front\PagesController@getCommunity')->name('community');
Route::get('/influencer', 'Front\PagesController@getInfluencers')->name('influencer');
Route::post('/influencer', 'Front\PagesController@postInfluencers')->name('influencer.post');
Route::get('/tos', 'Front\PagesController@getTOS')->name('tos');
Route::get('/privacy-policy', 'Front\PagesController@getPrivacyPolicy')->name('privacy-policy');
Route::post('/subscribe', 'Front\NewsletterController@postNewsletter')->name('newsletter-subscribe');
Route::get('/about-us', 'Front\PagesController@getAboutUs')->name('about-us');
Route::get('/returns-and-shipping', 'Front\PagesController@getReturnsAndShipping')->name('returns-and-shipping');
Route::get('/lost-pet-checklist', 'Front\PagesController@getLostPetChecklist')->name('lost-pet-checklist');

Route::get('/d', 'Front\PagesController@redirectToStore');

//Route::get('/promo', 'Auth\RegisterController@getPromo');
//Route::post('/promo', 'Auth\RegisterController@postPromo')->name('promo');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    // Admin routes
    Route::group(['namespace' => 'Admin', 'middleware' => ['role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('/profile', 'ProfileController@getProfile')->name('profile');
        Route::post('/profile', 'ProfileController@postProfile')->name('profile.update');

        Route::resource('/subscribers', 'SubscribersController');

        
        Route::get('pdf-tag','TagController@getNewPetTag');

        Route::get('/transactions', 'TransactionsController@index')->name('transactions.index');
        Route::get('/influencer', 'InfluencersController@index')->name('influencer.index');
        Route::get('/influencer/{id}', 'InfluencersController@edit')->name('influencer.edit');
        Route::post('/influencer/{id}', 'InfluencersController@update')->name('influencer.update');
        Route::get('/influencer/{id}/pass', 'InfluencersController@editPass')->name('influencer.editpass');
        Route::post('/influencer/{id}/pass', 'InfluencersController@updatePass')->name('influencer.updatepass');
        Route::post('/influencer/{id}/status', 'InfluencersController@status')->name('influencer.status');

        //Discount Codes
        Route::get('/discount-codes','DiscountController@index')->name('discount.index');
        Route::post('/create-code','DiscountController@create')->name('discount.create');
    });

    // Subscriber routes
    Route::group(['namespace' => 'Subscriber', 'middleware' => ['role:subscriber'], 'prefix' => 'dashboard', 'as' => 'subscriber.'], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::get('/account', 'AccountController@getAccount')->name('account');
        Route::post('/account', 'AccountController@postAccount')->name('account.store');

        Route::get('/contact-info', 'ContactInfoController@getContactInfo')->name('contact-info');
        Route::post('/contact-info', 'ContactInfoController@postContactInfo')->name('contact-info.store');

        Route::get('/my-lockscreen', 'LockscreenController@getMyLockscreen')->name('lockscreen');
        Route::post('/my-lockscreen', 'LockscreenController@postMyLockscreen')->name('lockscreen.store');
        Route::post('/my-lockscreen/email', 'LockscreenController@emailLockscreen')->name('lockscreen.email');

        Route::get('/subscription', 'SubscriptionController@index')->name('subscription');
        Route::post('/subscription', 'SubscriptionController@cancelSubscription')->name('subscription.cancel');
        Route::post('/resume', 'SubscriptionController@resumeSubscription')->name('subscription.resume');

        Route::get('/account/change-password', 'AccountController@getChangePassword')->name('account.change-password');
        Route::post('/account/change-password', 'AccountController@postChangePassword')->name('account.change-password.store');
    });
});

Route::get('storage/{filePath}', function ($filePath) {
    $path = storage_path('app/public/' . $filePath);

    if (!File::exists($path))
        abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->where('filePath', '.*');


Route::get('/dev/refresh', function () {
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    echo 'config cleared and cached';
});

