@indi('docs/layout')

@def('pageTitle')Documentation Technique Exhaustive — Madeline Framework@jeexdef

@def('toc')
    <a class="sidebar-link" href="#intro">Introduction</a>
    <a class="sidebar-link" href="#kernel">Cœur du Système (Rek)</a>
    <a class="sidebar-link" href="#ligeey">Ligeey CLI Reference</a>
    <a class="sidebar-link" href="#router">Routage & Middleware</a>
    <a class="sidebar-link" href="#security">Sécurité & Shield</a>
    <a class="sidebar-link" href="#orm">MadelineORM (Synchro SQL)</a>
    <a class="sidebar-link" href="#views">Moteur MadelineView</a>
    <a class="sidebar-link" href="#assets">Gestion des Assets</a>
    <a class="sidebar-link" href="#request">Requêtes & Formulaires</a>
    <a class="sidebar-link" href="#components">Architecture Composants</a>
    <a class="sidebar-link" href="#mail">Mails & Templates</a>
    <a class="sidebar-link" href="#storage">Storage & Uploads</a>
    <a class="sidebar-link" href="#config">Configuration (AppConfig)</a>
    <a class="sidebar-link" href="#vscode">Extension VSCode (Snippets)</a>
    <a class="sidebar-link" href="#swagger">Console API Interactive</a>
    <a class="sidebar-link" href="#performance">Cache & Performance</a>
@jeexdef

@def('doc_content')

    <!-- HERO SECTION -->
    <div id="intro" class="mb-32">
        <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-brand-500/10 border border-brand-500/20 text-brand-400 text-[10px] font-black uppercase tracking-[0.3em] mb-12">
            Spécifications Industrielles · v1.0.0 Stable
        </div>
        <h1 class="text-6xl md:text-8xl font-black text-gray-900 dark:text-white tracking-tighter mb-8 leading-[0.85]">
            Manuel <br>
            <span class="font-serif italic font-light text-brand-600 dark:text-brand-500 opacity-90">de Référence</span>.
        </h1>
        <p class="text-xl text-gray-500 dark:text-white/40 max-w-3xl leading-relaxed font-light">
            Ce guide constitue la source de vérité pour le développement, le déploiement et la maintenance 
            d'applications professionnelles sur Madeline.
        </p>
    </div>

    <article class="prose-premium">

        <!-- 1. KERNEL -->
        <section id="kernel" class="mb-32">
            <h2>Cœur du Système</h2>
            
            <div class="p-8 rounded-3xl bg-brand-500/5 border border-brand-500/10 mb-12">
                <h4 class="text-brand-500 font-black uppercase tracking-widest text-xs mb-4">Installation Rapide</h4>
                <p class="text-sm mb-4">Initialisez votre projet Madeline en une seule commande :</p>
                <div class="bg-black/90 rounded-2xl p-6 font-mono text-sm text-brand-400 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-3 opacity-20">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
                    </div>
                    composer require digitalartist/madeline-framework
                </div>
            </div>

            <p>Le noyau de Madeline (Rek) repose sur une architecture de type micro-kernel, privilégiant l'absence de mémoire statique et une exécution synchrone rapide.</p>
            
            <h3>Cycle de Vie d'une Requête</h3>
            <ol>
                <li><strong>Point d'entrée</strong> : <code>public/index.php</code> initialise l'autoloader.</li>
                <li><strong>Rek Boot</strong> : <code>Core\App::run()</code> charge la configuration et détecte l'état du système.</li>
                <li><strong>Config Dispatch</strong> : Chargement de <code>routes.php</code>.</li>
                <li><strong>Routage</strong> : Résolution de l'URI et exécution des middlewares.</li>
                <li><strong>Rendu</strong> : Envoi de la réponse au client.</li>
            </ol>

            <h3>Configuration</h3>
            <p>Madeline utilise l'objet <code>Core\Config</code> pour centraliser les paramètres. Les fichiers de configuration sont situés à la racine (<code>config.php</code>).</p>
<pre><code>use Core\Config;

