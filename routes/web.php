<?php

use App\Models\Member;
use App\Models\User;
use App\Models\Contact;

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

Route::get("/mail", function(){
    return View::make("emails.prospect");
});


// General settings
Auth::routes(['verify'=> true]);

//Public Routes for member information
Route::get('/', 'App\Http\Controllers\DirectionController@getDirection')->name('direction');
Route::get('/test/{member}', 'App\Http\Controllers\DirectionController@getTestProfile')->name('direction.test');
Route::get('vCard/{id}', 'App\Http\Controllers\CardController@vCard')->name('members.vCard');
Route::get('vCard/contact/{id}', 'App\Http\Controllers\CardController@vCardContact')->name('contact.vCard');
Route::post('save/{id}', 'App\Http\Controllers\CardController@saveInfo')->name('members.saveInfo');
Route::get('QRcode/{id}', 'App\Http\Controllers\DirectionController@getDirectionFromId');
Route::get('QRcodeMember/{id}', 'App\Http\Controllers\QRcode\QRcodeController@QRcode')->name('members.QRcode');

// Backend Routes
Route::group(['prefix'=>'admin', 'middleware'=>[ 'auth', 'verified']], function(){
    //Routes for generating SWAP CARD information
    Route::get('card-credentials', 'App\Http\Controllers\Cards\CardCredentialsController@cardCredentialsList')->name('card-credentials');
    Route::get('card-credentials/detail/{team}', 'App\Http\Controllers\Cards\CardCredentialsController@cardCredentialsListDetail')->name('card-credentials-details');
    Route::get('card-credentials-sheet-generator/{id}', 'App\Http\Controllers\Cards\CardCredentialsController@cardCredentialsSheetGenerator')->name('card-credentials-sheet-generator');
    Route::patch('card-credentials-update-card', 'App\Http\Controllers\Cards\CardCredentialsController@updateCard')->name('card-credentials-update');

    //Cropper upload
    Route::POST('image-cropper/upload','App\Http\Controllers\ImageCropperController@upload');

    //Routes for CRUD members
    Route::resource('members', App\Http\Controllers\AdminMembersController::class)->middleware('can:hasAccessCheckMember,member');
    Route::get('archive/members', 'App\Http\Controllers\AdminMembersController@archive')->name('members.archive');
    Route::get('member/QRcode/show/{card_id}', 'App\Http\Controllers\QRcode\QRcodeController@fancyQRcode')->name('show.QRcode');
    Route::get('member/share', 'App\Http\Controllers\AdminMembersController@share')->name('share');
    Route::patch('member/custom/{id}', 'App\Http\Controllers\AdminMembersController@customButton')->name('custom.button');

    Route::PATCH('update/contact/{contact}', "App\Http\Controllers\AdminContactsController@updateContact")->name("update.contact");
    Route::get('filters/events/details/{location}', 'App\Http\Controllers\AdminUsersController@eventDetail')->name('event.detail')->middleware('can:hasAccessCheckLocation,location');
    Route::get('filters/events','App\Http\Controllers\AdminUsersController@filterEvents')->name('filters.events');

    //Routes for generating the URLS
    Route::POST('generate/member', 'App\Http\Controllers\AdminMembersController@generate')->name('members.generate');
    Route::POST('search/member', 'App\Http\Controllers\AdminMembersController@searchMember')->name('members.search');
    Route::get('generate/member/credentials', 'App\Http\Controllers\AdminMembersController@generateCredentialMemberList')->name('members.credentials');
    Route::post('generate/cards', 'App\Http\Controllers\Dashboard\CardListGenerator@generateListUrl')->name('generate.cards');
    Route::post('generate/bulk/cards', 'App\Http\Controllers\Dashboard\CardListGenerator@bulkSelectListUrl')->name('bulk.cards');
    Route::get('bulk/delete/{team}', 'App\Http\Controllers\Dashboard\CardListGenerator@bulkDelete')->name('bulk.delete');
    Route::get('members/print', 'App\Http\Controllers\CardController@print')->name('print');
    Route::get('listurl/detail/{url}', 'App\Http\Controllers\Dashboard\CardListGenerator@getListurl')->name('listurl.detail');

    //Routes for CRUD teams
    Route::resource('teams', App\Http\Controllers\AdminTeamsController::class);
    Route::get('archive/teams', [App\Http\Controllers\AdminTeamsController::class, 'archive'])->name('teams.archive');
    Route::get('team/users/{team}', [App\Http\Controllers\AdminTeamsController::class, 'getUsers'])->name('team.users');
    Route::get('team/contact/{team}', [App\Http\Controllers\AdminTeamsController::class, 'getContacts'])->name('team.contacts');


    //Routes for listing the QRcodes
    Route::get('QRcodeList', 'App\Http\Controllers\QRcodeController@QRcodeList')->name('QRcodeList');

    //Page Routes
    Route::get('/', [App\Http\Controllers\AdminHomeController::class, 'index'])->name('admin.home');

    //User Routes
    Route::resource('users', App\Http\Controllers\AdminUsersController::class)->middleware('can:hasAccessCheckUser,user');
    Route::PATCH('user/update/team/{user}', [App\Http\Controllers\AdminUsersController::class, 'updateTeam']);
    Route::get('user/delete/{id}', 'App\Http\Controllers\AdminUsersController@delete')->name('users.delete');
    Route::post('user/keep/{user}', 'App\Http\Controllers\AdminUsersController@keep')->name('users.keep');
    Route::post('keep/bulk', 'App\Http\Controllers\AdminUsersController@keepBulk')->name('keep.bulk');
    Route::post('user/update/url/{user}', 'App\Http\Controllers\AdminUsersController@updateURL')->name('users.update.url');
    Route::post('user/search', 'App\Http\Controllers\AdminUsersController@searchUser')->name('users.search');
    Route::get('archive/users', 'App\Http\Controllers\AdminUsersController@archive')->name('users.archive');
    Route::get('import', 'App\Http\Controllers\AdminUsersController@importer')->name('importer');

    Route::resource('contacts', App\Http\Controllers\AdminContactsController::class);
    Route::get('list/detail/{contact}', 'App\Http\Controllers\AdminUsersController@contactDetail')
        ->middleware('can:hasAccessCheckContact,contact')
        ->name('contact.detail');

    Route::get('settings', 'App\Http\Controllers\Dashboard\SettingsController@index')->name('settings');
    Route::get('statistics', 'App\Http\Controllers\AdminStatisticsController@index')->name('stats');

    //This route will display all Contacts from given USER ID
    Route::get('contact/client/{user}', 'App\Http\Controllers\AdminContactsController@indexClient')->name('contacts.index.client');
    Route::get('archive/contacts', 'App\Http\Controllers\AdminContactsController@archive')->name('contact.archive');
    Route::get('archive/contact/detail/{contact}', 'App\Http\Controllers\AdminContactsController@archiveContact')->name('contact.archive.detail');
    //This route will display all CONTACTS from AUTH user ID
    Route::get('archive/contacts/client', 'App\Http\Controllers\AdminContactsController@archiveClients')->name('contact.archive-clients');
    Route::get('archive/team/contacts', 'App\Http\Controllers\AdminContactsController@archiveTeamContacts')->name('contact.archive-teams-contacts');
    //Route::PATCH('update/contact/{contact}', 'App\Http\Controllers\AdminContactsController@updateContact')->name('contact.update');
    Route::PATCH('create/note/contact/{contact}', 'App\Http\Controllers\AdminContactsController@createNoteContact')->name('contact.note.create');
    Route::PATCH('update/note/contact/{contact}', 'App\Http\Controllers\AdminContactsController@updateNoteContact')->name('contact.note.update');
    Route::PATCH('update/shortnote/contact/{contact}', 'App\Http\Controllers\AdminContactsController@updateShortNoteContact')->name('contact.short.note.update');
    Route::POST('delete/note/contact/{contact}', 'App\Http\Controllers\AdminContactsController@deleteNoteContact')->name('contact.note.delete');
    Route::POST('create/event/contact/{contact}', 'App\Http\Controllers\AdminContactsController@createEventContact')->name('contact.event.create');
    Route::PATCH('update/event/contact/{contact}', 'App\Http\Controllers\AdminContactsController@updateEventContact')->name('contact.event.update');
    Route::POST('delete/event/contact/{contact}', 'App\Http\Controllers\AdminContactsController@deleteEventContact')->name('contact.event.delete');

    Route::get('print/scans', 'App\Http\Controllers\CardController@printScans')->name('print.scans');
    Route::get('print/list/{id}', 'App\Http\Controllers\CardController@print')->name('print.list');
    Route::get('print/marketing', 'App\Http\Controllers\CardController@printMarketing')->name('print.marketing');
    Route::get('print/stats', 'App\Http\Controllers\CardController@printStats')->name('print.stats');
    Route::get('print/scans/client', 'App\Http\Controllers\CardController@printScansClient')->name('print.scans.client');
    Route::get('print/scans/team', 'App\Http\Controllers\CardController@printScansTeam')->name('print.scans.team');
    Route::post('password/{id}', 'App\Http\Controllers\AdminUsersController@updatePassword');
});
