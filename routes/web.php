<?php

use App\Http\Controllers\Admin\AttributionController;
use App\Http\Controllers\Admin\BienController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaiementController;

use App\Http\Controllers\Admin\ParametreControler;
use App\Http\Controllers\Admin\TemoignageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AdminPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\AttributionController as ClientAttributionController;
use App\Http\Controllers\Client\ContratController;

use App\Http\Controllers\Client\DashboardController as ClientDashboard;

use App\Http\Controllers\Client\LocationController;
use App\Http\Controllers\Client\PaiementController as ClientPaiementController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Proprietaire\BienController as ProprietaireBienController;
use App\Http\Controllers\Proprietaire\DashboardController as ProprietaireDashboardController;

use App\Http\Controllers\Proprietaire\LocataireController;
use App\Http\Controllers\Proprietaire\PaiementController as ProprietairePaiementController;
use App\Http\Controllers\Proprietaire\RapportController;
use App\Http\Controllers\ViewController;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Route;




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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/accueil', function () {
    return view('accueil');
})->name('accueil');

Route::get('/apropos', [ViewController::class, 'apropos']);

Route::get('/catalogue', [ViewController::class, 'catalogue'])->name('catalogue');

Route::get('/contact', [ViewController::class, 'contact']);


Route::patch('/biens/{bien}/louer', [BienController::class, 'louer'])->name('biens.louer');

// Page publique de contact
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [App\Http\Controllers\Admin\ContactController::class, 'store'])->name('contact.store');


// Login admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Changement mot de passe obligatoire
Route::get('/admin/change-password', function () {
    return view('admin.change-password');
})->name('admin.password.change');

// Réinitialisation mdp admin
Route::middleware('auth')->group(function () {
    Route::get('/admin/change-password', [AdminPasswordController::class, 'showForm'])
        ->name('admin.password.change');
    Route::post('/admin/change-password', [AdminPasswordController::class, 'update'])
        ->name('admin.password.update');
});


Route::middleware(['auth'])->group(function() {
    Route::get('/password/change', [PasswordController::class, 'showChangeForm'])
        ->name('password.change.form');

    Route::post('/password/change', [PasswordController::class, 'update'])
        ->name('password.change.update');
});


// Authentification proprio
Route::middleware(['auth', 'check.password'])->group(function() {
    Route::get('/dashboard', [ProprietaireDashboardController::class, 'index']);
   
});
// Routes propriétaires
Route::get('/proprietaire/login', [LoginController::class, 'showLoginForm'])->name('proprietaire.login');
Route::post('/proprietaire/login', [LoginController::class, 'login'])->name('proprietaire.login.submit');
Route::post('/proprietaire/logout', [LoginController::class, 'logout'])->name('proprietaire.logout');


// Route de connexion client
Route::get('client/login', [LoginController::class, 'showClientLoginForm'])->name('client.login');
Route::post('client/login', [LoginController::class, 'clientLogin'])->name('client.login.submit');
Route::post('client/logout', [LoginController::class, 'clientLogout'])->name('client.logout');


Route::middleware(['auth'])->group(function () {

    // ADMIN
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('dashboard', DashboardController::class)->only('index');
        Route::resource('biens', BienController::class);
        Route::resource('attributions', AttributionController::class)->only(['index','create','store']);
        Route::patch('attributions/{attribution}/terminer', [AttributionController::class, 'terminer'])->name('attributions.terminer');
        Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');

        // Gestion témoignages
        Route::resource('temoignages', TemoignageController::class)->except(['create','store','show']);

        Route::resource('users', UserController::class)->only(['index','create','store']);
        Route::resource('paiements', PaiementController::class)->only(['index','create','store']);
        Route::get('parametre', [ParametreControler::class, 'index'])->name('parametre');

        // Demandes de location
        Route::get('demandes', [App\Http\Controllers\Admin\DemandeController::class, 'index'])->name('demandes.index');
        Route::post('demandes/{demande}/approuver', [App\Http\Controllers\Admin\DemandeController::class, 'approuver'])->name('demandes.approuver');

    });


    // PROPRIÉTAIRE 
    Route::middleware('role:proprietaire')->prefix('proprietaire')->name('proprietaire.')->group(function () {
        Route::get('/dashboard', [ProprietaireDashboardController::class, 'index'])->name('dashboard');
        Route::get('/biens', [ProprietaireBienController::class, 'index'])->name('biens');
        Route::get('/locataires', [ProprietaireDashboardController::class, 'mesLocataires'])->name('locataires');
        Route::get('/paiements', [ProprietaireDashboardController::class, 'historiqueLoyers'])->name('paiements');    
        Route::get('rapports', [RapportController::class, 'index'])->name('rapports');
        
    });


    // CLIENT
    Route::middleware('role:client')->prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', [ClientDashboard::class, 'index'])->name('dashboard');
        Route::get('/contrats', [ContratController::class, 'index'])->name('contrats');
        Route::get('/paiements', [ClientPaiementController::class, 'index'])->name('paiements');

        // Location via modal
        Route::post('/biens/{bien}/louer', [LocationController::class, 'store'])
             ->name('biens.louer');

    });

    // Paiements
    Route::get('/paiements', [ClientPaiementController::class, 'index'])->name('paiements');


    // TEMOIGNAGES (Client ou Propriétaire) 
    Route::get('/temoignages/create', [TemoignageController::class, 'create'])->name('temoignages.create');
    Route::post('/temoignages', [TemoignageController::class, 'store'])->name('temoignages.store');
});



Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');


/* Notifications */
Route::middleware('auth')->group(function () {
    Route::post('/notifications/mark-all-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.markAllRead');

    Route::get('/notifications/{notification}/open', function (DatabaseNotification $notification) {
        abort_unless($notification->notifiable_id === auth()->id(), 403);

        // Marque comme lue
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        $data = $notification->data ?? [];
        $id   = $data['attribution_id'] ?? null;
        $role = auth()->user()->role ?? 'client';

        // Redirection en fonction du rôle
        if ($id) {
            if ($role === 'admin') {
                return redirect(url('/admin/attributions/' . $id));
            } elseif ($role === 'proprietaire') {
                return redirect(url('/proprietaire/locataires'));
            } else {
                return redirect(url('/client/contrats'));
            }
        }

        return back();
    })->name('notifications.open');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/client/contrats', [App\Http\Controllers\Client\DashboardController::class, 'mesContrats'])->name('client.contrats');
    Route::get('/proprietaire/dashboard', [App\Http\Controllers\Proprietaire\DashboardController::class, 'index'])->name('proprietaire.dashboard');
    Route::get('/admin/attributions', [App\Http\Controllers\Admin\AttributionController::class, 'index'])->name('admin.attributions.index');
});




require __DIR__.'/auth.php';
