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

Route::get("/mail", function(){
    return View::make("emails.prospect");
});


// General settings
Auth::routes(['verify'=> true]);

//Public Routes for member information
Route::get('/', 'App\Http\Controllers\DirectionController@getDirection')->name('direction');
Route::get('vCard/{id}', 'App\Http\Controllers\CardController@vCard')->name('members.vCard');
Route::post('save/{id}', 'App\Http\Controllers\CardController@saveInfo')->name('members.saveInfo');
Route::get('QRcode/{id}', 'App\Http\Controllers\DirectionController@getDirectionFromId');
Route::get('QRcodeMember/{id}', 'App\Http\Controllers\QRcode\QRcodeController@QRcode')->name('members.QRcode');
Route::post('generate/cards', 'App\Http\Controllers\Dashboard\CardListGenerator@generateListUrl')->name('generate.cards');
Route::post('generate/bulk/cards', 'App\Http\Controllers\Dashboard\CardListGenerator@bulkSelectListUrl')->name('bulk.cards');
Route::get('settings', 'App\Http\Controllers\Dashboard\SettingsController@index')->name('settings');
Route::get('members/print', 'App\Http\Controllers\CardController@print')->name('print');

// Backend Routes
Route::group(['prefix'=>'admin', 'middleware'=>[ 'auth', 'verified']], function(){
    //Routes for generating SWAP CARD information
    Route::get('card-credentials', 'App\Http\Controllers\Cards\CardCredentialsController@cardCredentialsList')->name('card-credentials');
    Route::get('card-credentials/detail/{team}', 'App\Http\Controllers\Cards\CardCredentialsController@cardCredentialsListDetail')->name('card-credentials-details');
    Route::get('card-credentials-sheet-generator/{id}', 'App\Http\Controllers\Cards\CardCredentialsController@cardCredentialsSheetGenerator')->name('card-credentials-sheet-generator');
    Route::patch('card-credentials-update-card', 'App\Http\Controllers\Cards\CardCredentialsController@updateCard')->name('card-credentials-update');


    //Routes for CRUD members
    Route::resource('members', App\Http\Controllers\AdminMembersController::class);
    Route::get('archive/members', 'App\Http\Controllers\AdminMembersController@archive')->name('members.archive');
    Route::get('member/QRcode/show/{id}', 'App\Http\Controllers\QRcode\QRcodeController@fancyQRcode')->name('show.QRcode');

    //Routes for generating the URLS
    Route::POST('generate/member', 'App\Http\Controllers\AdminMembersController@generate')->name('members.generate');
    Route::POST('search/member', 'App\Http\Controllers\AdminMembersController@searchMember')->name('members.search');
    Route::get('generate/member/credentials', 'App\Http\Controllers\AdminMembersController@generateCredentialMemberList')->name('members.credentials');

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
    Route::resource('users', App\Http\Controllers\AdminUsersController::class);
    Route::PATCH('user/update/team/{user}', [App\Http\Controllers\AdminUsersController::class, 'updateTeam']);
    Route::get('user/delete/{id}', 'App\Http\Controllers\AdminUsersController@delete')->name('users.delete');
    Route::post('user/search', 'App\Http\Controllers\AdminUsersController@searchUser')->name('users.search');
    Route::get('archive/users', 'App\Http\Controllers\AdminUsersController@archive')->name('users.archive');

    Route::resource('contacts', App\Http\Controllers\AdminContactsController::class);
    Route::get('list', 'App\Http\Controllers\AdminUsersController@contactsList')->name('contacts.list');
    Route::get('list/detail/{contact}', 'App\Http\Controllers\AdminUsersController@contactDetail')->name('contact.detail');


    //This route will display all Contacts from given USER ID
    Route::get('contact/client/{user}', 'App\Http\Controllers\AdminContactsController@indexClient')->name('contacts.index.client');
    Route::get('archive/contacts', 'App\Http\Controllers\AdminContactsController@archive')->name('contact.archive');
    //This route will display all CONTACTS from AUTH user ID
    Route::get('archive/contacts/client', 'App\Http\Controllers\AdminContactsController@archiveClients')->name('contact.archive-clients');
    Route::get('archive/team/contacts', 'App\Http\Controllers\AdminContactsController@archiveTeamContacts')->name('contact.archive-teams-contacts');
    Route::PATCH('update/contact/{contact}', 'App\Http\Controllers\AdminContactsController@updateContact')->name('contact.update');
    Route::PATCH('create/note/contact/{contact}', 'App\Http\Controllers\AdminContactsController@createNoteContact')->name('contact.note.create');
    Route::PATCH('update/note/contact/{contact}', 'App\Http\Controllers\AdminContactsController@updateNoteContact')->name('contact.note.update');
    Route::POST('delete/note/contact/{contact}', 'App\Http\Controllers\AdminContactsController@deleteNoteContact')->name('contact.note.delete');
    Route::POST('create/event/contact/{contact}', 'App\Http\Controllers\AdminContactsController@createEventContact')->name('contact.event.create');


    Route::get('print/scans', 'App\Http\Controllers\CardController@printScans')->name('print.scans');
    Route::get('print/list/{id}', 'App\Http\Controllers\CardController@print')->name('print.list');
    Route::get('print/scans/client', 'App\Http\Controllers\CardController@printScansClient')->name('print.scans.client');
    Route::get('print/scans/team', 'App\Http\Controllers\CardController@printScansTeam')->name('print.scans.team');
    Route::post('password/{id}', 'App\Http\Controllers\AdminUsersController@updatePassword');

});
