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

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

// ログイン
Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

// SessionsController
Route::get('login', 'SessionsController@create')->name('login'); // 显示登陆页面
Route::post('login', 'SessionsController@store')->name('login'); // 创建新会话
Route::delete('logout', 'SessionsController@destroy')->name('logout'); // 销毁会话（退出登录）

//Mail
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

// 忘记密码
Route::get('password/reset', 'PasswordController@showLinkRequestForm')->name('password.request'); // 填写 Email 的表单
Route::post('password/email', 'PasswordController@sendResetLinkEmail')->name('password.email'); // 处理表单提交，成功的话就发送邮件，附带 Token 的链接

Route::get('password/reset/{token}', 'PasswordController@showResetForm')->name('password.reset'); // 显示更新密码的表单，包含 token
Route::post('password/reset', 'PasswordController@reset')->name('password.update'); // 对提交过来的 token 和 email 数据进行配对，正确的话更新密码
