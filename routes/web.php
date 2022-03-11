<?php

use App\Http\Controllers\CalenderController;
use App\Http\Controllers\FullCalendarController;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\GoogleCalendar\Event;

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

//Frontend Routes
Route::get('/system/{page}', [App\Http\Controllers\SystemPageController::class, 'index'])->name('system');
Route::resource('submissions', App\Http\Controllers\AdminSubmissionController::class);
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');
Route::view('/register/client', 'auth.registerClient');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// General settings
Auth::routes(['verify'=> true]);

//Routes PWA
Route::get('/offline', function () {
    return view('modules/laravelpwa/offline');
});

Route::match(['get', 'post'], '/dashboard', function(){
    return view('admin/dashboard');
});


//Public Routes for member information
Route::get('/', 'App\Http\Controllers\DirectionController@getDirection')->name('direction');
Route::get('vCard/{id}', 'App\Http\Controllers\CardController@vCard')->name('members.vCard');
Route::get('QRcode/{id}', 'App\Http\Controllers\CardController@QRcode')->name('members.QRcode');
Route::post('generate/cards', 'App\Http\Controllers\CardController@generateCards')->name('generate.cards');

// Backend Routes
Route::group(['prefix'=>'admin', 'middleware'=>[ 'auth', 'verified']], function(){
    //Routes for CRUD members
    Route::resource('members', App\Http\Controllers\AdminMembersController::class);
    Route::get('archive/members', 'App\Http\Controllers\AdminMembersController@archive')->name('members.archive');
    Route::get('members/list/gen', 'App\Http\Controllers\AdminMembersController@membersList')->name('members.membersListGen');
    Route::patch('members/list/update', 'App\Http\Controllers\AdminMembersController@updateMembersList')->name('members.updateMembersList');

    //Routes for generating the URLS
    Route::POST('generate/member', 'App\Http\Controllers\AdminMembersController@generate')->name('members.generate');
    Route::POST('search/member', 'App\Http\Controllers\AdminMembersController@searchMember')->name('members.search');
    Route::get('generate/member/credentials', 'App\Http\Controllers\AdminMembersController@generateCredentialMemberList')->name('members.credentials');
    Route::get('member/list', 'App\Http\Controllers\CardController@listGenerator')->name('members.listGenerator');

    //Routes for listing the QRcodes
    Route::get('QRcodeList', 'App\Http\Controllers\QRcodeController@QRcodeList')->name('QRcodeList');
    Route::get('QRcodeListCustom', 'App\Http\Controllers\QRcodeController@QRcodeListWithParams')->name('QRcodeListCustom');
    Route::post('QRcodeSelect', 'App\Http\Controllers\QRcodeController@QRcodeSelect')->name('QRcodeSelect');

    Route::get('lock', 'App\Http\Controllers\CardController@lock')->name('lock');
    Route::get('unlock', 'App\Http\Controllers\CardController@unlock')->name('unlock');




    //Page Routes
    Route::get('/', [App\Http\Controllers\AdminHomeController::class, 'index'])->name('admin.home');
    Route::resource('credentials', App\Http\Controllers\AdminCompanyCredentialsController::class);
    Route::resource('homePage', App\Http\Controllers\HomePageController::class);
    Route::resource('disclaimer', App\Http\Controllers\DisclaimerController::class);
    Route::resource('privacy', App\Http\Controllers\PrivacyController::class);
    Route::resource('cookie', App\Http\Controllers\CookieController::class);
    Route::resource('content', App\Http\Controllers\AdminContentController::class);

    //User Routes
    Route::resource('users', App\Http\Controllers\AdminUsersController::class);
    Route::get('archive/users', 'App\Http\Controllers\AdminUsersController@archive')->name('users.archive');
    Route::resource('roles', App\Http\Controllers\AdminRolesController::class);
    Route::resource('billing', App\Http\Controllers\AdminBillingController::class);

    //Shop Routes
    Route::resource('products', App\Http\Controllers\AdminProductsController::class);
    Route::resource('promos', App\Http\Controllers\AdminPromoController::class);
    Route::resource('location', App\Http\Controllers\AdminLocationController::class);
    Route::get('archive/location', 'App\Http\Controllers\AdminLocationController@archive')->name('locations.archive');
    Route::get('archive/promos', 'App\Http\Controllers\AdminPromoController@archive')->name('promos.archive');

    //FAQ Routes
    Route::resource('faqs', App\Http\Controllers\AdminFaqController::class);
    Route::get('archive/faqs', 'App\Http\Controllers\AdminFaqController@archive')->name('faqs.archive');
    Route::get('faqs/delete/{id}', 'App\Http\Controllers\AdminFaqController@destroy')->name('faqs.delete');

    //Submissions Routes
    Route::get('/export/submissons', [App\Http\Controllers\AdminSubmissionController::class, 'export'])->name('submissions.export');
    Route::get('archive/submissions', 'App\Http\Controllers\AdminSubmissionController@archive')->name('submission.archive');


    // BLOG Routes
    Route::get('gallery', 'App\Http\Controllers\AdminPostController@gallery')->name('post.gallery');
    Route::resource('posts', App\Http\Controllers\AdminPostController::class);
    Route::resource('postcategories', App\Http\Controllers\AdminPostCategoryController::class);
    Route::get('archive/post-categories', 'App\Http\Controllers\AdminPostCategoryController@archive')->name('postcategories.archive');
    Route::resource('comments', App\Http\Controllers\AdminCommentController::class);
    Route::post('comments/reply', 'App\Http\Controllers\AdminCommentController@storeReply');
    Route::get('archive/posts', 'App\Http\Controllers\AdminPostController@archive')->name('post.archive');
    Route::get('frontend', 'App\Http\Controllers\AdminPostController@frontend')->name('post.frontend');

    //General Routes
    Route::get('components', 'App\Http\Controllers\ComponentController@index')->name('components.index');
    Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

    //Clients Routes
    Route::resource('clients', App\Http\Controllers\AdminClientController::class);
    Route::get('archive/clients', 'App\Http\Controllers\AdminClientController@archive')->name('clients.archive');
    Route::resource('addresses', App\Http\Controllers\AdminAddressesController::class);
    Route::resource('loyals', App\Http\Controllers\AdminLoyalController::class);
    Route::get('archive/loyals', 'App\Http\Controllers\AdminLoyalController@archive')->name('loyals.archive');
    Route::resource('sources', App\Http\Controllers\AdminSourceController::class);
    Route::get('archive/sources', 'App\Http\Controllers\AdminSourceController@archive')->name('sources.archive');

    //Testimonial Routes
    Route::resource('testimonials', App\Http\Controllers\TestimonialController::class);
    Route::get('archive/testimonials', 'App\Http\Controllers\TestimonialController@archive')->name('testimonials.archive');
    Route::get('testimonial/form', 'App\Http\Controllers\TestimonialController@form')->name('testimonials.form');

    //Booking Routes
    Route::resource('bookings', App\Http\Controllers\AdminBookingController::class);
    Route::get('archive/bookings', 'App\Http\Controllers\AdminBookingController@archive')->name('bookings.archive');
    Route::post('approved/bookings', 'App\Http\Controllers\AdminBookingController@approved');
    Route::resource('booking-status', App\Http\Controllers\AdminStatusController::class);
    Route::resource('booking-location', App\Http\Controllers\AdminLocationController::class);
    Route::resource('services', App\Http\Controllers\AdminServiceController::class);
    Route::resource('service-categories', App\Http\Controllers\AdminServiceCategory::class);
    Route::get('archive/service-categories', 'App\Http\Controllers\AdminServiceCategory@archive')->name('service-categories.archive');
    Route::get('archive/services', 'App\Http\Controllers\AdminServiceController@archive')->name('services.archive');
    Route::get('layout', 'App\Http\Controllers\AdminServiceController@layout');
    Route::view('/agenda', 'admin.bookings.agenda')->name('bookings.agenda');

    //MailChimp Routes
    Route::get('mailchimp', 'App\Http\Controllers\MailChimpController@index')->name('mailchimp.form');
    Route::get('mailchimp/contact', 'App\Http\Controllers\MailChimpController@contact')->name('mailchimp.contact');
    Route::post('password/{id}', 'App\Http\Controllers\AdminUsersController@updatePassword');

    //Mailables
    Route::get('/mail/test', function () {
        return view('emails.newBooking');
    });
});
