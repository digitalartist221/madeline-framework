<?php
/**
 * Madeline Framework - Diagnostic & Setup Checker
 */

$minPhpVersion = '8.1.0';
$phpOk = version_compare(PHP_VERSION, $minPhpVersion, '>=');

$dirs = [
    '../storage' => 'Stockage principal',
    '../storage/cache' => 'Cache système',
    '../storage/cache/views' => 'Cache des vues',
    '../storage/app/public' => 'Fichiers publics uploadés',
    '../App/Config' => 'Configuration Application'
];

$extensions = [
    'pdo' => 'Accès aux données SQL',
    'mbstring' => 'Gestion des chaînes multibytes',
    'openssl' => 'Sécurité et Chiffrement',
    'gd' => 'Traitement d\'images (Optionnel)',
    'curl' => 'Requêtes HTTP Externes'
];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madeline Diagnostic — Hub de Santé</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;900&family=JetBrains+Mono&display=swap');
        body { font-family: 'Outfit', sans-serif; background: #050508; color: white; }
        .glass { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); }
        .status-ok { color: #10b981; }
        .status-error { color: #ef4444; }
    </style>
</head>
<body class="min-h-screen py-12 px-6">
    <div class="max-w-4xl mx-auto">
        <header class="mb-12 text-center">
            <h1 class="text-4xl font-black mb-2 tracking-tight">Madeline <span class="text-indigo-500">Diagnostic</span></h1>
            <p class="text-gray-500 font-light">Vérification de l'aptitude au déploiement industriel</p>
        </header>

        <div class="grid gap-6">
            <!-- PHP Version -->
            <div class="glass p-8 rounded-3xl flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-1">Environnement Core</h3>
                    <p class="text-2xl font-black">PHP <?php echo PHP_VERSION; ?></p>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold uppercase tracking-tighter px-3 py-1 rounded-full <?php echo $phpOk ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500'; ?>">
                        <?php echo $phpOk ? 'COMPATIBLE' : 'INCOMPATIBLE'; ?>
                    </span>
                    <p class="text-[10px] text-gray-600 mt-2">Requis: >= <?php echo $minPhpVersion; ?></p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Permissions -->
                <div class="glass p-8 rounded-3xl">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-6">Permissions d'écriture</h3>
                    <ul class="space-y-4">
                        <?php foreach ($dirs as $path => $label): ?>
                        <li class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold"><?php echo $label; ?></p>
                                <p class="text-[10px] font-mono text-gray-600"><?php echo $path; ?></p>
                            </div>
                            <?php 
                                $fullPath = __DIR__ . '/' . $path;
                                $writable = is_dir($fullPath) && is_writable($fullPath);
                            ?>
                            <div class="<?php echo $writable ? 'status-ok' : 'status-error'; ?>">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <?php if ($writable): ?>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    <?php else: ?>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    <?php endif; ?>
                                </svg>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Extensions -->
                <div class="glass p-8 rounded-3xl">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-6">Extensions PHP</h3>
                    <ul class="space-y-4">
                        <?php foreach ($extensions as $ext => $label): ?>
                        <li class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold"><?php echo $label; ?></p>
                                <p class="text-[10px] font-mono text-gray-600">extension: <?php echo $ext; ?></p>
                            </div>
                            <?php $extOk = extension_loaded($ext); ?>
                            <div class="<?php echo $extOk ? 'status-ok' : 'status-error'; ?>">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <?php if ($extOk): ?>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    <?php else: ?>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    <?php endif; ?>
                                </svg>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Redirection Tip -->
            <div class="bg-indigo-600/10 border border-indigo-500/20 p-8 rounded-3xl">
                <div class="flex gap-4">
                    <div class="text-indigo-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-indigo-400 mb-2">Conseil de Déploiement</h4>
                        <p class="text-sm text-gray-400 leading-relaxed font-light">
                            Si tout est vert mais que vous avez encore une erreur 500, vérifiez que votre hébergeur autorise le <strong>mod_rewrite</strong> d'Apache. Les fichiers <code>.htaccess</code> à la racine et dans <code>public/</code> sont essentiels pour orienter le trafic vers Madeline Rek.
                        </p>
                    </div>
                </div>
            </div>
            
            <footer class="mt-8 text-center">
                <a href="/" class="text-xs font-bold uppercase tracking-widest text-gray-600 hover:text-white transition-colors">Retour à l'accueil</a>
            </footer>
        </div>
    </div>
</body>
</html>