// Récupération sécurisée
$dbHost = Config::get('database.host', 'localhost');</code></pre>
        </section>

        <!-- 2. LIGEEY -->
        <section id="ligeey" class="mb-32">
            <h2>Ligeey CLI Reference</h2>
            <div class="grid md:grid-cols-2 gap-6 my-10">
                <div class="p-6 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5">
                    <h4 class="font-bold mb-2">Génération (Amal)</h4>
                    <ul class="text-sm space-y-1">
                        <li><code>amal:controller [Nom]</code></li>
                        <li><code>amal:model [Nom]</code></li>
                        <li><code>amal:migration [Nom]</code></li>
                        <li><code>amal:crud [Nom]</code></li>
                    </ul>
                </div>
                <div class="p-6 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5">
                    <h4 class="font-bold mb-2">Maintenance & Serveur</h4>
                    <ul class="text-sm space-y-1">
                        <li><code>doxal [port]</code> : Serveur de dev.</li>
                        <li><code>setal:cache</code> : Vidage intégral.</li>
                        <li><code>takoo:storage</code> : Symbolic link.</li>
                        <li><code>yoon:run</code> : Migration SQL.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- 3. SECURITY -->
        <section id="security" class="mb-32">
            <h2>Sécurité & Shield</h2>
            <p>Le système "Shield" de Madeline injecte des politiques de sécurité strictes au niveau HTTP.</p>
            
            <h3>Middlewares de Protection</h3>
            <ul>
                <li><strong>CsrfMiddleware</strong> : Protection contre les contrefaçons de requêtes. Utilisez la directive <code>@csrf</code> dans vos formulaires.</li>
                <li><strong>SecurityHeadersMiddleware</strong> :
                    <ul>
                        <li><code>X-Frame-Options: SAMEORIGIN</code> (Prévention Clickjacking)</li>
                        <li><code>X-XSS-Protection: 1; mode=block</code></li>
                        <li><code>Content-Security-Policy</code> : Isolation des scripts et styles.</li>
                    </ul>
                </li>
            </ul>
        </section>

        <!-- ROUTER -->
        <section id="router" class="mb-32">
            <h2>Routage & Middleware</h2>
            <p>Le routeur synchrone de Madeline gère la résolution des URIs et l'exécution de la pile de middlewares.</p>
            
            <h3>Définition de Routes</h3>
            <p>Les routes sont définies dans le fichier <code>routes.php</code> à la racine du projet.</p>
<pre><code>use Core\Router;

Router::get('/hello', function() {
    return "Bonjour le monde";
});

// Avec contrôleur et middleware
Router::get('/profile', ['App\Controllers\UserController', 'profile'], ['App\Middlewares\AuthMiddleware']);</code></pre>

            <h3>Paramètres de Route</h3>
            <p>Capturez des segments dynamiques facilement :</p>
<pre><code>Router::get('/user/{id}', function($id) {
    return "ID Utilisateur : " . $id;
});</code></pre>
        </section>

        <!-- 4. ORM -->
        <section id="orm" class="mb-32">
            <h2>MadelineORM</h2>
            <p>L'ORM propose une sémantique Wolof unique et un système de synchronisation automatique (Zéro-Migration).</p>
            
            <h3>Zéro-Migration : Comment ça marche ?</h3>
            <p>Lorsque vous définissez une propriété dans un modèle, MadelineORM analyse le schéma de la table correspondante. Si la colonne est absente, elle est créée via un <code>ALTER TABLE</code> transparent.</p>
