<?php

use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
//Route::get('/system/{page}', [App\Http\Controllers\SystemPageController::class, 'index'])->name('system');
//Route::view('/pages/slick', 'pages.slick');
//Route::view('/pages/datatables', 'pages.datatables');
//Route::view('/pages/blank', 'pages.blank');
//Route::view('/register/client', 'auth.registerClient');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/mail", function(){
    return View::make("emails.prospect");
});


// General settings
Auth::routes(['verify'=> true]);

//Public Routes for member information
Route::get('/', 'App\Http\Controllers\DirectionController@getDirection')->name('direction');
Route::get('vCard/{id}', 'App\Http\Controllers\CardController@vCard')->name('members.vCard');
Route::post('save/{id}', 'App\Http\Controllers\CardController@saveInfo')->name('members.saveInfo');
Route::get('QRcode/{id}', 'App\Http\Controllers\QRcode\QRcodeController@QRcode')->name('members.QRcode');
Route::post('generate/cards', 'App\Http\Controllers\Dashboard\CardListGenerator@generateListUrl')->name('generate.cards');
Route::get('members/print', 'App\Http\Controllers\CardController@print')->name('print');

// Backend Routes
Route::group(['prefix'=>'admin', 'middleware'=>[ 'auth', 'verified']], function(){
    //Routes for generating SWAP CARD information
    Route::get('card-credentials', 'App\Http\Controllers\Cards\CardCredentialsController@cardCredentialsList')->name('card-credentials');
    Route::get('card-credentials-sheet-generator', 'App\Http\Controllers\Cards\CardCredentialsController@cardCredentialsSheetGenerator')->name('card-credentials-sheet-generator');
    Route::patch('card-credentials-update-card', 'App\Http\Controllers\Cards\CardCredentialsController@updateCard')->name('card-credentials-update');


    //Routes for CRUD members
    Route::resource('members', App\Http\Controllers\AdminMembersController::class);
    Route::resource('orders', App\Http\Controllers\AdminOrderController::class);
    Route::get('archive/members', 'App\Http\Controllers\AdminMembersController@archive')->name('members.archive');
    Route::get('member/QRcode/show/{id}', 'App\Http\Controllers\QRcode\QRcodeController@fancyQRcode')->name('show.QRcode');

    //Routes for generating the URLS
    Route::POST('generate/member', 'App\Http\Controllers\AdminMembersController@generate')->name('members.generate');
    Route::POST('search/member', 'App\Http\Controllers\AdminMembersController@searchMember')->name('members.search');
    Route::get('generate/member/credentials', 'App\Http\Controllers\AdminMembersController@generateCredentialMemberList')->name('members.credentials');

    //Routes for CRUD Teams
    Route::resource('teams', App\Http\Controllers\AdminTeamsController::class);
    Route::get('archive/teams', [App\Http\Controllers\AdminTeamsController::class, 'archive'])->name('teams.archive');
    Route::get('team/users/{team}', [App\Http\Controllers\AdminTeamsController::class, 'getUsers'])->name('team.users');
    Route::get('team/contact/{team}', [App\Http\Controllers\AdminTeamsController::class, 'getContacts'])->name('team.contacts');


    //Routes for listing the QRcodes
    Route::post('QRcodeStatus', 'App\Http\Controllers\QRcodeController@QRcodeStatus')->name('QRcodeStatus');
    Route::get('QRcodeList', 'App\Http\Controllers\QRcodeController@QRcodeList')->name('QRcodeList');

    //General Routes
    Route::get('lock', 'App\Http\Controllers\Dashboard\LockController@lock')->name('lock');
    Route::get('unlock', 'App\Http\Controllers\Dashboard\LockController@unlock')->name('unlock');

    //Routes for generating sheets
    Route::get('sheet-QRcode', 'App\Http\Controllers\Dashboard\SheetGenerator@sheetQRcodeGenerator')->name('sheet.QRcode');
    Route::get('sheet', 'App\Http\Controllers\Dashboard\SheetGenerator@sheetGenerator')->name('sheetGenerator');

    //Page Routes
    Route::get('/', [App\Http\Controllers\AdminHomeController::class, 'index'])->name('admin.home');

    //User Routes
    Route::resource('users', App\Http\Controllers\AdminUsersController::class);
    Route::PATCH('user/update/team/{user}', [App\Http\Controllers\AdminUsersController::class, 'updateTeam']);
    Route::get('user/delete/{id}', 'App\Http\Controllers\AdminUsersController@delete')->name('users.delete');
    Route::post('user/search', 'App\Http\Controllers\AdminUsersController@searchUser')->name('users.search');
    Route::get('archive/users', 'App\Http\Controllers\AdminUsersController@archive')->name('users.archive');
    Route::resource('contacts', App\Http\Controllers\AdminContactsController::class);
    Route::get('contact/client/{user}', 'App\Http\Controllers\AdminContactsController@indexClients')->name('contacts.index.client');
    Route::get('archive/contacts', 'App\Http\Controllers\AdminContactsController@archive')->name('contact.archive');
    Route::get('archive/contacts/client', 'App\Http\Controllers\AdminContactsController@archiveClients')->name('contact.archive-clients');
    Route::get('print/scans', 'App\Http\Controllers\CardController@printScans')->name('print.scans');
    Route::get('print/scans/client', 'App\Http\Controllers\CardController@printScansClient')->name('print.scans.client');
    Route::post('password/{id}', 'App\Http\Controllers\AdminUsersController@updatePassword');




//    Route::resource('roles', App\Http\Controllers\AdminRolesController::class);
//    Route::resource('billing', App\Http\Controllers\AdminBillingController::class);

    //Shop Routes
//    Route::resource('products', App\Http\Controllers\AdminProductsController::class);
//    Route::resource('promos', App\Http\Controllers\AdminPromoController::class);
//    Route::resource('location', App\Http\Controllers\AdminLocationController::class);
//    Route::get('archive/location', 'App\Http\Controllers\AdminLocationController@archive')->name('locations.archive');
//    Route::get('archive/promos', 'App\Http\Controllers\AdminPromoController@archive')->name('promos.archive');

    //FAQ Routes
//    Route::resource('faqs', App\Http\Controllers\AdminFaqController::class);
//    Route::get('archive/faqs', 'App\Http\Controllers\AdminFaqController@archive')->name('faqs.archive');
//    Route::get('faqs/delete/{id}', 'App\Http\Controllers\AdminFaqController@destroy')->name('faqs.delete');

    //Submissions Routes
//    Route::get('/export/submissons', [App\Http\Controllers\AdminSubmissionController::class, 'export'])->name('submissions.export');
//    Route::get('archive/submissions', 'App\Http\Controllers\AdminSubmissionController@archive')->name('submission.archive');



    //    Route::resource('credentials', App\Http\Controllers\AdminCompanyCredentialsController::class);
//    Route::resource('homePage', App\Http\Controllers\HomePageController::class);
//    Route::resource('disclaimer', App\Http\Controllers\DisclaimerController::class);
//    Route::resource('privacy', App\Http\Controllers\PrivacyController::class);
//    Route::resource('cookie', App\Http\Controllers\CookieController::class);
//    Route::resource('content', App\Http\Controllers\AdminContentController::class);

    // BLOG Routes
//    Route::get('gallery', 'App\Http\Controllers\AdminPostController@gallery')->name('post.gallery');
//    Route::resource('posts', App\Http\Controllers\AdminPostController::class);
//    Route::resource('postcategories', App\Http\Controllers\AdminPostCategoryController::class);
//    Route::get('archive/post-categories', 'App\Http\Controllers\AdminPostCategoryController@archive')->name('postcategories.archive');
//    Route::resource('comments', App\Http\Controllers\AdminCommentController::class);
//    Route::post('comments/reply', 'App\Http\Controllers\AdminCommentController@storeReply');
//    Route::get('archive/posts', 'App\Http\Controllers\AdminPostController@archive')->name('post.archive');
//    Route::get('frontend', 'App\Http\Controllers\AdminPostController@frontend')->name('post.frontend');

    //General Routes
//    Route::get('components', 'App\Http\Controllers\ComponentController@index')->name('components.index');
//    Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

    //Clients Routes
//    Route::resource('clients', App\Http\Controllers\AdminClientController::class);
//    Route::get('archive/clients', 'App\Http\Controllers\AdminClientController@archive')->name('clients.archive');
//    Route::resource('addresses', App\Http\Controllers\AdminAddressesController::class);
//    Route::resource('loyals', App\Http\Controllers\AdminLoyalController::class);
//    Route::get('archive/loyals', 'App\Http\Controllers\AdminLoyalController@archive')->name('loyals.archive');
//    Route::resource('sources', App\Http\Controllers\AdminSourceController::class);
//    Route::get('archive/sources', 'App\Http\Controllers\AdminSourceController@archive')->name('sources.archive');

    //Testimonial Routes
//    Route::resource('testimonials', App\Http\Controllers\TestimonialController::class);
//    Route::get('archive/testimonials', 'App\Http\Controllers\TestimonialController@archive')->name('testimonials.archive');
//    Route::get('testimonial/form', 'App\Http\Controllers\TestimonialController@form')->name('testimonials.form');

    //Booking Routes
//    Route::resource('bookings', App\Http\Controllers\AdminBookingController::class);
//    Route::get('archive/bookings', 'App\Http\Controllers\AdminBookingController@archive')->name('bookings.archive');
//    Route::post('approved/bookings', 'App\Http\Controllers\AdminBookingController@approved');
//    Route::resource('booking-status', App\Http\Controllers\AdminStatusController::class);
//    Route::resource('booking-location', App\Http\Controllers\AdminLocationController::class);
//    Route::resource('services', App\Http\Controllers\AdminServiceController::class);
//    Route::resource('service-categories', App\Http\Controllers\AdminServiceCategory::class);
//    Route::get('archive/service-categories', 'App\Http\Controllers\AdminServiceCategory@archive')->name('service-categories.archive');
//    Route::get('archive/services', 'App\Http\Controllers\AdminServiceController@archive')->name('services.archive');
//    Route::get('layout', 'App\Http\Controllers\AdminServiceController@layout');
//    Route::view('/agenda', 'admin.bookings.agenda')->name('bookings.agenda');

    //MailChimp Routes
//    Route::get('mailchimp', 'App\Http\Controllers\MailChimpController@index')->name('mailchimp.form');
//    Route::get('mailchimp/contact', 'App\Http\Controllers\MailChimpController@contact')->name('mailchimp.contact');
//
    //Mailables
//    Route::get('/mail/test', function () {
//        return view('emails.newBooking');
//    });
});
