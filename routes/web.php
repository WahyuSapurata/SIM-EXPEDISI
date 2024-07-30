<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'Dashboard@index')->name('home.index');

    Route::get('/', 'Landing@index')->name('landing');

    Route::group(['prefix' => 'login', 'middleware' => ['guest'], 'as' => 'login.'], function () {
        Route::get('/dlm-akun', 'Auth@show')->name('dlm-akun');
        Route::post('/login-proses', 'Auth@login_proses')->name('login-proses');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
        Route::get('/dashboard-admin', 'Dashboard@dashboard_admin')->name('dashboard-admin')->middleware('userAkses:admin');

        Route::get('/customer', 'DataCustomerController@index')->name('customer')->middleware('userAkses:admin');
        Route::get('/get-customer', 'DataCustomerController@get')->name('get-customer')->middleware('userAkses:admin');
        Route::get('/show-customer/{params}', 'DataCustomerController@show')->name('show-customer')->middleware('userAkses:admin');
        Route::post('/add-customer', 'DataCustomerController@store')->name('add-customer')->middleware('userAkses:admin');
        Route::post('/update-customer/{params}', 'DataCustomerController@update')->name('update-customer')->middleware('userAkses:admin');
        Route::delete('/delete-customer/{params}', 'DataCustomerController@delete')->name('delete-customer')->middleware('userAkses:admin');

        Route::get('/realcost', 'RealCostController@index')->name('realcost')->middleware('userAkses:admin');
        Route::get('/get-realcost', 'RealCostController@get')->name('get-realcost')->middleware('userAkses:admin');
        Route::get('/show-realcost/{params}', 'RealCostController@show')->name('show-realcost')->middleware('userAkses:admin');
        Route::post('/add-realcost', 'RealCostController@store')->name('add-realcost')->middleware('userAkses:admin');
        Route::post('/update-realcost/{params}', 'RealCostController@update')->name('update-realcost')->middleware('userAkses:admin');
        Route::delete('/delete-realcost/{params}', 'RealCostController@delete')->name('delete-realcost')->middleware('userAkses:admin');

        Route::get('/invoice', 'Invoice@index')->name('invoice')->middleware('userAkses:admin');
        Route::get('/get-invoice', 'Invoice@get')->name('get-invoice')->middleware('userAkses:admin');
        Route::get('/show-invoice/{params}', 'Invoice@show')->name('show-invoice')->middleware('userAkses:admin');
        Route::post('/update-invoice/{params}', 'Invoice@update')->name('update-invoice')->middleware('userAkses:admin');
        Route::get('/print-invoice/{params}', 'Invoice@print')->name('print-invoice')->middleware('userAkses:admin');

        Route::get('/piutang', 'PiutanController@index')->name('piutang')->middleware('userAkses:admin');
        Route::get('/get-piutang', 'PiutanController@get')->name('get-piutang')->middleware('userAkses:admin');
        Route::get('/show-piutang/{params}', 'PiutanController@show')->name('show-piutang')->middleware('userAkses:admin');
        Route::post('/update-piutang/{params}', 'PiutanController@update')->name('update-piutang')->middleware('userAkses:admin');

        Route::get('/penawaran', 'PenawaranController@index')->name('penawaran')->middleware('userAkses:admin');
        Route::get('/get-penawaran', 'PenawaranController@get')->name('get-penawaran')->middleware('userAkses:admin');
        Route::get('/show-penawaran/{params}', 'PenawaranController@show')->name('show-penawaran')->middleware('userAkses:admin');
        Route::post('/add-penawaran', 'PenawaranController@store')->name('add-penawaran')->middleware('userAkses:admin');
        Route::post('/update-penawaran/{params}', 'PenawaranController@update')->name('update-penawaran')->middleware('userAkses:admin');
        Route::delete('/delete-penawaran/{params}', 'PenawaranController@delete')->name('delete-penawaran')->middleware('userAkses:admin');
        Route::get('/print-penawaran/{params}', 'PenawaranController@print')->name('print-penawaran')->middleware('userAkses:admin');

        Route::prefix('biaya-operasional')->group(function () {
            Route::get('/operasional', 'OperasionalKantorController@index')->name('operasional')->middleware('userAkses:admin');
            Route::get('/get-operasional', 'OperasionalKantorController@get')->name('get-operasional')->middleware('userAkses:admin');
            Route::get('/show-operasional/{params}', 'OperasionalKantorController@show')->name('show-operasional')->middleware('userAkses:admin');
            Route::post('/add-operasional', 'OperasionalKantorController@store')->name('add-operasional')->middleware('userAkses:admin');
            Route::post('/update-operasional/{params}', 'OperasionalKantorController@update')->name('update-operasional')->middleware('userAkses:admin');
            Route::delete('/delete-operasional/{params}', 'OperasionalKantorController@delete')->name('delete-operasional')->middleware('userAkses:admin');

            Route::get('/invetaris', 'ByInvetaris@index')->name('invetaris')->middleware('userAkses:admin');
            Route::get('/get-invetaris', 'ByInvetaris@get')->name('get-invetaris')->middleware('userAkses:admin');
            Route::get('/show-invetaris/{params}', 'ByInvetaris@show')->name('show-invetaris')->middleware('userAkses:admin');
            Route::post('/add-invetaris', 'ByInvetaris@store')->name('add-invetaris')->middleware('userAkses:admin');
            Route::post('/update-invetaris/{params}', 'ByInvetaris@update')->name('update-invetaris')->middleware('userAkses:admin');
            Route::delete('/delete-invetaris/{params}', 'ByInvetaris@delete')->name('delete-invetaris')->middleware('userAkses:admin');

            Route::get('/biaya', 'Biaya@index')->name('biaya')->middleware('userAkses:admin');
            Route::get('/get-biaya', 'Biaya@get')->name('get-biaya')->middleware('userAkses:admin');
            Route::get('/show-biaya/{params}', 'Biaya@show')->name('show-biaya')->middleware('userAkses:admin');
            Route::post('/add-biaya', 'Biaya@store')->name('add-biaya')->middleware('userAkses:admin');
            Route::post('/update-biaya/{params}', 'Biaya@update')->name('update-biaya')->middleware('userAkses:admin');
            Route::delete('/delete-biaya/{params}', 'Biaya@delete')->name('delete-biaya')->middleware('userAkses:admin');
        });

        Route::get('/get-saldo', 'SaldoAwalController@get')->name('get-saldo')->middleware('userAkses:admin');
        Route::post('/add-saldo', 'SaldoAwalController@store')->name('add-saldo')->middleware('userAkses:admin');

        Route::get('/laporan', 'Laporan@index')->name('laporan')->middleware('userAkses:admin');
        Route::get('/get-laporan/{params}', 'Laporan@get')->name('get-laporan')->middleware('userAkses:admin');
        Route::get('/export-laporan/{params}', 'Laporan@exportToExcel')->name('export-laporan')->middleware('userAkses:admin');
        Route::get('/cetak-neraca/{params}', 'Laporan@cetak_neraca')->name('cetak-neraca')->middleware('userAkses:admin');

        Route::get('/chart', 'Dashboard@areaChart')->name('chart')->middleware('userAkses:admin');
    });

    Route::group(['prefix' => 'owner', 'middleware' => ['auth'], 'as' => 'owner.'], function () {
        Route::get('/dashboard-owner', 'Dashboard@dashboard_owner')->name('dashboard-owner')->middleware('userAkses:owner');

        Route::get('/customer', 'DataCustomerController@owner')->name('customer')->middleware('userAkses:owner');
        Route::get('/get-customer', 'DataCustomerController@get')->name('get-customer')->middleware('userAkses:owner');

        Route::get('/piutang', 'PiutanController@owner')->name('piutang')->middleware('userAkses:owner');
        Route::get('/get-piutang', 'PiutanController@get')->name('get-piutang')->middleware('userAkses:owner');

        Route::get('/laporan', 'Laporan@owner')->name('laporan')->middleware('userAkses:owner');
        Route::get('/get-laporan/{params}', 'Laporan@get')->name('get-laporan')->middleware('userAkses:owner');
        Route::get('/export-laporan/{params}', 'Laporan@exportToExcel')->name('export-laporan')->middleware('userAkses:owner');
        Route::get('/cetak-neraca/{params}', 'Laporan@cetak_neraca')->name('cetak-neraca')->middleware('userAkses:owner');

        Route::get('/chart', 'Dashboard@areaChart')->name('chart')->middleware('userAkses:owner');
    });

    Route::get('/error500', 'Dashboard@error500')->name('dashboard-error500');
    Route::get('/logout', 'Auth@logout')->name('logout');
});
