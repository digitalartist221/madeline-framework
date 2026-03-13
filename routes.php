<?php
use Core\Router;

use Packages\View\MadelineView;

// Routes par défaut - Bienvenue
Router::get('/', function() {
    return MadelineView::render('welcome');
});

// Route MVC Users
Router::get('/users', ['App\Controllers\UserController', 'index']);
Router::get('/users/{id}', ['App\Controllers\UserController', 'show']);

// --- MADELINE BUSINESS SUITE ---

// Management MVC
// Les routes dashboard sont gérées par le scaffold en bas avec middleware
// Management MVC (Protégé)
Router::get('/entreprises', ['App\Controllers\EntrepriseController', 'index'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/entreprises/nouveau', ['App\Controllers\EntrepriseController', 'amul'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/entreprises/edit/{id}', ['App\Controllers\EntrepriseController', 'edit'], ['\App\Middlewares\AuthMiddleware']);
Router::post('/entreprises/save', ['App\Controllers\EntrepriseController', 'bindu'], ['\App\Middlewares\AuthMiddleware']);

Router::get('/produits', ['App\Controllers\ProduitController', 'index'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/produits/nouveau', ['App\Controllers\ProduitController', 'amul'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/produits/edit/{id}', ['App\Controllers\ProduitController', 'edit'], ['\App\Middlewares\AuthMiddleware']);
Router::post('/produits/save', ['App\Controllers\ProduitController', 'bindu'], ['\App\Middlewares\AuthMiddleware']);

Router::get('/clients', ['App\Controllers\ClientController', 'index'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/clients/nouveau', ['App\Controllers\ClientController', 'amul'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/clients/edit/{id}', ['App\Controllers\ClientController', 'edit'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/clients/view/{id}', ['App\Controllers\ClientController', 'view'], ['\App\Middlewares\AuthMiddleware']);
Router::post('/clients/save', ['App\Controllers\ClientController', 'bindu'], ['\App\Middlewares\AuthMiddleware']);

// Documents & Contrats (Protégés)
Router::get('/documents', ['App\Controllers\DocumentController', 'index'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/documents/nouveau', ['App\Controllers\DocumentController', 'amul'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/documents/edit/{id}', ['App\Controllers\DocumentController', 'edit'], ['\App\Middlewares\AuthMiddleware']);
Router::post('/documents/save', ['App\Controllers\DocumentController', 'bindu'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/documents/transform/{id}/{toType}', ['App\Controllers\DocumentController', 'transform'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/documents/send/{id}', ['App\Controllers\DocumentController', 'sendEmail'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/documents/print/{id}', ['App\Controllers\DocumentController', 'print'], ['\App\Middlewares\AuthMiddleware']);

Router::get('/contrats', ['App\Controllers\ContratController', 'index'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/contrats/nouveau', ['App\Controllers\ContratController', 'create'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/contrats/edit/{id}', ['App\Controllers\ContratController', 'edit'], ['\App\Middlewares\AuthMiddleware']);
Router::post('/contrats/save', ['App\Controllers\ContratController', 'bindu'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/contrats/send/{id}', ['App\Controllers\ContratController', 'sendEmail'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/contrats/print/{id}', ['App\Controllers\ContratController', 'print'], ['\App\Middlewares\AuthMiddleware']);

// Dépenses & Équipe
Router::get('/depenses', ['App\Controllers\DepenseController', 'index'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/depenses/nouveau', ['App\Controllers\DepenseController', 'amul'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/depenses/edit/{id}', ['App\Controllers\DepenseController', 'edit'], ['\App\Middlewares\AuthMiddleware']);
Router::post('/depenses/save', ['App\Controllers\DepenseController', 'bindu'], ['\App\Middlewares\AuthMiddleware']);

Router::get('/equipe', ['App\Controllers\AuthController', 'teamList'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/equipe/nouveau', ['App\Controllers\AuthController', 'teamAdd'], ['\App\Middlewares\AuthMiddleware']);
Router::post('/equipe/save', ['App\Controllers\AuthController', 'teamSave'], ['\App\Middlewares\AuthMiddleware']);

// Vue Publique (Token Bridge)
Router::get('/view/contrat/{token}', ['App\Controllers\ContratController', 'publicView']);
Router::post('/view/contrat/{token}/action', ['App\Controllers\ContratController', 'publicAction']);

Router::get('/view/{type}/{token}', ['App\Controllers\DocumentController', 'publicView']);
Router::post('/view/{type}/{token}/action', ['App\Controllers\DocumentController', 'publicAction']);

// Paiement Paytech
Router::get('/payment/init/{doc_id}', ['App\Controllers\PaytechController', 'init']);
Router::get('/payment/success', ['App\Controllers\PaytechController', 'success']);
Router::get('/payment/cancel', ['App\Controllers\PaytechController', 'cancel']);


// ==== ROUTES: SCATTERED AUTH SCAFFOLD ==== //
Router::get('/login', ['\App\Controllers\AuthController', 'login']);
Router::post('/login', ['\App\Controllers\AuthController', 'loginPOST']);
Router::get('/register', ['\App\Controllers\AuthController', 'register']);
Router::post('/register', ['\App\Controllers\AuthController', 'registerPOST']);
Router::get('/logout', ['\App\Controllers\AuthController', 'logout']);

// Profil & Sécurité
Router::get('/profile', ['\App\Controllers\AuthController', 'profile'], ['\App\Middlewares\AuthMiddleware']);
Router::post('/profile/update', ['\App\Controllers\AuthController', 'updateProfile'], ['\App\Middlewares\AuthMiddleware']);
Router::get('/forgot-password', ['\App\Controllers\AuthController', 'forgotPassword']);
Router::post('/forgot-password', ['\App\Controllers\AuthController', 'forgotPasswordPOST']);

// Route Sécurisée par l'AuthMiddleware
Router::get('/dashboard', ['\App\Controllers\DashboardController', 'index'], ['\App\Middlewares\AuthMiddleware']);
// ========================================= //