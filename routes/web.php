<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MekawelsController;
use App\Http\Controllers\PrintRecordsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\TawkeelsController;
use App\Http\Controllers\InOutController;
use Illuminate\Support\Facades\Route;

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
Route::get('/' , [HomeController::class , 'index']);
Route::view('/access-denied' , 'access-denied')->name('access-denied');


Route::get('/login' , [HomeController::class , 'showLogin'])->name('login');
Route::post('/login' , [HomeController::class , 'login']);
Route::get('/logout' , [HomeController::class , 'logout'])->name('logout');

Route::middleware('auth')->group(function(){
    // system
    Route::prefix('/home')->as('system.')->group(function (){
        Route::redirect('/' , '/home/orders');
        // all orders
        Route::get('/orders' , [OrdersController::class , 'index'])->name('orders');
        Route::post('/orders/store' , [OrdersController::class , 'store'])->name('orders.store');
        // mekawel tawkeels
        Route::get('/mekawels/{mekawel}/tawkeels' , [MekawelsController::class , 'getTawkeels'])->name('mekawel.tawkeels');

        // outgoings
        Route::post('/outgoings/store' , [InOutController::class , 'storeOutgoing'])->name('outgoings.store');

        // incomings
        Route::post('/incomings/store' , [InOutController::class , 'storeIncoming'])->name('incomings.store');

        // search
        Route::post('/search' , [HomeController::class , 'search'])->name('search');

    });

    Route::middleware('adminOnly')->group(function(){

        // admin panel
        Route::prefix('/admin')->as('admin.')->group(function (){
            Route::get('/' , [HomeController::class , 'adminHome'])->name('admin.home');
            // mekawels
            Route::get('/mekawels' , [MekawelsController::class , 'index'])->name('mekawels');
            Route::post('/mekawels/store' , [MekawelsController::class , 'store'])->name('mekawels.store');
            Route::get('/mekawels/{mekawel}/delete' , [MekawelsController::class , 'destroy']);
            // mekawels tawkeel
            Route::get('/mekawels/{mekawel}/tawkeels/get' , [MekawelsController::class , 'getTawkeels'])->name('mekawels.tawkeels.get');
            Route::get('/mekawels/{mekawel}/tawkeels/{tawkeel}/delete' , [MekawelsController::class , 'deleteTawkeel'])->name('mekawels.tawkeels.delete');
            Route::post('/mekawels/{mekawel}/tawkeels/store' , [MekawelsController::class , 'storeTawkeel'])->name('mekawels.tawkeels.store');
            // tawkeels
            Route::get('/tawkeels' , [TawkeelsController::class , 'index'])->name('tawkeels');
            Route::post('/tawkeels/store' , [TawkeelsController::class , 'store'])->name('tawkeels.store');
            Route::get('/tawkeels/{tawkeel}/delete' , [TawkeelsController::class , 'destroy']);
            // print records
            Route::get('/print-dates' , [PrintRecordsController::class , 'dates'])->name('print-dates');
            Route::get('/print-records/{printDate}/get' , [PrintRecordsController::class , 'index'])->name('print-records');
            Route::post('/print-records/store' , [PrintRecordsController::class , 'store'])->name('print-records.store');
            // outgoings
            Route::get('/outgoings' , [InOutController::class , 'outgoings'])->name('outgoings');
            Route::get('/outgoings/delete' , [InOutController::class , 'deleteOutgoings']);
            // incomings
            Route::get('/incomings' , [InOutController::class , 'incomings'])->name('incomings');
            Route::get('/incomings/delete' , [InOutController::class , 'deleteIncomings']);

            // outgoing records
            Route::get('/outgoing-dates' , [InOutController::class , 'outgoingDates']);
            Route::get('/outgoing-records/{outgoingDate}/get' , [InOutController::class , 'outgoingRecords']);
            Route::post('/outgoing-records/store' , [InOutController::class , 'storeOutgoingRecords']);
            // incoming records
            Route::get('/incoming-dates' , [InOutController::class , 'incomingDates']);
            Route::get('/incoming-records/{incomingDate}/get' , [InOutController::class , 'incomingRecords']);
            Route::post('/incoming-records/store' , [InOutController::class , 'storeIncomingRecords']);

        });

    });

});
