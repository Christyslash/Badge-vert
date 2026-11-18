<?php

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\UsagerController;
use App\Http\Controllers\AccompagnateurController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController as AuthPasswordResetLinkController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\VisiteController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

/*Route::get('/admin', function () {
    if (auth()->check()) {
        return redirect()->route('admin.register');
    }
    return redirect()->route('login');
});*/

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('configuration')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Mot de passe oublié
Route::get('/forgot-password', [AuthPasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [AuthPasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

/*Route::get('/password-reset-sent', function () {
    return view('auth.passwords.password-reset-sent');
})->name('password.reset.sent');

Route::get('/password-reset-success', function () {
    return view('auth.passwords.password-reset-success');
})->name('password.reset.success');*/

    // Confirmation du mot de passe

Route::get('/confirm-password', [AuthController::class, 'showConfirmPasswordForm'])
    ->middleware('auth')
    ->name('password.confirm');

Route::post('/confirm-password', [AuthController::class, 'confirmPassword'])
    ->middleware('auth')
    ->name('password.confirm.attempt');

    //Modifier le mot de passe
/*Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])
    ->middleware('auth')
    ->name('password.change');

Route::post('/change-password', [AuthController::class, 'changePassword'])
    ->middleware('auth')
    ->name('password.change.attempt');*/

Route::get('/profile', [ProfileController::class, 'edit'])
    ->middleware('auth')
    ->name('profile.edit');

Route::patch('/profile', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->middleware('auth')
    ->name('profile.destroy');

Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])
    ->middleware('auth')
    ->name('password.update');

    // Réinitialisation
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store'); // ✅ BON

// Profils et gestion des utilisateurs (admin only)
Route::get('/admin/users', [ProfileController::class, 'index'])
    ->middleware(['auth', 'is_admin'])
    ->name('admin.users.index');

Route::get('/admin/users/{user}/password', [ProfileController::class, 'editUserPassword'])
    ->middleware(['auth', 'is_admin'])
    ->name('admin.user.password.edit');

Route::patch('/admin/users/{user}/password', [ProfileController::class, 'updateUserPassword'])
    ->middleware(['auth', 'is_admin'])
    ->name('admin.user.password.update');




    // Inscription
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');

    //Mot de passe oublié
    Route::get('/test-email', function () {
    Mail::raw('Test depuis Laravel', function ($m) {
        $m->to('maildestinataire@sab.bj')
          ->subject('Test Reset');
    });

    return 'Email envoyé ! Vérifie ta boîte.';
});



Route::prefix('auth')->group(function(){
    // Connexion
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});
// Déconnexion
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*Route::get('/', function () {
    return view('welcome');
})->middleware('auth');*/

Route::get('/configuration', function () {
    return view("configuration.index", ['user' => auth()->user()]);//besoin de protéger cette route pour que l'admin soit connecté

})->name('configuration');

Route::get('/operation', function () {
    return view("operation.index");
})->name('operation');

Route::prefix('service')->group(function(){
    Route::get('index', [ServiceController::class, 'index'])->name('service.index');
    Route::get('create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('store', [ServiceController::class, 'store'])->name('service.store');
    Route::get('edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::post('delete', [ServiceController::class, 'remove'])->name('service.delete');
});

Route::prefix('societe')->group(function(){
    Route::get('index', [SocieteController::class, 'index'])->name('societe.index');
    Route::get('create', [SocieteController::class, 'create'])->name('societe.create');
    Route::post('store', [SocieteController::class, 'store'])->name('societe.store');
    Route::get('edit/{id}', [SocieteController::class, 'edit'])->name('societe.edit');
    Route::post('update/{id}', [SocieteController::class, 'update'])->name('societe.update');
    Route::post('delete', [SocieteController::class, 'remove'])->name('societe.delete');
});

Route::prefix('usager')->group(function(){
    Route::get('index', [UsagerController::class, 'index'])->name('usager.index');
    Route::get('create', [UsagerController::class, 'create'])->name('usager.create');
    Route::post('store', [UsagerController::class, 'store'])->name('usager.store');
    Route::get('edit/{id}', [UsagerController::class, 'edit'])->name('usager.edit');
    Route::post('update/{id}', [UsagerController::class, 'update'])->name('usager.update');
    Route::post('delete', [UsagerController::class, 'remove'])->name('usager.delete');
});

Route::prefix('accompagnateur')->group(function(){
    Route::get('index', [AccompagnateurController::class, 'index'])->name('accompagnateur.index');
    Route::get('create', [AccompagnateurController::class, 'create'])->name('accompagnateur.create');
    Route::post('store', [AccompagnateurController::class, 'store'])->name('accompagnateur.store');
    Route::get('edit/{id}', [AccompagnateurController::class, 'edit'])->name('accompagnateur.edit');
    Route::post('update/{id}', [AccompagnateurController::class, 'update'])->name('accompagnateur.update');
    Route::post('delete', [AccompagnateurController::class, 'remove'])->name('accompagnateur.delete');
});

Route::prefix('zone')->group(function(){
    Route::get('index', [ZoneController::class, 'index'])->name('zone.index');
    Route::get('create', [ZoneController::class, 'create'])->name('zone.create');
    Route::post('store', [ZoneController::class, 'store'])->name('zone.store');
    Route::get('edit/{id}', [ZoneController::class, 'edit'])->name('zone.edit');
    Route::post('update/{id}',[ZoneController::class, 'update'])->name('zone.update');
    Route::post('delete', [ZoneController::class, 'remove'])->name('zone.delete');
});

Route::prefix('visite')->group(function(){
    Route::get('index', [VisiteController::class, 'index'])->name('visite.index');
    Route::get('create', [VisiteController::class, 'create'])->name('visite.create');
    Route::post('store', [VisiteController::class, 'store'])->name('visite.store');
    Route::get('edit/{id}', [VisiteController::class, 'edit'])->name('visite.edit');
    Route::get('show', [VisiteController::class, 'show'])->name('visite.show');
    Route::post('update/{id}', [VisiteController::class, 'update'])->name('visite.update');
    Route::post('delete', [VisiteController::class, 'remove'])->name('visite.delete');
    Route::get('point/{id}', [VisiteController::class, 'point'])->name('visite.point');
});

Route::prefix('document')->group(function(){
    Route::get('index', [DocumentController::class, 'index'])->name('document.index');
    Route::get('list', [DocumentController::class, 'list'])->name('document.list');
    Route::get('create', [DocumentController::class, 'create'])->name('document.create');
    Route::get('create1', [DocumentController::class, 'create1'])->name('document.create1');
    Route::post('store', [DocumentController::class, 'store'])->name('document.store');
    Route::post('store1', [DocumentController::class, 'store1'])->name('document.store1');
    Route::get('edit/{id}', [DocumentController::class, 'edit'])->name('document.edit');
    Route::post('update/{id}', [DocumentController::class, 'update'])->name('document.update');
    Route::post('delete', [DocumentController::class, 'remove'])->name('document.delete');
});

Route::prefix('facture')->group(function(){
    Route::get('index', [FactureController::class, 'index'])->name('facture.index');
    Route::get('create', [FactureController::class, 'create'])->name('facture.create');
    Route::post('store', [FactureController::class, 'store'])->name('facture.store');
    Route::get('edit/{id}', [FactureController::class, 'edit'])->name('facture.edit');
    Route::get('list/{id}', [FactureController::class, 'list'])->name('facture.list');
    Route::get('point/{id}', [FactureController::class, 'point'])->name('facture.point');
    Route::post('storePoint/{id}', [FactureController::class, 'storePoint'])->name('facture.storePoint');
    Route::post('update/{id}', [FactureController::class, 'update'])->name('facture.update');
    Route::post('delete', [FactureController::class, 'remove'])->name('facture.delete');
});

Route::prefix('badge')->group(function(){
    Route::get('index', [BadgeController::class, 'index'])->name('badge.index');
    Route::get('list/{id}', [BadgeController::class, 'list'])->name('badge.list');
    Route::get('create', [BadgeController::class, 'create'])->name('badge.create');
    Route::post('store', [BadgeController::class, 'store'])->name('badge.store');
    Route::get('edit/{id}', [BadgeController::class, 'edit'])->name('badge.edit');
    Route::get('/badge/scan/{id}', [BadgeController::class, 'scan'])->name('badge.scan');
    //Route::post('update/{id}', [FactureController::class, 'update'])->name('badge.update');
    Route::post('delete', [BadgeController::class, 'delete'])->name('badge.delete');
});

