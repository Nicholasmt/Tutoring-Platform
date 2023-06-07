<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;

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

// Route::get('/', function () {
//     $categories = Category::all();
//     return view('index',compact('categories'));
// });

Route::get('/', [App\Http\Controllers\frontController::class, 'index'])->name('index');
Route::get('choose-profile', [App\Http\Controllers\AuthsController::class, 'choose_profile'])->name('choose-profile');
Route::get('super', [App\Http\Controllers\AdminAuthController::class, 'index'])->name('super');
Route::get('sign-up-teacher', [App\Http\Controllers\AuthsController::class, 'teachers_signup'])->name('teachers-sign-up');
Route::get('sign-up-student', [App\Http\Controllers\AuthsController::class, 'parent_signup'])->name('parent-sign-up');
Route::get('sign-in', [App\Http\Controllers\AuthsController::class, 'signin'])->name('sign-in');
Route::get('terms-of-service', [App\Http\Controllers\AuthsController::class, 'terms'])->name('terms');
Route::get('privacy-policy', [App\Http\Controllers\AuthsController::class, 'policy'])->name('policy');
Route::get('forgot-password', [App\Http\Controllers\AuthsController::class, 'forgot_password'])->name('forgot-password');
Route::get('redirect', [App\Http\Controllers\TeachersAuthController::class, 'redirect'])->name('redirect');
Route::post('authentication', [App\Http\Controllers\TeachersAuthController::class, 'authentication'])->name('teachers-auth');
Route::get('email-verification', [App\Http\Controllers\EmailVerificationController::class, 'email_verify'])->name('email-verify');
Route::get('send-mail', [App\Http\Controllers\EmailVerificationController::class, 'send_mail'])->name('send-mail');
Route::get('confirm-email/{id}', [App\Http\Controllers\EmailVerificationController::class, 'confirm_email'])->name('confirm-email');
Route::get('logout', [App\Http\Controllers\AuthsController::class, 'logout'])->name('app-logout');
Route::get('find-a-tutor', [App\Http\Controllers\frontController::class, 'explore'])->name('explore');
Route::get('tutor-request', [App\Http\Controllers\frontController::class, 'tutor_request'])->name('tutor_request');
Route::get('tutors-details/{id}', [App\Http\Controllers\frontController::class, 'details'])->name('details');
Route::get('bookings/{id}', [App\Http\Controllers\BookingController::class, 'bookings'])->name('bookings');
 
// Socialite
Route::post('socialite', [App\Http\Controllers\SocialiteController::class, 'socialite'])->name('socialite');
Route::get('google-auth-callback', [App\Http\Controllers\SocialiteController::class, 'google_callback'])->name('teachers_callback');
Route::get('facebook-auth-callback', [App\Http\Controllers\SocialiteController::class, 'facebook_callback'])->name('facebook_callback');
 
Route::resource('auths', App\Http\Controllers\AuthsController::class);
Route::resource('olukotide-admins', App\Http\Controllers\AdminAuthController::class);
Route::resource('authteachers', App\Http\Controllers\TeachersAuthController::class);
Route::resource('authstudents', App\Http\Controllers\StudentsController::class);
Route::get('fliter-teachers/{model}/{search}', [App\Http\Controllers\PageFlitersController::class, 'show'])->name('fliter-page');
Route::get('advanced-fliter', [App\Http\Controllers\PageFlitersController::class, 'advanced_fliter'])->name('advanced_fliter');
Route::post('search-subjects', [App\Http\Controllers\PageFlitersController::class, 'search_subject'])->name('search-subject');
// Route::post('form-submit', [App\Http\Controllers\TeachersAuthController::class, 'store'])->name('form-submit');

 // zoom webhook
 Route::post('zoom/webhook', [App\Http\Controllers\ZoomWebHookController::class, 'webhook_handler'])->name('webhook-zoom');
 Route::post('switchapp/webhook', [App\Http\Controllers\PaymentController::class, 'webhook_handler'])->name('-webhook');

 //rest passowrd
 Route::get('reset/password/{email}', [App\Http\Controllers\AuthsController::class, 'reset_password'])->name('password-resst');
 Route::get('password/changed', [App\Http\Controllers\AuthsController::class,  'password_changed'])->name('password-changed');
 Route::post('reset', [App\Http\Controllers\AuthsController::class, 'reset'])->name('reset');


