<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return redirect('/userLogin');
});

// Web API Routes
Route::post('/user-registration',[UserController::class,'UserRegistration']);
Route::post('/user-login',[UserController::class,'UserLogin']);
Route::post('/send-otp',[UserController::class,'SendOTPCode']);
Route::post('/verify-otp',[UserController::class,'VerifyOTP']);
// User Logout
Route::get('/logout',[UserController::class,'UserLogout']);
// Page Routes
Route::get('/userLogin',[UserController::class,'LoginPage'])->name('login');
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOTPPage']);

Route::group(['middleware' => 'auth'], function() {

    Route::get('/dashboard',[DashboardController::class,'DashboardPage'])->name('home');
    Route::get('/resetPassword',[UserController::class,'ResetPasswordPage']);
    Route::get('/userProfile',[UserController::class,'ProfilePage']);
   
    Route::get('/categoryPage',[CategoryController::class,'CategoryPage']);
    Route::get('/customerPage',[CustomerController::class,'CustomerPage']);
    Route::get('/productPage',[ProductController::class,'ProductPage']);
    Route::get('/invoicePage',[InvoiceController::class,'InvoicePage']);
    Route::get('/salePage',[InvoiceController::class,'SalePage']);

    Route::post('/reset-password',[UserController::class,'ResetPassword']);
    Route::get('/user-profile',[UserController::class,'UserProfile']);
    Route::post('/user-update',[UserController::class,'UpdateProfile']);
    // Category API
    Route::post("/create-category",[CategoryController::class,'CategoryCreate']);
    Route::get("/list-category",[CategoryController::class,'CategoryList']);
    Route::post("/delete-category",[CategoryController::class,'CategoryDelete']);
    Route::post("/update-category",[CategoryController::class,'CategoryUpdate']);
    Route::post("/category-by-id",[CategoryController::class,'CategoryByID']);


    // Customer API
    Route::post("/create-customer",[CustomerController::class,'CustomerCreate']);
    Route::get("/list-customer",[CustomerController::class,'CustomerList']);
    Route::post("/delete-customer",[CustomerController::class,'CustomerDelete']);
    Route::post("/update-customer",[CustomerController::class,'CustomerUpdate']);
    Route::post("/customer-by-id",[CustomerController::class,'CustomerByID']);



    // Invoice
    Route::post("/invoice-create",[InvoiceController::class,'invoiceCreate']);
    Route::get("/invoice-select",[InvoiceController::class,'invoiceSelect']);
    Route::get("/invoice-delete",[InvoiceController::class,'invoiceDelete']);

    // Product API
    Route::post("/create-product",[ProductController::class,'CreateProduct']);
    Route::post("/delete-product",[ProductController::class,'DeleteProduct']);
    Route::post("/update-product",[ProductController::class,'UpdateProduct']);
    Route::get("/list-product",[ProductController::class,'ProductList']);
    Route::post("/product-by-id",[ProductController::class,'ProductByID']);


});