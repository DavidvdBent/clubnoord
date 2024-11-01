<?php

use App\Models\Family;
use App\Models\Member;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\BoekJaarController;
use App\Http\Controllers\BookYearController;
use App\Http\Controllers\TypeMemberController;
use App\Http\Controllers\ContributieController;
use App\Http\Controllers\ContributionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//user
Route::get('/login', [SessionController::class, 'create'])->middleware('guest')->name('login');;
Route::post('session/store', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    // Member
    Route::get('/members', [MemberController::class, 'index']);
    Route::get('/member/create', [MemberController::class, 'create']);
    // update path naar edit
    Route::get('/member/update/{member:id}', [MemberController::class, 'edit']);
    Route::get('/member/{member:id}', [MemberController::class, 'show']);
    Route::post('/member/store', [MemberController::class, 'store']);
    Route::delete('/member/{member:id}',[MemberController::class,'destroy']);
    Route::patch('/member/update/{member:id}',[MemberController::class,'update']);
    
    // Family
    Route::get('/', [FamilyController::class, 'index'])->name('home');
    Route::get('/family/{family:id}', [FamilyController::class, 'show']);
    // update path naar edit
    Route::get('/family/update/{family:id}', [FamilyController::class, 'edit']);
    Route::patch('/family/update/{family:id}',[FamilyController::class,'update']);
    Route::delete('/family/{family:id}',[FamilyController::class,'destroy']);
    
    //TypeMember
    Route::get('/typemembers', [TypeMemberController::class, 'index'] );
    Route::delete('/typemember/{typemember:id}',[TypeMemberController::class,'destroy']);
    Route::get('/typemember/edit/{typemember:id}', [TypeMemberController::class, 'edit']);
    Route::patch('/typemember/update/{typemember:id}', [TypeMemberController::class, 'update']);
    Route::get('/typemember/create', [TypeMemberController::class, 'create']);
    Route::post('/typemember/store', [TypeMemberController::class, 'store']);
    
    //Contributie
    Route::get('/contributions', [ContributionController::class, 'index']);
    Route::get('/contributions/edit/{contribution:id}', [ContributionController::class, 'edit']);
    Route::patch('/contributions/update/{contribution:id}', [ContributionController::class, 'update']);
    
    //Boekjaar
    Route::get('/bookyear/edit/{bookyear:id}', [BookYearController::class, 'edit']);
    Route::patch('/bookyear/update/{bookyear:id}', [BookYearController::class, 'update']);    
});    
