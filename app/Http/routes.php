<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::auth();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    
    
   
    
    
    
    
    
   

    route::get('profil','ProfilController@editprofil');
    route::post('profil/update','ProfilController@updateprofil');
    route::get('password','ProfilController@editpassword');
    route::post('password/update','ProfilController@updatepassword');

    route::get('lapbm','LaporanController@bm');
    route::get('lapbmdwn','LaporanController@lapbmdwn');
    route::get('lapbmperiode','LaporanController@lapbmperiode');
    route::post('lapbmperiodetampil','LaporanController@lapbmperiodetampil');

    route::get('lapbk','LaporanController@bk');
    route::get('lapbkdwn','LaporanController@lapbkdwn');
    route::get('lapbkperiode','LaporanController@lapbkperiode');
    route::post('lapbkperiodetampil','LaporanController@lapbkperiodetampil');

    route::get('lapbre','LaporanController@bre');
    route::get('lapbredwn','LaporanController@lapbredwn');
    route::get('lapbreperiode','LaporanController@lapbreperiode');
    route::post('lapbreperiodetampil','LaporanController@lapbreperiodetampil');

    route::get('lapbru','LaporanController@bru');
    route::get('lapbrudwn','LaporanController@lapbrudwn');
    route::get('lapbruperiode','LaporanController@lapbruperiode');
    route::post('lapbruperiodetampil','LaporanController@lapbruperiodetampil');

    route::get('lapbrg','LaporanController@brg');
    route::get('lapbrgdwn','LaporanController@lapbrgdwn');
    route::get('lapbrgperiode','LaporanController@lapbrgperiode');
    route::post('lapbrgperiodetampil','LaporanController@lapbrgperiodetampil');

    // laporan perkatagori

    // route::get('lapbmkat','LaporanController@brg');
    // route::get('lapbrgdwn','LaporanController@lapbrgdwn');
    route::get('lapbmkat','LaporanController@lapbmkat');
    route::post('lapbmkattampil','LaporanController@lapbmkattampil');

    route::get('lapbkkat','LaporanController@lapbkkat');
    route::post('lapbkkattampil','LaporanController@lapbkkattampil');

     route::get('lapbrkat','LaporanController@lapbrkat');
    route::post('lapbrkattampil','LaporanController@lapbrkattampil');



});



Route::group(['prefix' => 'member','middleware' => ['auth','role:member']], function () {

    route::resource('memberbmasuk','MemberBmasukController');
    route::resource('memberbkeluar','MemberBkeluarController');
    route::resource('memberretur','MemberReturController');
    route::resource('memberbrusak','MemberRusakController');
    route::resource('memberbarang','MemberBarangController');

    

});



Route::group(['prefix' => 'admin', 'middleware' => ['auth','role:admin']],function () {

    route::resource('satuan','SatuanController');
    route::resource('barang', 'BarangController');
    route::resource('kategori','KategoriController');
    route::resource('member', 'MemberController');
    route::resource('bmasuk', 'BmasukController');
    route::resource('bkeluar', 'BkeluarController');
    route::resource('retur', 'ReturController');

});