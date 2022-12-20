<?php

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


//fungsi awal
Route::get('/', 'homeController@home');
Route::get('/about', 'homeController@about');
Route::get('/logreg','homeController@logreg');

//proses login dan register milik murid dan guru
Route::post('/register-proses','homeController@prosesregister');
Route::post('/login-proses','homeController@proseslogin');

//admin
Route::get('/logreg-admin','homeController@logreg_admin');
Route::post('/register-proses-admin','homeController@prosesregisteradmin');
Route::post('/login-proses-admin','homeController@prosesloginadmin');
Route::get('/dashboard-admin','adminController@dashboard');
Route::get('/admin-{id}-edit','adminController@editprofile');
Route::post('/edit-profile-{id}-process-admin','adminController@editprofileprocess');
Route::get('/home-admin','adminController@home');
Route::get('/make-class-admin','adminController@makeclass');
Route::post('/make-class-process-admin','adminController@makeclassprocess');
Route::get('/class-{id}-delete-admin','adminController@deleteclass');
Route::get('/class-{id}-edit-admin','adminController@editclass');
Route::post('/edit-class-process-admin','adminController@editclassprocess');
Route::get('/class-{id}-topics-admin','adminController@viewtopic');
Route::get('/class-{id}-make-topic-admin','adminController@maketopic');
Route::post('/make-topic-process-admin','adminController@maketopicprocess');
Route::get('/topic-{id}-detail-admin','adminController@viewtopicdetail');
Route::get('/topic-{id}-edit-admin','adminController@edittopic');
Route::post('/edit-topic-process-admin','adminController@edittopicprocess');
Route::get('/topic-{id}-delete-admin','adminController@deletetopic');
Route::get('/teacher','adminController@teacher');
Route::get('/teacher-{id}-class','adminController@teacherclass');
Route::get('/teacher-{id}-profile','adminController@teacherprofile');
Route::get('/teacher-{id}-edit-admin','adminController@teacheredit');
Route::get('/add-account','adminController@addaccount');
Route::post('/add-account-process','adminController@addaccountprocess');
Route::post('/teacher-edit-profile-{id}-process-admin','adminController@teachereditprocess');
Route::get('/student','adminController@student');
Route::get('/student-{id}-profile','adminController@studentprofile');
Route::get('/student-{id}-edit-admin','adminController@studentedit');
Route::post('/student-edit-profile-{id}-process-admin','adminController@studenteditprocess');
Route::get('/delete-teacher-{id}','adminController@deleteteacher');
Route::get('/delete-student-{id}','adminController@deletestudent');
Route::get('/delete-admin-{id}','adminController@deleteadmin');

//student
Route::get('/dashboard-student','studentController@dashboard');
Route::get('/student-{id}-edit','studentController@editprofile');
Route::post('/student-edit-profile-{id}-process','studentController@editprofileprocess');
Route::get('/home-student','studentController@home');
Route::get('/join-class','studentController@joinclass');
Route::post('/join-class-process','studentController@joinclassprocess');
Route::get('/student-class-{id}-topics','studentController@viewtopic');
Route::get('/student-topic-{id}-detail','studentController@viewtopicdetail');
Route::get('/submit-files-{id}','studentController@submitfiles');
Route::post('/submit-files-process','studentController@submitfilesprocess');
Route::get('/student-file-{id}-delete','studentController@deletefile');
Route::get('/turn-in-topic-{id}','studentController@turnassignment');
Route::get('/cancel-topic-{id}','studentController@cancelassignment');

//teacher
Route::get('/dashboard-teacher','teacherController@dashboard');
Route::get('/teacher-{id}-edit','teacherController@editprofile');
Route::post('/edit-profile-{id}-process','teacherController@editprofileprocess');
Route::get('/home-teacher','teacherController@home');
Route::get('/make-class','teacherController@makeclass');
Route::post('/make-class-process','teacherController@makeclassprocess');
Route::get('/class-{id}-topics','teacherController@viewtopic');
Route::get('/class-{id}-make-topic','teacherController@maketopic');
Route::post('/make-topic-process','teacherController@maketopicprocess');
Route::get('/topic-{id}-detail','teacherController@viewtopicdetail');
Route::get('/topic-{id}-edit','teacherController@edittopic');
Route::post('/edit-topic-process','teacherController@edittopicprocess');
Route::get('/topic-{id}-delete','teacherController@deletetopic');
Route::get('/class-{id}-edit','teacherController@editclass');
Route::post('/edit-class-process','teacherController@editclassprocess');
Route::get('/class-{id}-delete','teacherController@deleteclass');
Route::get('/teacher-file-{id}-delete','teacherController@deletefile');

//logout
Route::get('/logout','homeController@logout');