Route::group(['prefix'=>'admin' ,'as'=>'admin','middleware'=>'admin'], function(){
    Route::get('dashboard', [App\Http\Controllers\AdminAuthController::class, 'dashboard'])->name('-dashboard');
    Route::get('class-records', [App\Http\Controllers\AdminAuthController::class, 'classRecords'])->name('-class-records');
    Route::resource('verifications', App\Http\Controllers\VerificationsController::class);
    Route::resource('complaints', App\Http\Controllers\ComplaintsController::class);
    Route::resource('settings', App\Http\Controllers\AdminAuthController::class);
    Route::get('decline-info', [App\Http\Controllers\VerificationsController::class,'confirm_decline'])->name('-confirm_decline');
    Route::get('supervise_class/{id}', [App\Http\Controllers\AdminAuthController::class,'supervise_class'])->name('-supervise');
   
});

Route::group(['prefix'=>'teachers' ,'as'=>'teachers','middleware'=>'teachers'], function(){
    Route::get('dashboard', [App\Http\Controllers\TeacherController::class, 'index'])->name('-dashboard');
    Route::get('stage1', [App\Http\Controllers\TeachersAuthController::class, 'form1'])->name('-form1');
    Route::get('stage2', [App\Http\Controllers\TeachersAuthController::class, 'form2'])->name('-form2');
    Route::post('form-wizard', [App\Http\Controllers\TeachersAuthController::class, 'form_wizard'])->name('-wizard');
    Route::get('profile-preview', [App\Http\Controllers\TeachersAuthController::class, 'profile_preview'])->name('profile-preview');
    Route::get('add-schedule/{count}', [App\Http\Controllers\TeachersAuthController::class, 'add_schedule'])->name('add-schedule');
    Route::get('add-certification/{count}', [App\Http\Controllers\TeachersAuthController::class, 'add_certification'])->name('add-certification');
    Route::get('add-qualification/{count}', [App\Http\Controllers\TeachersAuthController::class, 'add_qualification'])->name('add-qualification');
    Route::get('form-completed', [App\Http\Controllers\TeachersAuthController::class, 'form_completed'])->name('form-completed');
    Route::get('form-wizard-edit', [App\Http\Controllers\TeachersAuthController::class, 'wizard_edit'])->name('-wizard-edit');
    Route::get('settings', [App\Http\Controllers\TeacherController::class, 'profile_setting'])->name('-profile-setting');
    Route::get('booking-details/{id}', [App\Http\Controllers\MessagesController::class, 'booking_details'])->name('-booking_details');
    Route::get('load-message/{id}', [App\Http\Controllers\TeachersMessageController::class, 'load_message'])->name('-load-message');
    Route::get('class-details/{id}', [App\Http\Controllers\MyClassesController::class, 'load_details'])->name('-class-detail');
    Route::get('time-break', [App\Http\Controllers\TeacherController::class, 'select_break'])->name('-select_break');
    Route::get('formWizard-timebrake', [App\Http\Controllers\TeacherController::class, 'select_breakFormWizard'])->name('-select_break');
    Route::get('step-wizard', [App\Http\Controllers\frontController::class, 'wizard'])->name('-step-wizard');
    Route::get('transaction-page', [App\Http\Controllers\PaginatorController::class, 'transactions'])->name('-transactions-page');
    Route::get('view-booking-request/{id}', [App\Http\Controllers\BookingController::class, 'booking_requests'])->name('booking-requests');
    Route::post('handle-orders_order', [App\Http\Controllers\BookingController::class, 'handle_orders'])->name('-booking-orders');

    Route::get('create-class/{id}/{time}', [App\Http\Controllers\MyClassesController::class, 'create_class'])->name('-create-class');

    Route::resource('form-updates', App\Http\Controllers\TeachersAuthController::class);
    Route::resource('profile-settings', App\Http\Controllers\TeacherController::class);
    Route::resource('messages', App\Http\Controllers\TeachersMessageController::class);
    Route::resource('schedules', App\Http\Controllers\SchedulesController::class);
    Route::resource('myclasses', App\Http\Controllers\MyClassesController::class);
    Route::resource('wallets', App\Http\Controllers\WalletController::class);
    
    
    Route::resource('profile-resubmits', App\Http\Controllers\profileResubmitController::class);


});

