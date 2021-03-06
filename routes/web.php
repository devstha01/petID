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

// Route::get('draw-tag','Front\PagesController@test_pdf');
// Route::get('calculate-tax','Front\PagesController@getTax');
// Route::get('delete-order','Front\PagesController@deleteOrderFromStation');

// Route::get('download_frontpdf','Front\PagesController@front_pdf');
// Route::get('download_backpdf','Front\PagesController@back_pdf');
//Route::get('draw-front','Front\PagesController@front_pdf');
// Route::get('get-shiprate','Front\PagesController@getRate');
// Route::get('draw-image','Front\PagesController@imageTest');


/*Route::get('testing',function(){
    $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                     .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                     .'0123456789'); // and any other characters
    shuffle($seed); // probably optional since array_is randomized; this may be redundant
    $rand = '';
    foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];
 
    dd($rand); 
});*/
Route::get('storage',function(){
    \Artisan::call('storage:link');
});

Route::get('cache-clear',function(){
    \Artisan::call('cache:clear');
    \Artisan::call('config:cache');
    \Artisan::call('config:clear');
});

Route::get('migrate-fresh',function(){
    \Artisan::call('migrate:fresh');
    \Artisan::call('db:seed');
    echo 'done';
});

Route::get('update-pet-tag','Front\PagesController@createPetCode');


Route::get('migrate',function(){
    \Artisan::call('migrate');
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

//Web tag order and sign up
Route::get('/online-signup-step1', 'Front\PagesController@getOnlineSignup1')->name('online-signup-step1');
Route::post('/account/create-step1','Front\PagesController@postCreateStep1');
Route::get('/online-signup-step2', 'Front\PagesController@getOnlineSignup2')->name('online-signup-step2');
Route::post('/account/create-step2','Front\PagesController@postCreateStep2');
// Route::get('/checkout', 'Front\PagesController@checkout')->name('checkout');
Route::get('/petid-quick-order', 'Front\OrderController@checkout')->name('checkout');
Route::post('/checkout', 'Front\OrderController@order')->name('payment');
Route::get('/calculate-charge', 'Front\OrderController@calculateCharge')->name('calculate.charge');

Route::get('/d', 'Front\PagesController@redirectToStore');

Route::get('/influencer-sales/{code}','Front\PagesController@salesView');

//Route::get('/promo', 'Auth\RegisterController@getPromo');
//Route::post('/promo', 'Auth\RegisterController@postPromo')->name('promo');
Auth::routes(['verify' => true]);
Route::get('password-reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password-reset.token');
Route::post('password-reset', 'Auth\ResetPasswordController@resetPassword')->name('password-update');
Route::get('reset-success','Auth\ResetPasswordController@resetSuccess');
Route::group(['middleware' => ['auth', 'verified']], function () {
    // Admin routes
    Route::group(['namespace' => 'Admin', 'middleware' => ['role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('/profile', 'ProfileController@getProfile')->name('profile');
        Route::post('/profile', 'ProfileController@postProfile')->name('profile.update');

        Route::resource('/subscribers', 'SubscribersController');
        Route::get('no-tags-purchased-users','SubscribersController@usersWithNoTag')->name('no-tags-purchased-users');
        Route::get('subscriber-pets/{id}','SubscribersController@getPets')->name('subscribers.pets');
        Route::get('subscriber/order-tag/{id}','SubscribersController@getPetTag')->name('subscribers.order-tag');
        Route::post('subscriber/post-order-tag/{id}','SubscribersController@orderPetTag')->name('subscribers.post-order-tag');
        Route::get('/subscriber/{id}/pass', 'SubscribersController@editPass')->name('subscribers.editpass');
        Route::post('/subscriber/{id}/pass', 'SubscribersController@updatePass')->name('subscribers.updatepass');
        
        Route::get('pdf-tag','TagController@getNewPetTag');

        Route::get('/transactions', 'TransactionsController@index')->name('transactions.index');
        Route::get('/influencer', 'InfluencersController@index')->name('influencer.index');
        Route::get('/influencer/{id}', 'InfluencersController@edit')->name('influencer.edit');
        Route::post('/influencer/{id}', 'InfluencersController@update')->name('influencer.update');
        Route::get('/influencer/{id}/pass', 'InfluencersController@editPass')->name('influencer.editpass');
        Route::post('/influencer/{id}/pass', 'InfluencersController@updatePass')->name('influencer.updatepass');
        Route::post('/influencer/{id}/status', 'InfluencersController@status')->name('influencer.status');

        Route::get('/order-tags','OrderTagController@index')->name('orders.index');
        //Discount Codes
        Route::get('/discount-codes','DiscountController@index')->name('discount.index');
        Route::post('/create-code','DiscountController@create')->name('discount.create');
        Route::get('/discount-code/used/{code}','DiscountController@codeUsedBy')->name('discount.used');

        //TAG DOWNLOAD
        Route::get('download-template','OrderTagController@downloadTagView')->name('orders.download.template');
        Route::get('download_frontpdf','OrderTagController@front_pdf');
        Route::get('download_backpdf','OrderTagController@back_pdf');
        Route::get('download-csv','OrderTagController@getCSVReport');
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

