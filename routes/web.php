<?php

use App\Http\Controllers\Admin\AdminMessagerieController;
use App\Http\Controllers\Admin\AttributionController;
use App\Http\Controllers\Admin\BienController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\DemandeController;
use App\Http\Controllers\Admin\DepenseController;
use App\Http\Controllers\Admin\PaiementController;
use App\Http\Controllers\Admin\ParametreControler;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProprietairePasswordController;
use App\Http\Controllers\Admin\TemoignageController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Auth\AdminAuthController;

use App\Http\Controllers\Auth\AdminPasswordController;
use App\Http\Controllers\Auth\ClientChangePasswordController;
use App\Http\Controllers\Auth\ClientForgotPasswordController;


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\AchatController;

use App\Http\Controllers\Client\AttributionController as ClientAttributionController;
use App\Http\Controllers\Client\ClientBienController;

use App\Http\Controllers\Client\ContratController;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;
use App\Http\Controllers\Client\LocationController;
use App\Http\Controllers\Client\PaiementController as ClientPaiementController;
use App\Http\Controllers\Client\SignalerController;
use App\Http\Controllers\ClientMessagerieController;
use App\Http\Controllers\ConversationController;

use App\Http\Controllers\MessageController;


// Reinitialisation de mot de passe propriétaire via l'admin car c'est lui qui communique au proprio concerné
use App\Http\Controllers\NewsletterController;

// Reinitialisation de mot de passe client sans implication de l'admin
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Proprietaire\BienController as ProprietaireBienController;
use App\Http\Controllers\Proprietaire\DashboardController as ProprietaireDashboardController;
use App\Http\Controllers\Proprietaire\DepenseController as ProprietaireDepenseController;
use App\Http\Controllers\Proprietaire\LocataireController;
use App\Http\Controllers\Proprietaire\MessagerieController;
use App\Http\Controllers\Proprietaire\PaiementController as ProprietairePaiementController;
use App\Http\Controllers\Proprietaire\RapportController;
use App\Http\Controllers\Proprietaire\VenteController;
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
    return view('accueil');
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

Route::get('/gestion-locative', [ViewController::class, 'gestion']);

Route::get('/faq', [ViewController::class, 'faq']);

Route::get('/actualite', [ViewController::class, 'actualite']);

Route::get('/nos-services', [ViewController::class, 'services']);

Route::get('/nos-partenaire', [ViewController::class, 'partenaire']);




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



Route::prefix('client')->name('client.')->group(function () {
    // Formulaire pour demander le mot de passe temporaire
    Route::get('password/forgot', [ClientForgotPasswordController::class, 'showForgotForm'])
        ->name('password.request');

    // Envoi du mot de passe temporaire (POST)
    Route::post('password/forgot', [ClientForgotPasswordController::class, 'sendTemporaryPassword'])
        ->name('password.send-temp');

    // Formulaire pour que l'utilisateur change son mot de passe après s'être connecté
    Route::get('password/change', [ClientChangePasswordController::class, 'showChangeForm'])
        ->name('password.change')
        ->middleware('auth'); // accéder seulement si connecté

    Route::post('password/change', [ClientChangePasswordController::class, 'updatePassword'])
        ->name('password.update')
        ->middleware('auth');
});



Route::get('/actualites', [PostController::class, 'index'])->name('blog.index');
Route::get('/actualites/recherche', [PostController::class, 'search'])->name('blog.search');
Route::get('/actualites/{slug}', [PostController::class, 'show'])->name('blog.show');



