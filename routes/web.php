<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/admin', function () {
    return redirect('admin/dashboard');
});

Auth::routes();

// Route::get('/home', 'HomeController@index');

// Route::group(['middleware' => ['web']], function () {

//     //Blog
//     // Route::resource('blog', 'BlogController');
//     Route::get('blog', 'Frontend\BlogController@index');
//     Route::get('blog/read/{id}/{slug}', 'Frontend\BlogController@read');


//     //BACKEND################################################
//     Route::get('login', 'UserLoginController@getUserLogin');
//     Route::get('logout', 'UserLoginController@logout');
//     Route::post('login', ['as'=>'user.auth','uses'=>'UserLoginController@userAuth']);

    
// });

Route::get('login', 'AdminLoginController@getAdminLogin');
Route::post('login', ['as'=>'admin.auth','uses'=>'AdminLoginController@adminAuth']);
Route::get('forgotpassword', 'AdminLoginController@forgotPassword')->name('forgotpassword');
Route::get('resetpassword/{token}', 'AdminLoginController@resetPassword')->name('resetpassword');
Route::post('forgotpasswordpost', 'AdminLoginController@forgotPasswordPost');
Route::post('resetpasswordpost', 'AdminLoginController@resetPasswordPost')->name('resetpasswordpost');

Route::group(['middleware' => ['admin']], function () {
    Route::get('logout', 'AdminLoginController@logout');
    Route::get('dashboard', ['as'=>'admin.dashboard','uses'=>'AdminController@dashboard']);
    Route::get('dashboard/getDataDashboard','Admin\FileController@getDataDashboard')->name('file.dashboard');

    //Admin
    Route::resource('users', 'Admin\AdminUsersController');
    Route::get('users/delete/{user}','Admin\AdminUsersController@delete');
    Route::post('users/updatedata/{user}','Admin\AdminUsersController@updatedata');

    //Files
    Route::resource('files', 'Admin\FileController\organizeFile ');
    

    //Category
    Route::get('category/dataSelect','Admin\CategoryController@dataSelect')->name('category.dataselect');
    Route::resource('category', 'Admin\CategoryController');
    Route::get('category/delete/{category}','Admin\CategoryController@delete')->name('category.delete');
    Route::post('category/getAllData','Admin\CategoryController@getAllData')->name('category.alldata');
    Route::post('category/getDetail','Admin\CategoryController@getDetail')->name('category.detaildata');
    Route::post('category/updatedata/{category}','Admin\CategoryController@updatedata')->name('category.update');
    Route::get('category/edit/{category}','Admin\CategoryController@edit')->name('category.edit');
    Route::post('category/createPopup','Admin\CategoryController@createPopup')->name('category.createpopup');

    //Tag
    Route::get('tag/dataSelect','Admin\TagController@dataSelect')->name('tag.dataselect');
    Route::get('tag/dataSelectSingle','Admin\TagController@dataSelectSingle')->name('tag.dataselectsingle');
    Route::resource('tag', 'Admin\TagController');
    Route::get('tag/delete/{tag}','Admin\TagController@delete')->name('tag.delete');
    Route::post('tag/getAllData','Admin\TagController@getAllData')->name('tag.alldata');
    Route::post('tag/getDetail','Admin\TagController@getDetail')->name('tag.detaildata');
    Route::post('tag/updatedata/{tag}','Admin\TagController@updatedata')->name('tag.update');
    Route::get('tag/edit/{tag}','Admin\TagController@edit')->name('tag.edit');
    Route::post('tag/createPopup','Admin\TagController@createPopup')->name('tag.createpopup');

    //Unit Kerja
    Route::get('unit_kerja/dataSelect','Admin\UnitKerjaController@dataSelect')->name('unit_kerja.dataselect');
    Route::resource('unit_kerja', 'Admin\UnitKerjaController');
    Route::get('unit_kerja/delete/{bidang}','Admin\UnitKerjaController@delete')->name('unit_kerja.delete');
    Route::post('unit_kerja/getAllData','Admin\UnitKerjaController@getAllData')->name('unit_kerja.alldata');
    Route::post('unit_kerja/getDetail','Admin\UnitKerjaController@getDetail')->name('unit_kerja.detaildata');
    Route::post('unit_kerja/updatedata/{bidang}','Admin\UnitKerjaController@updatedata')->name('unit_kerja.update');
    Route::get('unit_kerja/edit/{bidang}','Admin\UnitKerjaController@edit')->name('unit_kerja.edit');


    //Program
    Route::get('program/dataSelect','Admin\ProgramController@dataSelect')->name('program.dataselect');
    Route::resource('program', 'Admin\ProgramController');
    Route::get('program/delete/{program}','Admin\ProgramController@delete')->name('program.delete');
    Route::post('program/getAllData','Admin\ProgramController@getAllData')->name('program.alldata');
    Route::post('program/getDetail','Admin\ProgramController@getDetail')->name('program.detaildata');
    Route::post('program/updatedata/{program}','Admin\ProgramController@updatedata')->name('program.update');
    Route::post('program/storedetail','Admin\ProgramController@storeDetail')->name('program.storedetail');
    Route::post('program/deletekinerja','Admin\ProgramController@deleteKinerja')->name('program.deletekinerja');
    Route::post('program/editdetail','Admin\ProgramController@editDetail')->name('program.editdetail');
    Route::get('program/edit/{program}','Admin\ProgramController@edit')->name('program.edit');
    Route::post('program/getdetailkinerja','Admin\ProgramController@getdetailkinerja')->name('program.getdetailkinerja');

    //Kegiatan
    Route::get('kegiatan/dataSelect','Admin\KegiatanController@dataSelect')->name('kegiatan.dataselect');
    Route::resource('kegiatan', 'Admin\KegiatanController');
    Route::get('kegiatan/delete/{kegiatan}','Admin\KegiatanController@delete')->name('kegiatan.delete');
    Route::post('kegiatan/getDetail','Admin\KegiatanController@getDetail')->name('kegiatan.detaildata');
    Route::post('kegiatan/storedetail','Admin\KegiatanController@storeDetail')->name('kegiatan.storedetail');
    Route::post('kegiatan/getAllData','Admin\KegiatanController@getAllData')->name('kegiatan.alldata');
    Route::post('kegiatan/getDetail','Admin\KegiatanController@getDetail')->name('kegiatan.detaildata');
    Route::post('kegiatan/deletekinerja','Admin\KegiatanController@deleteKinerja')->name('kegiatan.deletekinerja');
    Route::post('kegiatan/updatedata/{kegiatan}','Admin\KegiatanController@updatedata')->name('kegiatan.update');
    Route::get('kegiatan/edit/{kegiatan}','Admin\KegiatanController@edit')->name('kegiatan.edit');
    Route::post('kegiatan/editdetail','Admin\KegiatanController@editDetail')->name('kegiatan.editdetail');
    Route::post('kegiatan/getdetailkinerja','Admin\KegiatanController@getdetailkinerja')->name('kegiatan.getdetailkinerja');

    //Sub Kegiatan
    Route::get('subkegiatan/dataSelect','Admin\SubkegiatanController@dataSelect')->name('subkegiatan.dataselect');
    Route::resource('subkegiatan', 'Admin\SubkegiatanController');
    Route::get('subkegiatan/delete/{subkegiatan}','Admin\SubkegiatanController@delete')->name('subkegiatan.delete');
    Route::post('subkegiatan/getAllData','Admin\SubkegiatanController@getAllData')->name('subkegiatan.alldata');
    Route::post('subkegiatan/getDetail','Admin\SubkegiatanController@getDetail')->name('subkegiatan.detaildata');
    Route::post('subkegiatan/updatedata/{subkegiatan}','Admin\SubkegiatanController@updatedata')->name('subkegiatan.update');
    Route::get('subkegiatan/edit/{subkegiatan}','Admin\SubkegiatanController@edit')->name('subkegiatan.edit');
    Route::post('subkegiatan/storedetail','Admin\SubkegiatanController@storeDetail')->name('subkegiatan.storedetail');
    Route::post('subkegiatan/deletekinerja','Admin\SubkegiatanController@deleteKinerja')->name('subkegiatan.deletekinerja');
    Route::post('subkegiatan/getdetailkinerja','Admin\SubkegiatanController@getdetailkinerja')->name('subkegiatan.getdetailkinerja');
    Route::post('subkegiatan/editdetail','Admin\SubkegiatanController@editDetail')->name('subkegiatan.editdetail');

    //Kinerja
    Route::resource('kinerja', 'Admin\KinerjaController');
    Route::get('kinerja/delete/{kinerja}','Admin\KinerjaController@delete')->name('kinerja.delete');
    Route::get('kinerja/capaian/{tahun}','Admin\KinerjaController@capaian')->name('kinerja.capaian');
    Route::post('kinerja/getAllData','Admin\KinerjaController@getAllData')->name('kinerja.alldata');
    Route::post('kinerja/getDetail','Admin\KinerjaController@getDetail')->name('kinerja.detaildata');
    Route::post('kinerja/updatedata/{kinerja}','Admin\KinerjaController@updatedata')->name('kinerja.update');
    Route::get('kinerja/edit/{kinerja}','Admin\KinerjaController@edit')->name('kinerja.edit');
    Route::post('kinerja/tambahcapaian/{tahun}','Admin\KinerjaController@store')->name('kinerja.tambahcapaian');
    Route::post('kinerja/editrealisasiprogram','Admin\KinerjaController@editRealisasiProgram')->name('kinerja.editrealisasiprogram');
    Route::post('kinerja/getrealisasiprogram','Admin\KinerjaController@getRealisasiProgram')->name('kinerja.getrealisasiprogram');
    Route::post('kinerja/editrealisasikegiatan','Admin\KinerjaController@editRealisasiKegiatan')->name('kinerja.editrealisasikegiatan');
    Route::post('kinerja/getrealisasikegiatan','Admin\KinerjaController@getRealisasiKegiatan')->name('kinerja.getrealisasikegiatan');    
    Route::post('kinerja/editrealisasisubkegiatan','Admin\KinerjaController@editRealisasiSubKegiatan')->name('kinerja.editrealisasisubkegiatan');
    Route::post('kinerja/getrealisasisubkegiatan','Admin\KinerjaController@getRealisasiSubKegiatan')->name('kinerja.getrealisasisubkegiatan');

    //File
    Route::get('file/dataSelect','Admin\FileController@dataSelect')->name('file.dataselect');
    Route::resource('file', 'Admin\FileController');
    Route::get('file/delete/{file}','Admin\FileController@delete')->name('file.delete');
    Route::post('file/getAllData','Admin\FileController@getAllData')->name('file.alldata');
    Route::post('file/updatedata/{file}','Admin\FileController@updatedata')->name('file.update');
    Route::get('file/edit/{file}','Admin\FileController@edit')->name('file.edit');
    Route::get('file/download/{file}','Admin\FileController@download')->name('file.download');
    Route::get('file/downloadHistory/{file}','Admin\FileController@downloadHistory')->name('file.downloadhistory');
    Route::post('file/getDetail','Admin\FileController@getDetail')->name('file.detaildata');
    Route::post('file/getHistory','Admin\FileController@getHistory')->name('file.datahistory');

    //Subcategory
    Route::resource('subcategory', 'Admin\SubcategoryController');
    Route::get('subcategory/delete/{subcategory}','Admin\SubcategoryController@delete')->name('subcategory.delete');
    Route::post('subcategory/getAllData','Admin\SubcategoryController@getAllData')->name('subcategory.alldata');
    Route::post('subcategory/updatedata/{subcategory}','Admin\SubcategoryController@updatedata')->name('subcategory.update');
    Route::get('subcategory/edit/{subcategory}','Admin\SubcategoryController@edit')->name('subcategory.edit.');

    //Blog Categories
    Route::resource('blog_categories', 'Admin\BlogCategoriesController');
    Route::get('blog_categories/delete/{blog_categories}','Admin\BlogCategoriesController@delete');
    Route::post('blog_categories/updatedata/{blog_categories}','Admin\BlogCategoriesController@updatedata');

    //Logs
    Route::resource('logs', 'Admin\LogsController');

    //Course
    Route::resource('course', 'Admin\CourseController');
    Route::get('course/delete/{course}','Admin\CourseController@delete');
    Route::post('course/updatedata/{course}','Admin\CourseController@updatedata');

    //Blog
    Route::resource('blog', 'Admin\BlogController');
    Route::get('blog/delete/{blog}','Admin\BlogController@delete');
    Route::post('blog/updatedata/{blog}','Admin\BlogController@updatedata');

    //Image
    Route::resource('image', 'Admin\ImageController');
    Route::get('image/delete/{image}','Admin\ImageController@delete');
    Route::post('image/updatedata/{image}','Admin\ImageController@updatedata');
    Route::get('image/viewlist/{image}','Admin\ImageController@viewlist');
    Route::post('image/getDetailImage','Admin\ImageController@getDetailImage');

    //Statis
    Route::resource('taman', 'Admin\TamanController');
    Route::get('lppd2020', 'Admin\StatisController@lppd2020')->name('lppd2020');
});