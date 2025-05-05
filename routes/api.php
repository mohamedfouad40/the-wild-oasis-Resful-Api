<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Cabins\CabinController;
use App\Http\Controllers\Guests\AuthController as GuestsAuthController;
use App\Http\Controllers\Guests\BookingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;







/////////////////////////////Guests//////////////////////
Route::group(['prefix'=>'guests'],function(){

    // Authentication
    Route::post('/register',[GuestsAuthController::class,'register']);
    Route::post('/login',[GuestsAuthController::class,'login']);

    // Booking
    Route::group(['prefix'=>'bookings','middleware'=>['auth:sanctum','guest-role']],function(){
        Route::post('/store',[BookingController::class,'store']);
    });
});


////////////////////////Admin//////////////////////////////
Route::group(['prefix'=>'admin'],function(){

    // /////////////////Authentication/////////////////
    Route::post('/login',[AuthController::class,'login']);

    
    Route::group(['middleware'=>['auth:sanctum','admin-role']],function(){


         ///////////////////////Cabins Crud///////////////////
        Route::group(['prefix'=>'cabins'],function(){
            Route::post('/store',[CabinController::class,'store']);
            Route::get('/edit/{id}',[CabinController::class,'edit']);
            Route::post('/update',[CabinController::class,'update']);
            Route::delete('/delete/{id}',[CabinController::class,'delete']);
            Route::get('/duplicate/{id}',[CabinController::class,'duplicate']);
        });


        ///////////////////////Bookings///////////////////
        Route::group(['prefix'=>'bookings'],function(){
            Route::post('/store',[BookingController::class,'store']);
            Route::get('/',[BookingController::class,'indexes']);
            Route::get('/edit/{id}',[BookingController::class,'edit']);
            Route::post('/update',[BookingController::class,'update']);
            Route::delete('/delete/{booking}',[BookingController::class,'delete']);
        });


        /////////////////Admin Profile////////////////////////////
        Route::post('/addAdmin',[ProfileController::class,'add_admin']);
        Route::post('/updateProfileImage',[ProfileController::class,'update_profile_image']);
        Route::post('/updatePassword',[ProfileController::class,'update_password']);

    
        ////////////////////////Settings//////////////////////////
        Route::get('settings',[SettingsController::class,'settings']);
        Route::post('settings/update',[SettingsController::class,'update']);

    });

});


///////////////////For Guests && Admins ///////////////////
Route::group(['middleware'=>'auth:sanctum'],function(){

    //////////////////////Logout///////////////////////////
    Route::get('/logout',[AuthController::class,'logout']);


    /////////////////////Check Auth////////////////////
    Route::get('/check-auth',[AuthController::class,'checkAuth']);


    ////////////////////Cabins indexes//////////////////
    Route::get('/cabins',[CabinController::class,'indexes']);
    

    /////////The Guest && Cabin For This Booking//////////////////////////
    Route::get('booking/{id}',[BookingController::class,'index']);


    ////////////////All Bookings for One Guest//////////////////////////
    Route::get('guest_bookins/{guest_id}',[BookingController::class,'guest_bookins']);

    
});