<pre><code>class Product extends MadelineORM {
    public string $name;
    public float $price; // Création auto en DECIMAL/FLOAT dans MySQL
}</code></pre>

            <h3>Sémantique Wolof complète</h3>
            <ul>
                <li><code>->fari(['statut' => 1])</code> : Sélection filtrée multiset.</li>
                <li><code>->bindu()</code> : Persistance immédiate (Insert/Save).</li>
                <li><code>->weccit()</code> : Mise à jour thermique des données modifiées.</li>
                <li><code>->far()</code> : Suppression irréversible de l'objet.</li>
                <li><code>->loko($id)</code> : Extraction unitaire par identifiant.</li>
            </ul>
        </section>

        <!-- 5. VIEWS & COMPONENTS -->
        <section id="views" class="mb-32">
            <h2>Moteur MadelineView</h2>
            <p>Un moteur de templating haute performance compilé en PHP natif.</p>

            <h3>Directives de Templating</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-white/10 uppercase tracking-widest text-[10px]">
                            <th class="py-4">Directive</th>
                            <th class="py-4">Usage</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        <tr><td class="py-4"><code>@baat(...)</code></td><td class="py-4">Boucle Foreach (Wolof: Dire/Parler). Terminé par <code>@jeexbaat</code>.</td></tr>
                        <tr><td class="py-4"><code>@ndax(...)</code></td><td class="py-4">Structure conditionnelle (Si). Terminé par <code>@jeexndax</code>.</td></tr>
                        <tr><td class="py-4"><code>@def(...)</code></td><td class="py-4">Définition d'un bloc de contenu. Terminé par <code>@jeexdef</code>.</td></tr>
                        <tr><td class="py-4"><code>@biir(...)</code></td><td class="py-4">Injection de contenu défini/section.</td></tr>
                        <tr><td class="py-4"><code>@indi(...)</code></td><td class="py-4">Héritage de layout (Extends).</td></tr>
                        <tr><td class="py-4"><code>{{ $var }}</code></td><td class="py-4">Affichage échappé (Anti-XSS).</td></tr>
                        <tr><td class="py-4"><code>{!! $var !!}</code></td><td class="py-4">Affichage brut (HTML non-échappé).</td></tr>
                        <tr><td class="py-4"><code>@json($var)</code></td><td class="py-4">Encodage JSON automatique (Idéal pour JavaScript natif).</td></tr>
                        <tr><td class="py-4"><code>@csrf</code></td><td class="py-4">Génération d'un token CSRF caché pour sécuriser les formulaires POST.</td></tr>
                    </tbody>
                </table>
            </div>

            <h3 id="assets" class="mt-20">Gestion des Assets</h3>
            <p>Madeline centralise la gestion des fichiers statiques (CSS, JS, Images) via une fonction globale de helper.</p>
            
            <h4>La fonction <code>asset($path)</code></h4>
            <p>Cette fonction génère une URL absolue vers vos fichiers situés dans le dossier <code>public/</code>. Elle ajoute automatiquement un paramètre de version (cache-busting) basé sur la date de modification du fichier.</p>
<pre><code>&lt;!-- Dans votre layout ou vue --&gt;
&lt;link rel="stylesheet" href="{{ asset('css/madeline.css') }}"&gt;
&lt;script src="{{ asset('js/madeline.js') }}"&gt;&lt;/script&gt;
&lt;img src="{{ asset('img/logo.png') }}" alt="Logo"&gt;</code></pre>

            <h4>Stylesheet Global</h4>
            <p>Le framework inclut un fichier <code>public/css/madeline.css</code> pour vos styles globaux et variables CSS personnalisées.</p>

            <h3 id="request" class="mt-20">Requêtes & Formulaires</h3>
            <p>Le traitement des données entrantes est simplifié par la classe <code>Request</code>, accessible via le helper global <code>request()</code>.</p>
            
            <h4>Sémantique Wolof (jël & seet)</h4>
            <p>Madeline privilégie une syntaxe expressive pour récupérer et valider vos données.</p>
<pre><code>// Dans votre contrôleur
$nom = request()->jël('nom'); // Récupère $_POST['nom'] ou $_GET['nom']

