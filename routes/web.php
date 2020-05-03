<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('', 'FrontendController@landingPage');
Route::get('category/{id}', 'FrontendController@category');
Route::get('categories','FrontendController@categories');
Route::get('sub-category/{id}', 'FrontendController@subCategory');
Route::get('p/{influencer}', 'FrontendController@influencer')->name('influencer-profile');
Route::get('check/schedule', 'FrontendController@influencer_schedule_check')->name('influencer.schedule.check');
Route::get('register-influencer', 'FrontendController@influencerRegister');
Route::post('register-influencer','FrontendController@registerInfluencer');
Route::get('faq','FrontendController@faq');
Route::post('book', 'FrontendController@book');
Route::get('video/{id}', 'FrontendController@video');
Route::post('search','FrontendController@search');
Route::get('search-result','FrontendController@searchResult');
Route::get('stripe-redirect','IncomeController@stripeRedirect');

Auth::routes(['verify' => true]);
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['middleware' => ['auth']], function () {
    Route::get('add-wish-list/{id}', 'FrontendController@addWishlist');
    Route::group(['prefix' => 'fan'], function(){
        Route::get('','HomeController@fanDashboard');
        Route::post('/profile-update', 'HomeController@fanUpdatePersonalInfo')->name('fan.profile.update');
    });
    Route::group(['prefix' => 'profile'], function () {
        Route::post('update-personal-info', 'ProfileController@updatePersonalInfo');
        Route::post('update-profile-media', 'ProfileController@updateProfileMedia');
        Route::post('update-social-links', 'ProfileController@updateSocialLinks');
    });
    Route::group(['middleware' => 'verified'], function(){
        Route::get('home', 'HomeController@index')->name('home');
        Route::get('profile', 'HomeController@profile')->name('profile');
        Route::get('sub-categories/{category_id}', 'CategoriesController@getSubCategories');
        Route::post('reset-password', 'ProfileController@resetPassword');
        Route::get('dashboard', 'HomeController@index');
        Route::post('payout','IncomeController@payout');
        Route::get('view-payouts/{account}', 'IncomeController@viewPayouts');
        Route::group(['prefix' => 'income'], function(){
            Route::get('','IncomeController@income');
            Route::post('set-rate', 'IncomeController@setRate');
        });
        Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
            Route::get('', 'HomeController@adminDashboard');
            Route::get('categories', 'CategoriesController@categories');
            Route::post('categories', 'CategoriesController@storeCategories');
            Route::get('category/{id}', 'CategoriesController@getCategory');
            Route::get('category-sub/{id}', 'CategoriesController@subCategory');
            Route::post('sub-category', 'CategoriesController@storeSubCategory');
            Route::get('sub-category/{id}', 'CategoriesController@getSubCategory');
            Route::group(['prefix' => 'faqs'], function(){
                Route::get('', 'FaqsController@index');
                Route::get('enable/{id}', 'FaqsController@enable');
                Route::get('disable/{id}', 'FaqsController@disable');
                Route::post('update', 'FaqsController@update');
            });
            Route::group(['prefix' => 'profile'], function () {
                Route::get('', 'ProfileController@adminProfile');
                Route::post('update-personal-info', 'ProfileController@updatePersonalInfo');
                Route::post('update-profile-media', 'ProfileController@updateProfileMedia');
            });
            Route::group(['prefix' => 'influencers'], function () {
                Route::get('requests', 'InfluencersController@requests');
                Route::get('', 'InfluencersController@influencers');
                Route::get('approve-request/{id}', 'InfluencersController@approveRequest');
                Route::get('decline-request/{id}', 'InfluencersController@declineRequest');
                Route::get('activate-account/{id}', 'InfluencersController@activateAccount');
                Route::get('suspend-account/{id}', 'InfluencersController@suspendAccount');
                Route::get('view/{id}', 'InfluencersController@viewInfluencer');
            });
        });
        Route::group(['prefix' => 'influencer', 'middleware' => ['role:influencer|admin']], function () {
            Route::get('', 'HomeController@influencerDashboard');
            Route::group(['prefix' => 'bookings'], function(){
                Route::get('','BookingsController@index');
                Route::get('view/{id}','BookingsController@bookingView');
                Route::post('upload','BookingsController@uploadVideo');
                Route::get('send/{id}','BookingsController@sendVideo');
                Route::get('all','BookingsController@allBookings');
                Route::get('cancel/{id}','BookingsController@requestCancelled');
                Route::get('fulfilled/{id}', 'BookingsController@requestFulfilled');
            });
            Route::group(['prefix' => 'schedule', 'as'=>'schedule.'], function(){
                Route::get('','InfluencerScheduleController@index')->name('index');
                Route::get('all','InfluencerScheduleController@allSchedules')->name('create');
                Route::post('store','InfluencerScheduleController@store')->name('store');
                Route::get('/{id}/edit','InfluencerScheduleController@edit')->name('edit');
                Route::put('/{id}/update','InfluencerScheduleController@update')->name('update');
            });
            Route::group(['prefix' => 'profile'], function () {
                Route::get('', 'ProfileController@influencerProfile');
                Route::post('update-personal-info', 'ProfileController@updatePersonalInfo');
                Route::post('update-occupational-info', 'ProfileController@updateOccupationalInfo');
                Route::post('update-profile-media', 'ProfileController@updateProfileMedia');
                Route::post('update-social-links', 'ProfileController@updateSocialLinks');
            });
        });
    });
});
