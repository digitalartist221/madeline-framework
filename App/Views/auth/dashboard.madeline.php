@biir('pageTitle', 'Tableau de Bord')

@biir('content')
<div class="space-y-8">
    <!-- Welcome Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-black tracking-tight dark:text-white">Bienvenue, {{ $name }} !</h1>
            <p class="text-gray-500 dark:text-white/40 mt-1 font-medium italic">Résumé de l'état de votre plateforme Madeline.</p>
        </div>
        <div class="px-4 py-2 bg-brand-500/10 border border-brand-500/20 rounded-2xl">
            <span class="text-[10px] font-black uppercase tracking-widest text-brand-400">Dernier accès : {{ $lastLogin }}</span>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Users Count -->
        <div class="floating-card p-8 rounded-4xl">
            <div class="flex items-start justify-between mb-6">
                <div class="w-12 h-12 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <span class="px-2 py-0.5 bg-green-500/10 text-green-500 text-[10px] font-black uppercase rounded-lg">Actif</span>
            </div>
            <h3 class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-1">Utilisateurs</h3>
            <p class="text-3xl font-black dark:text-white leading-none">{{ $userCount }}</p>
        </div>

        <!-- System Status -->
        <div class="floating-card p-8 rounded-4xl bg-brand-500/5 border-brand-500/10">
            <div class="flex items-start justify-between mb-6">
                <div class="w-12 h-12 bg-brand-500/10 rounded-2xl flex items-center justify-center text-brand-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <span class="px-2 py-0.5 bg-brand-500/10 text-brand-500 text-[10px] font-black uppercase rounded-lg">Stable</span>
            </div>
            <h3 class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-1">Instance Engine</h3>
            <p class="text-3xl font-black dark:text-white leading-none">v{{ \Core\Config::get('app.version', '1.0.0') }}</p>
        </div>

        <!-- Security Badge -->
        <div class="floating-card p-8 rounded-4xl">
            <div class="flex items-start justify-between mb-6">
                <div class="w-12 h-12 bg-green-500/10 rounded-2xl flex items-center justify-center text-green-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <span class="px-2 py-0.5 bg-blue-500/10 text-blue-500 text-[10px] font-black uppercase rounded-lg">Scan OK</span>
            </div>
            <h3 class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-1">Sécurité</h3>
            <p class="text-3xl font-black dark:text-white leading-none">Protégé</p>
        </div>
    </div>

    <!-- Details Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="floating-card p-10 rounded-5xl">
            <h4 class="text-[12px] font-black dark:text-white uppercase tracking-[0.2em] mb-8 border-l-4 border-brand-500 pl-4">Spécifications Serveur</h4>
            <div class="space-y-6">
                <div class="flex justify-between items-center pb-4 border-b border-gray-100 dark:border-white/5">
                    <span class="text-sm font-medium text-gray-500">Version PHP</span>
                    <span class="font-mono text-xs dark:text-white">{{ $sysInfo['php_version'] }}</span>
                </div>
                <div class="flex justify-between items-center pb-4 border-b border-gray-100 dark:border-white/5">
                    <span class="text-sm font-medium text-gray-500">Usage Mémoire (Script)</span>
                    <span class="font-mono text-xs dark:text-white">{{ $sysInfo['memory_usage'] }}</span>
                </div>
                <div class="flex justify-between items-center pb-4 border-b border-gray-100 dark:border-white/5">
                    <span class="text-sm font-medium text-gray-500">Logiciel Serveur</span>
                    <span class="text-xs dark:text-white truncate max-w-[200px]">{{ $sysInfo['server'] }}</span>
                </div>
                <div class="flex justify-between items-center shrink-0">
                    <span class="text-sm font-medium text-gray-500">Système d'Exploitation</span>
                    <span class="text-xs dark:text-white">{{ $sysInfo['os'] }}</span>
                </div>
            </div>
        </div>

        <div class="floating-card p-10 rounded-5xl flex flex-col justify-center items-center text-center">
            <div class="w-16 h-16 bg-gray-100 dark:bg-white/5 rounded-full flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h4 class="text-lg font-black dark:text-white mb-2">Composant Personnalisé</h4>
            <p class="text-sm text-gray-500 max-w-[280px]">Utilisez ce Dashboard comme point de départ pour l'administration de votre application.</p>
            <button class="mt-8 px-8 py-3 bg-brand-500 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:scale-105 transition-all shadow-xl shadow-brand-500/20">
                Action Rapide
            </button>
        </div>
    </div>
</div>
@xaaj