Route::middleware(['auth'])->group(function () {

    // ADMIN
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('dashboard', DashboardController::class)->only('index');
        Route::resource('biens', BienController::class);
        Route::resource('attributions', AttributionController::class)->only(['index','create','store']);
        Route::patch('attributions/{attribution}/terminer', [AttributionController::class, 'terminer'])->name('attributions.terminer');
        Route::patch('attributions/{attribution}/relancer', [AttributionController::class, 'relancer'])->name('attributions.relancer');
        Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
        Route::delete('/admin/attributions/{attribution}/annuler', [AttributionController::class, 'annuler'])->name('attributions.annuler');

        // Gestion témoignages
        Route::resource('temoignages', TemoignageController::class)->except(['create','store','show']);

        // Gestion des dépenses
        Route::get('/depenses', [DepenseController::class, 'index'])->name('depenses.index');
        Route::post('/depenses', [DepenseController::class, 'store'])->name('depenses.store');
        Route::put('/depenses/{depense}', [DepenseController::class, 'update'])->name('depenses.update');
        Route::delete('/depenses/{depense}', [DepenseController::class, 'destroy'])->name('depenses.destroy');


        // Réinitialiser le mot de passe des proprietaire par l'admin
        Route::post('/admin/proprietaires/reset-password', [ProprietairePasswordController::class, 'reset'])
        ->name('proprietaires.reset-password');
    

        Route::resource('users', UserController::class)->only(['index','create','store']);
        Route::resource('paiements', PaiementController::class)->only(['index','create','store']);
        Route::get('parametre', [ParametreControler::class, 'index'])->name('parametre');

        // Demandes de location
        Route::get('demandes', [DemandeController::class, 'index'])->name('demandes.index');
        Route::post('demandes/{demande}/approuver', [DemandeController::class, 'approuver'])->name('demandes.approuver');

        Route::get('/demandes', [DemandeController::class, 'index'])->name('demandes.index');
        Route::post('/demandes/{demande}/approuver', [DemandeController::class, 'approuver'])->name('demandes.approuver');
        Route::get('/demandes/historique', [DemandeController::class, 'historique'])->name('demandes.historique');

        Route::resource('posts', PostController::class);  
        
        // Réponse au signalements client
        Route::resource('signalements', \App\Http\Controllers\Admin\SignalementController::class)->except(['create', 'store', 'show']);

        // Mettre à jour statut de la transaction
        Route::put('ventes/{transaction}/update', [PaiementController::class, 'updateVente'])
        ->name('ventes.update');

        Route::get('/ventes/{id}/download-proof', [PaiementController::class, 'downloadProof'])->name('ventes.downloadProof');
    });

    // PROPRIÉTAIRE
    Route::middleware('role:proprietaire')->prefix('proprietaire')->name('proprietaire.')->group(function () {
        
        // Tableau de bord
        Route::get('/dashboard', [ProprietaireDashboardController::class, 'index'])->name('dashboard');
        
        // Biens du propriétaire
        Route::get('/biens', [ProprietaireBienController::class, 'index'])->name('biens');
        
        // Locataires
        Route::get('/locataires', [ProprietaireDashboardController::class, 'mesLocataires'])->name('locataires');

        // Génération du contrat en pdf
        Route::get('/locataires/{id}/contrat', [ProprietaireDashboardController::class, 'contratPDF'])->name('locataires.contrat');
        Route::get('/locataires/{id}/fiche', [ProprietaireDashboardController::class, 'fichePDF'])->name('locataires.fiche');
        
        // Paiements ou Reversements et loyers
        Route::get('/paiements', [ProprietaireDashboardController::class, 'historiqueLoyers'])->name('paiements');
        Route::get('/paiements/{id}/export/pdf', [ProprietaireDashboardController::class, 'exportPaiementPdf'])->name('paiements.export.pdf');

        // Les dépences proprio
        Route::get('/depenses', [ProprietaireDepenseController::class, 'index'])->name('depenses');

        // Rapports / téléchargeables
        Route::get('/rapports', [RapportController::class, 'index'])->name('rapports');

        // Contrats de bail et fiches locataires
        Route::get('/contrats', [ContratController::class, 'index'])->name('contrats');

        // Les ventes du propriétaire
        Route::get('/proprietaire/ventes', [VenteController::class, 'index'])->name('ventes');
    });


    // CLIENT
    Route::middleware('role:client')->prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', [ClientDashboard::class, 'index'])->name('dashboard');
        Route::get('/contrats', [ContratController::class, 'index'])->name('contrats');
        Route::get('/paiements', [\App\Http\Controllers\Client\PaiementController::class, 'index'])->name('paiements');

        // Location via modal
        Route::post('/biens/{bien}/louer', [LocationController::class, 'store'])->name('biens.louer');
        Route::get('contrats_payes/historique', [ContratController::class, 'historique'])->name('contrats_payes.historique');

        // Paiement d'un contrat via Fedapay (Enregistrement du paiement (appel AJAX après succès FedaPay))
        Route::post('/paiements/store', [\App\Http\Controllers\Client\PaiementController::class, 'store'])
            ->name('paiements.store');

        // Webhook FedaPay
        Route::post('/webhook/fedapay', [App\Http\Controllers\Webhook\FedaPayController::class, 'handle']);

        // Télécharger un contrat spécifique
        Route::get('/contrats/{attribution}/download', [ContratController::class, 'download'])->name('contrats.download');

        // Signaler un problème
        Route::resource('signalements', SignalerController::class);

        // Acheter un bien
        // Route::get('/biens/acheter', [ClientBienController::class, 'acheter'])->name('biens.acheter');
        Route::post('/biens/payer', [ClientBienController::class, 'payer'])->name('biens.payer');

        Route::get('/biens/acheter/{bien}', [ClientBienController::class, 'acheter'])->name('biens.acheter');
        Route::get('/paiement/callback', [ClientBienController::class, 'callback'])->name('paiement.callback');

        Route::post('/client/proof/upload', [ClientBienController::class, 'uploadProof'])->name('proof.upload');

        Route::get('/achats', [AchatController::class, 'index'])->name('achats');
    });

    // TEMOIGNAGES (Client ou Propriétaire) 
    Route::get('/temoignages/create', [TemoignageController::class, 'create'])->name('temoignages.create');
    Route::post('/temoignages', [TemoignageController::class, 'store'])->name('temoignages.store');


    // Conversation commune 
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    Route::get('/conversations/start/{interlocuteurId}', [ConversationController::class, 'start'])->name('conversations.start');
    Route::get('/conversations/{id}', [ConversationController::class, 'show'])->name('conversations.show');

    Route::get('/conversations/{id}/messages', [MessageController::class, 'index'])->name('messages.index');

    Route::post('/conversations/{id}/messages', [MessageController::class, 'store'])->name('messages.store');

    // Paramètre route commune 
    Route::get('/parametres', [ParametreController::class, 'index'])->name('parametres.index');
    Route::post('/parametres/photo', [ParametreController::class, 'updatePhoto'])->name('parametres.updatePhoto');

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