if (request()->seet(['nom' => 'required', 'email' => 'required|email'])) {
    // Validation réussie
}</code></pre>

            <h4>Support Hybride (JSON & Fichiers)</h4>
            <p>Madeline détecte automatiquement le format de la requête (Formulaire classique ou JSON) et unifie l'accès aux données.</p>
            <ul>
                <li><strong>JSON</strong> : Si le client envoie du JSON, <code>request()->input()</code> récupère les clés directement.</li>
                <li><strong>Fichiers</strong> : Utilisez <code>request()->file('avatar')</code> pour accéder aux données d'upload.</li>
            </ul>

            <h4>Métadonnées & Sécurité</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-white/10 uppercase tracking-widest text-[10px]">
                            <th class="py-4">Méthode</th>
                            <th class="py-4">Usage</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        <tr><td class="py-4"><code>method()</code></td><td class="py-4">Retourne le verbe HTTP (GET, POST, etc.).</td></tr>
                        <tr><td class="py-4"><code>isPost() / isGet()</code></td><td class="py-4">Vérifie le type de requête.</td></tr>
                        <tr><td class="py-4"><code>ip()</code></td><td class="py-4">Retourne l'adresse IP du client.</td></tr>
                        <tr><td class="py-4"><code>header('Key')</code></td><td class="py-4">Récupère un en-tête HTTP spécifique.</td></tr>
                        <tr><td class="py-4"><code>all()</code></td><td class="py-4">Retourne l'ensemble des paramètres fusionnés.</td></tr>
                    </tbody>
                </table>
            </div>

            <h3 id="components" class="mt-20">Architecture Composants</h3>
            <p>Déclarez des composants réutilisables avec une syntaxe proche du HTML moderne.</p>
<pre><code>&lt;!-- Usage --&gt;
&lt;x-alert type="info"&gt;Opération réussie.&lt;/x-alert&gt;

&lt;!-- Rendu --&gt;
Madeline cherche dans App/Views/Components/alert.madeline.php</code></pre>
        </section>

        <!-- 6. ERROR HANDLING -->
        <section id="errors" class="mb-32">
            <h2>Exceptions & Erreurs</h2>
            <p>Le mode <code>LOCAL</code> active le "Mesh Error Handler", une interface de débogage immersive affichant la stack trace et l'extrait de code fautif.</p>
            
            <h3>Personnalisation Production</h3>
            <p>En production, créez le fichier <code>App/Views/errors/500.madeline.php</code> pour proposer une interface de secours sobre à vos utilisateurs.</p>
        </section>

        <!-- 7. CONFIGURATION -->
        <section id="config" class="mb-32">
            <div class="text-[10px] font-black text-brand-500 uppercase tracking-[0.4em] mb-6">Chapitre VII</div>
            <h2>Configuration (AppConfig)</h2>
            <p>Madeline utilise une source de vérité unique située dans <code>App/Config/AppConfig.php</code>. Ce système orienté objet facilite la gestion des environnements et l'accès aux variables.</p>
            
            <h3>La Classe AppConfig</h3>
            <p>Toutes vos clés (Base de données, Mail, API) sont centralisées ici. Vous n'avez plus besoin de jongler avec plusieurs fichiers de configuration.</p>
<pre><code>// App/Config/AppConfig.php
return [
    'name' => 'Madeline',
    'mail' => [
        'host' => 'smtp.example.com',
        // ...
    ]
];

// Utilisation
\$name = \Core\Config::get('name');
\$smtp = \Core\Config::get('mail.host');</code></pre>

            <h3>Assistant d'Installation</h3>
            <p>Lors d'un premier déploiement, vous pouvez accéder à <code>/setup</code> pour configurer les accès essentiels via une interface graphique interactive.</p>
        </section>

        <!-- VSCODE EXTENSION -->
        <section id="vscode" class="mb-32">
            <div class="text-[10px] font-black text-brand-500 uppercase tracking-[0.4em] mb-6">Productivité</div>
            <h2>Extension VSCode (Snippets)</h2>
            <p>Pour booster votre productivité, nous proposons un pack de snippets officiels qui ajoutent l'autocomplétion pour les directives Madeline et les méthodes de l'ORM.</p>
            
            <div class="p-8 rounded-3xl bg-brand-500/5 border border-brand-500/10 mb-12">
                <h4 class="text-brand-500 font-black uppercase tracking-widest text-xs mb-4">Installation Manuelle (v1.0)</h4>
                <ol class="text-sm space-y-4 list-decimal pl-5">
                    <li>Téléchargez le fichier <a href="{{ asset('extensions/madeline.code-snippets') }}" class="text-brand-500 underline font-bold" download>madeline.code-snippets</a>.</li>
                    <li>Dans VSCode, allez dans <code>File > Preferences > Configure User Snippets</code>.</li>
                    <li>Sélectionnez <code>New Global Snippets file...</code> et nommez-le <code>madeline</code>.</li>
                    <li>Copiez le contenu du fichier téléchargé dans le fichier qui s'ouvre dans VSCode.</li>
                </ol>
            </div>

            <h3>Exemples d'utilisation</h3>
            <ul>
                <li>Tapez <code>baat</code> + Tab pour générer une boucle Wolof.</li>
                <li>Tapez <code>ndax</code> + Tab pour une condition.</li>
                <li>Tapez <code>bindu</code> sur un objet ORM pour l'enregistrer.</li>
            </ul>
        </section>

        <!-- 8. MAILS -->
        <section id="mail" class="mb-32">
            <div class="text-[10px] font-black text-brand-500 uppercase tracking-[0.4em] mb-6">Chapitre VIII</div>
            <h2>Envoi de Mails &amp; Templates</h2>
            <p>Madeline intègre un système d'envoi d'e-mails HTML élégant, s'appuyant sur le moteur de vues pour une personnalisation totale.</p>

            <h3>Usage de base</h3>
            <p>Utilisez la méthode statique <code>Mail::send()</code> pour envoyer un e-mail basé sur une vue.</p>