Route::group(['prefix'=>'parents' ,'as'=>'parents','middleware'=>'parents'], function(){
    Route::get('dashboard', [App\Http\Controllers\StudentsController::class, 'index'])->name('-dashboard');
    Route::resource('my-tutors', App\Http\Controllers\MyTeachersController::class);
    Route::resource('settings', App\Http\Controllers\StudentsController::class);
    Route::resource('messages', App\Http\Controllers\MessagesController::class);
    Route::resource('schedules', App\Http\Controllers\SchedulesController::class);
    Route::resource('wallets', App\Http\Controllers\WalletController::class);
    Route::resource('payments', App\Http\Controllers\PaymentController::class);
     
    Route::get('load-teacher/{id}', [App\Http\Controllers\MyTeachersController::class, 'loader'])->name('-t-loader');
    Route::get('load-request/{id}', [App\Http\Controllers\MyTeachersController::class, 'load_request'])->name('-r-loader');
    Route::get('booking-details/{id}', [App\Http\Controllers\MessagesController::class, 'booking_details'])->name('-booking_details');
    Route::get('load-message/{id}', [App\Http\Controllers\MessagesController::class, 'load_message'])->name('-load-message');
    Route::get('ratings/{id}', [App\Http\Controllers\RatingController::class, 'show'])->name('-rating-modal');
    Route::get('save-rating/{id}', [App\Http\Controllers\RatingController::class, 'update'])->name('-save-rating');
    Route::get('pay-modal/{id}', [App\Http\Controllers\StudentsController::class, 'pay_modal'])->name('-pay-modal');
    Route::get('decline-modal/{id}', [App\Http\Controllers\StudentsController::class, 'decline_modal'])->name('-decline-modal');
    Route::get('complain-modal/{id}', [App\Http\Controllers\ComplaintsController::class, 'complain_modal'])->name('-complain-modal');
    Route::post('complain/store', [App\Http\Controllers\ComplaintsController::class, 'store'])->name('-save-complain');
    Route::get('flutterwave/callback',[App\Http\Controllers\PaymentController::class,'deposit_callback'])->name('-depositCallback');
    Route::get('confirm/completed/{id}', [App\Http\Controllers\BookingController::class, 'confirm_class'])->name('confirm_class');
    Route::get('smart-search', [App\Http\Controllers\SearchController::class, 'search'])->name('-smartSearch');
    //booking
    Route::post('schedule-date', [App\Http\Controllers\BookingController::class, 'schedule_date'])->name('-schedule-date');
    Route::post('booking-checkout', [App\Http\Controllers\BookingController::class, 'booking_checkout'])->name('-booking_checkout');
    Route::get('logged-checkout/{id}', [App\Http\Controllers\BookingController::class, 'logged_checkout'])->name('-logged_checkout');
    Route::get('available-time/{id}', [App\Http\Controllers\BookingController::class, 'available_times'])->name('available_times');
    Route::get('selected-time/{id}', [App\Http\Controllers\BookingController::class, 'selected_time'])->name('selected-time');
    Route::get('checkout-booking', [App\Http\Controllers\BookingController::class, 'checkout'])->name('check-out');
    Route::post('store-booking', [App\Http\Controllers\BookingController::class, 'store_booking'])->name('-store-booking');
    Route::get('view-booking-request/{id}', [App\Http\Controllers\BookingController::class, 'booking_requests'])->name('booking-requests');
    //paginator
    Route::get('requests-page', [App\Http\Controllers\PaginatorController::class, 'requests'])->name('-requests-page');
    Route::get('list-techers-page', [App\Http\Controllers\PaginatorController::class, 'my_teachers'])->name('-list-teachers-page');
    Route::get('grid-teachers-page', [App\Http\Controllers\PaginatorController::class, 'my_teachers_grid'])->name('-grid-teachers-page');
    Route::get('current-teachers-page', [App\Http\Controllers\PaginatorController::class, 'current_teachers'])->name('-current-teachers-page');
    Route::get('transaction-page', [App\Http\Controllers\PaginatorController::class, 'transactions'])->name('-transactions-page');

    Route::get('join_class/{id}', [App\Http\Controllers\MyClassesController::class, 'join_class'])->name('-join-class'); 
    Route::get('fund-wallet', [App\Http\Controllers\PaymentController::class,'fund_wallet'])->name('-fundWallet'); 
    Route::get('switchapp/callback', [App\Http\Controllers\PaymentController::class, 'switchappCallback'])->name('-callback');
    // Route::post('switchapp/webhook', [App\Http\Controllers\PaymentController::class, 'webhook_handler'])->name('-webhook');
   
   

});