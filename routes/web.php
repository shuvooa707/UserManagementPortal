<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Accountactivated;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\LoggedIn;
use Illuminate\Log\Logger;

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

// Auth::routes("");


Route::get('/', function () {
    return view('welcome');
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::get('/profile', [ProfileController::class, "index"])->middleware([LoggedIn::class, Accountactivated::class])->name("profile");

Route::get("profile/edit", function(){
    return view("editprofile");
})->middleware([LoggedIn::class])->name("user.profile.edit");

Route::post("profile/edit", [ProfileController::class, "edit"])->middleware([LoggedIn::class])->name("profile.edit.save");



Route::get("login", function () {
    return view("login");
});
Route::get("/register", function () {
    return view("signup");
});

Route::get("/verifyemail", function(){
    // dd("dfjdik");
    return view("verifyemailnotice");
})->name("verifyemail");

Route::get("/user/verify-email/{token?}", [UserController::class, "verify"])->name("verifyemailsubmit");




Route::get("/resetpassword/{token?}", function ($token) {
    // check if the token is vaid then proceed
    $coloumn = DB::table('password_resets')->where("token", $token);
    if( $coloumn->count() ) {
        return view("forgetpassword", ["email" => $coloumn->first()->email]);
    } else {
        return redirect("login");
    }
})->name("resetpassword");

Route::post("/resetpasswordrequest", [UserController::class, "ResetPassword"])->name("resetpasswordsubmit");

Route::get("/passwordresetrequest", function() {
    return view("resetpasswordrequest");
})->name("resetpasswordrequest");

Route::post("/passwordresetrequest", [UserController::class, "sendPasswordResetToken"])->name("resetpasswordrequestsubmit");



Route::post("register", [UserController::class, "store"])->name("register");
Route::post("login", [UserController::class, "login"])->name("login");


Route::get('/logout', function(){
    Auth::logout();
    return redirect("login");
})->name("logout");


Route::get('/dashboard/{type?}', [DashboardController::class, "index"])->name("dashboard")->middleware([LoggedIn::class]);



Route::get("user/{id?}", [UserController::class, "show"])->name("user.show");
Route::get("user/{id?}/edit", function($id) {
    $user = \App\Models\User::find($id);
    return view("edituser", ["user" => $user]);
})->name("user.edit");

Route::post("user/edit/save", [UserController::class, "update"])->name("user.edit.save");

Route::post("user/delete", [UserController::class, "destroy"])->name("user.delete")->middleware([LoggedIn::class]);

Route::post("user/activate", [UserController::class, "activate"])->name("user.activate")->middleware([LoggedIn::class]);
Route::post("user/deactivate", [UserController::class, "deactivate"])->name("user.deactivate")->middleware([LoggedIn::class]);

//
