<?php

use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api\V1'], function (Router $api) {
        // Auth routes
        $api->group(['namespace' => 'Auth', 'prefix' => 'auth'], function (Router $api) {
            $api->post('register', 'RegisterController@register');
            $api->post('signup/fb','RegisterController@registerViaFb');
            $api->post('login', 'LoginController@login');
            $api->post('user-log','LoginController@userLog');
            $api->post('login/fb', 'LoginController@loginFacebook');

            $api->post('password/email', 'ForgotPasswordController@sendResetEmail');
            $api->post('password/verify-token', 'ForgotPasswordController@verifyToken');
            $api->post('password/reset', 'ResetPasswordController@resetPassword');

            $api->post('logout', 'LoginController@logout');
            $api->post('refresh', 'LoginController@refresh');
        });

        // Visitor routes
        $api->get('rfp/{code}', 'Front\FrontController@getReturnFoundPet');

        // Subscriber routes
        $api->group(['middleware' => 'jwt.auth'], function (Router $api) {

            $api->group(['namespace' => 'Subscriber'], function (Router $api) {
                $api->get('my-account', 'AccountController@getAccount');
                $api->post('my-account', 'AccountController@postAccount');

                $api->post('/my-account/change-password', 'AccountController@postChangePassword');

                $api->get('/contact-info', 'ContactInfoController@getContactInfo');
                $api->post('/contact-info', 'ContactInfoController@postContactInfo');

                // $api->get('/lockscreen', 'LockscreenController@getLockscreen');
                // $api->post('/lockscreen', 'LockscreenController@postLockscreen');
                // $api->post('/lockscreen/email', 'LockscreenController@emailLockscreen');
            });

            $api->group(['namespace' => 'Pet'], function (Router $api) {
                $api->get('my-pets', 'PetController@getMyPets');
                $api->post('my-pet', 'PetController@postPet');
                $api->get('my-pet/{id}','PetController@getMyPet');
                $api->post('my-pet/{id}','PetController@updateMyPet');
                $api->post('my-pet-image/{id}','PetController@myPetImageUpload');
                $api->delete('my-pet/{id}','PetController@deleteMyPet');
            });
        });
    });
});