<pre><code>use Packages\Mail\Mail;

Mail::send(
    'destinataire@exemple.com', 
    'Bienvenue !', 
    'mail/welcome', 
    ['name' => 'Jean']
);</code></pre>

            <h3>Templates & Layouts</h3>
            <p>Les templates de mail sont situés dans <code>App/Views/mail/</code>. Vous pouvez utiliser un layout commun pour garder une identité visuelle cohérente.</p>
<pre><code>&lt;!-- App/Views/mail/layout.madeline.php --&gt;
&lt;div class="email-body"&gt;
    @biir('content')
&lt;/div&gt;</code></pre>

            <h3>Configuration</h3>
            <p>La configuration SMTP est gérée dans <code>config/app.php</code> sous la clé <code>mail</code>. En mode local sans serveur mail configuré, l'envoi est simulé dans les logs PHP.</p>
        </section>

        <!-- 9. STORAGE -->
        <section id="storage" class="mb-32">
            <div class="text-[10px] font-black text-brand-500 uppercase tracking-[0.4em] mb-6">Chapitre IX</div>
            <h2>Gestion du Storage</h2>
            <p>L'abstraction Storage simplifie les opérations de fichiers sur le système local ou cloud.</p>
<pre><code>use Packages\Storage\Storage;

// Enregistrement
$path = Storage::upload($_FILES['avatar'], 'profiles');

// Récupération URL
$url = Storage::url($path);</code></pre>
        </section>

        <!-- 10. API & SWAGGER -->
        <section id="swagger" class="mb-32">
            <div class="text-[10px] font-black text-brand-500 uppercase tracking-[0.4em] mb-6">Chapitre X</div>
            <h2>Console API Interactive</h2>
            <p>Madeline intègre nativement Swagger UI pour documenter et tester vos APIs en temps réel.</p>
            <ul>
                <li><strong>URL</strong> : Accédez à <code>/api/docs/ui</code> pour l'interface graphique.</li>
                <li><strong>JSON</strong> : Le schéma OpenAPI est disponible sur <code>/api/docs</code>.</li>
            </ul>
            <p>Cette documentation est auto-générée à partir de vos contrôleurs et de la configuration API.</p>
        </section>

        <!-- 11. PERFORMANCE -->
        <section id="performance" class="mb-32">
            <div class="text-[10px] font-black text-brand-500 uppercase tracking-[0.4em] mb-6">Chapitre XI</div>
            <h2>Cache & Performance</h2>
            <p>Le framework est optimisé pour une exécution ultra-rapide (< 1ms pour le routage).</p>
            <ul>
                <li><strong>View Cache</strong> : Les vues compilées sont stockées dans <code>storage/cache/views</code>.</li>
                <li><strong>Turbo SPA</strong> : Grâce à <code>madeline.js</code>, les navigations ne rechargent que le contenu utile via AJAX/Fetch.</li>
                <li><strong>Auto-Invalidation</strong> : Le cache des vues se régénère automatiquement si le fichier source est modifié.</li>
            </ul>
        </section>

    </article>
@jeexdef
