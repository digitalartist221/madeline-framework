<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@biir('pageTitle') — {{ \Core\Config::get('app.name', 'Madeline Framework') }}</title>
    <meta name="description" content="{{ \Core\Config::get('app.description', 'Infrastructure PHP 8.3 Industrielle') }}">
    
    <!-- Core Scripts -->
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <script src="{{ asset('js/madeline.js') }}"></script>
    
    <!-- Modern Typography & Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/madeline.css') }}">
    
    <script>
        // Theme Initialization (Blocking to avoid flicker)
        (function() {
            const theme = localStorage.getItem('madeline-theme') || 'dark';
            if (theme === 'dark') document.documentElement.classList.add('dark');
        })();

        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        brand: {
                            50: '#f5f3ff', 100: '#ede9fe', 200: '#ddd6fe', 300: '#c4b5fd',
                            400: '#a78bfa', 500: '#8b5cf6', 600: '#7c3aed', 700: '#6d28d9',
                            800: '#5b21b6', 900: '#4c1d95',
                        }
                    },
                    borderRadius: { '4xl':'2rem', '5xl':'2.5rem', '6xl':'3rem' },
                    animation: {
                        'pulse-slow': 'pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --bg-color: #ffffff;
            --text-color: #050510;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --border-color: rgba(0, 0, 0, 0.05);
            --card-bg: #F9FAFB;
        }

        .dark {
            --bg-color: #030305;
            --text-color: #e5e7eb;
            --glass-bg: rgba(3, 3, 5, 0.75);
            --border-color: rgba(255, 255, 255, 0.05);
            --card-bg: rgba(255, 255, 255, 0.02);
        }

        body { 
            background-color: var(--bg-color); 
            color: var(--text-color); 
            overflow-x: hidden; 
            scroll-behavior: smooth;
            transition: background-color 0.4s cubic-bezier(0.4, 0, 0.2, 1), color 0.4s;
            -webkit-font-smoothing: antialiased;
        }

        /* Custom Scrollbar Premium */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(139, 92, 246, 0.2); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(139, 92, 246, 0.5); }

        /* Glassmorphism Classes */
        .glass-header {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            transition: background 0.4s, border-color 0.4s;
        }

        .floating-card { 
            background: var(--glass-bg); 
            backdrop-filter: blur(20px); 
            border: 1px solid var(--border-color); 
            box-shadow: 0 20px 60px rgba(0,0,0,0.02); 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        }
        .floating-card:hover { transform: translateY(-4px); box-shadow: 0 30px 80px rgba(0,0,0,0.04); }

        /* Dynamic Background Blobs */
        .blob {
            position: fixed;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(140px);
            z-index: -1;
            opacity: 0.15;
            pointer-events: none;
            transition: opacity 1s;
        }

        .dark .blob { opacity: 0.08; }
        .blob-1 { top: -200px; left: -100px; background: #6d28d9; }
        .blob-2 { bottom: -200px; right: -100px; background: #3b82f6; }

        /* Theme Toggle Button */
        .theme-toggle-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            background: var(--glass-bg);
            color: var(--text-color);
            transition: all 0.3s cubic-bezier(0.1, 0.5, 0.5, 1);
            cursor: pointer;
        }
        .theme-toggle-btn:hover {
            transform: scale(1.1) rotate(12deg);
            border-color: rgba(139, 92, 246, 0.5);
            color: #8b5cf6;
        }

        .btn-dark { background: var(--text-color); color: var(--bg-color); transition: all 0.3s ease; }
        .btn-dark:hover { transform: scale(1.02); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }

        #madeline-loader { position:fixed; top:0; left:0; height:2px; background:#8b5cf6; z-index:9999; width:0; transition:width 0.3s ease; }
        .nav-link { display:flex; align-items:center; gap:1rem; padding:0.875rem 1rem; border-radius:1rem; transition:all 0.2s; }
        .nav-link:hover { background:rgba(255,255,255,0.06); }
        .nav-link.active { background:rgba(139, 92, 246, 0.15); }
        .nav-link.active svg { opacity:1; color:#a78bfa; }
        .nav-link.active span { color:#a78bfa; }
        .nav-link svg { opacity:0.35; transition:opacity 0.2s; }
        .nav-link:hover svg { opacity:0.8; }
        .nav-link span { font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:0.15em; color:#6b7280; }
        .nav-link:hover span { color:#d1d5db; }
        .sidebar-section-label { padding:0 1rem; font-size:8px; font-weight:900; text-transform:uppercase; letter-spacing:0.35em; color:#374151; margin-bottom:0.5rem; }
        .badge { display:inline-flex; align-items:center; justify-content:center; min-width:18px; height:18px; padding:0 5px; border-radius:50px; font-size:8px; font-weight:900; background:rgba(139, 92, 246, 0.2); color:#a78bfa; margin-left:auto; }
    </style>
    @biir('head')
</head>
<body>
    <!-- Ambient Background -->
    <div class="blob blob-1 animate-pulse-slow"></div>
    <div class="blob blob-2 animate-pulse-slow" style="animation-delay: 2s"></div>
    <div id="madeline-loader"></div>

@miingi fi
    <!-- =============================== -->
    <!-- SIDEBAR — Authenticated Layout  -->
    <!-- =============================== -->
    <aside class="fixed top-0 left-0 h-full w-64 bg-[#050510] text-white z-50 flex flex-col shadow-2xl overflow-y-auto">
        <!-- Logo -->
        <div class="px-8 py-10 flex items-center gap-3 border-b border-white/5">
            <div class="w-9 h-9 bg-brand-500 rounded-xl flex items-center justify-center shadow-lg shadow-brand-500/30 flex-shrink-0">
                <div class="w-2.5 h-2.5 bg-white rounded-full"></div>
            </div>
            <div>
                <span class="text-lg font-black tracking-tighter">Business<span class="text-brand-500">.</span></span>
                <p class="text-[7px] font-black text-gray-600 uppercase tracking-[0.3em]">Madeline Suite</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-8 overflow-y-auto">
            <div class="space-y-1">
                <p class="sidebar-section-label">Gestion Financière</p>
                <a href="/dashboard" class="nav-link {{ $_SERVER['REQUEST_URI'] === '/dashboard' ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span>Cockpit</span>
                </a>
                <a href="/documents" class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], '/documents') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Factures</span>
                </a>
                <a href="/depenses" class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], '/depenses') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Dépenses</span>
                </a>
                <a href="/contrats" class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], '/contrats') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                    <span>Juridique</span>
                </a>
            </div>

            <div class="space-y-1">
                <p class="sidebar-section-label">Relations & CRM</p>
                <a href="/clients" class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], '/clients') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span>Clients CRM</span>
                </a>
                <a href="/entreprises" class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], '/entreprises') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Entités</span>
                </a>
                <a href="/produits" class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], '/produits') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-14L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span>Catalogue</span>
                </a>
            </div>

            <?php if (($_SESSION['user_role'] ?? '') === 'admin'): ?>
            <div class="space-y-1">
                <p class="sidebar-section-label" style="color:#6d28d9;">Administration</p>
                <a href="/equipe" class="nav-link {{ str_contains($_SERVER['REQUEST_URI'], '/equipe') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>Équipe</span>
                    <span class="badge">ADMIN</span>
                </a>
            </div>
            <?php endif; ?>
        </nav>

        <div class="p-5 border-t border-white/5 space-y-3">
            <!-- Theme Switcher for Sidebar -->
            <div class="flex items-center justify-between px-3 py-2 bg-white/5 rounded-2xl mb-2">
                <span class="text-[9px] font-bold uppercase tracking-widest text-gray-500">Mode</span>
                <button onclick="Madeline.toggleTheme()" class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-white/10 transition-all text-gray-400">
                    <svg class="dark:hidden w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg class="hidden dark:block w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.243 16.243l.707.707M7.05 7.05l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                </button>
            </div>

            <a href="/profile" class="flex items-center gap-3 px-3 py-3 hover:bg-white/5 rounded-2xl transition-all group">
                <div class="w-9 h-9 rounded-full bg-brand-500/20 text-brand-400 flex items-center justify-center font-black text-sm uppercase flex-shrink-0">
                    {{ strtoupper(substr($_SESSION['user_name'] ?? 'U', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[11px] font-black text-white truncate">{{ $_SESSION['user_name'] ?? 'Utilisateur' }}</p>
                    <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest">
                        {{ strtoupper($_SESSION['user_role'] ?? 'member') }} · Voir profil
                    </p>
                </div>
                <svg class="w-4 h-4 text-gray-600 opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="/logout" data-no-madeline="true" class="flex items-center gap-3 px-3 py-3 hover:bg-red-500/10 rounded-2xl transition-all group">
                <svg class="w-4 h-4 text-gray-600 group-hover:text-red-400 transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3 3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span class="text-[10px] font-black text-gray-500 group-hover:text-red-400 uppercase tracking-widest transition-colors">Déconnexion</span>
            </a>
        </div>
    </aside>

    <main id="madeline-app" class="pl-64 min-h-screen relative z-10">
        <div class="px-12 py-16 max-w-[1600px] mx-auto">
            @biir('content')
        </div>
    </main>

@xaaj
    <!-- =============================== -->
    <!-- PUBLIC Header (Glassmorphism)   -->
    <!-- =============================== -->
    <header class="sticky top-0 z-[100] glass-header">
        <div class="max-w-[1400px] mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-10">
                <a href="/" class="flex items-center gap-2 group transition-transform hover:scale-[1.02]">
                    <div class="w-8 h-8 bg-brand-500 rounded-lg flex items-center justify-center">
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                    </div>
                    <span class="font-serif italic text-2xl tracking-tight text-gray-900 dark:text-white/90 group-hover:text-brand-500 transition-colors">{{ \Core\Config::get('app.name', 'Madeline') }}</span>
                </a>
                <nav class="hidden lg:flex items-center gap-2">
                    <a href="/docs" class="px-5 py-2 text-sm font-medium text-gray-500 dark:text-white/50 hover:text-brand-600 dark:hover:text-white transition-all hover:bg-gray-100 dark:hover:bg-white/[0.03] rounded-full">Guide Framework</a>
                    <a href="/api/docs/ui" class="px-5 py-2 text-sm font-medium text-gray-500 dark:text-white/50 hover:text-brand-600 dark:hover:text-white transition-all hover:bg-gray-100 dark:hover:bg-white/[0.03] rounded-full">Console API</a>
                </nav>
            </div>

            <div class="flex items-center gap-4 lg:gap-6">
                <!-- Theme Switcher -->
                <button onclick="Madeline.toggleTheme()" class="theme-toggle-btn" aria-label="Toggle Theme">
                    <svg class="dark:hidden w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg class="hidden dark:block w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.243 16.243l.707.707M7.05 7.05l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                </button>

                <?php if (file_exists(__DIR__ . '/../Controllers/AuthController.php')): ?>
                <a href="/login" class="px-6 py-2.5 text-sm font-bold bg-gray-900 dark:bg-white text-white dark:text-black rounded-full hover:bg-gray-800 dark:hover:bg-gray-200 transition-all active:scale-95 shadow-xl shadow-gray-200 dark:shadow-white/5">
                    Connexion
                </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <div id="madeline-app" class="relative z-10">
        @biir('content')
    </div>

    <!-- Master Footer -->
    <footer class="border-t border-gray-100 dark:border-white/[0.05] py-24 bg-gray-50 dark:bg-[#050508] transition-colors mt-20">
        <div class="max-w-[1400px] mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-16 mb-20 text-center md:text-left">
                <div class="col-span-2 space-y-8">
                    <div class="flex items-center justify-center md:justify-start gap-4">
                        <span class="font-serif italic text-2xl text-gray-900 dark:text-white">{{ \Core\Config::get('app.name', 'Madeline') }}</span>
                    </div>
                    <p class="text-gray-500 dark:text-white/40 text-sm max-w-sm mx-auto md:mx-0 leading-relaxed font-light">
                        L'art du code rencontre l'ingénierie de pointe. Madeline est conçu pour transformer vos idées en expériences numériques d'exception.
                    </p>
                </div>
                <div class="space-y-6">
                    <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-400 dark:text-white/20">Explorer</h4>
                    <ul class="space-y-3 text-sm text-gray-500 dark:text-white/40 font-medium font-sans">
                        <li><a href="/docs" class="hover:text-brand-500 dark:hover:text-white transition-colors">Architecture</a></li>
                        <li><a href="/api/docs/ui" class="hover:text-brand-500 dark:hover:text-white transition-colors">Console API</a></li>
                    </ul>
                </div>
                <div class="space-y-6">
                    <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-400 dark:text-white/20">Origines</h4>
                    <div class="text-[11px] font-bold text-gray-400 dark:text-white/20 leading-relaxed font-sans">
                        Conçu avec passion à Dakar <br> pour l'excellence globale.
                    </div>
                </div>
            </div>
            
            <div class="pt-10 border-t border-gray-200 dark:border-white/5 flex flex-col md:flex-row justify-between items-center gap-6 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 dark:text-white/20">
                <p>&copy; {{ date('Y') }} — Un chef-d'œuvre de <span class="text-gray-900 dark:text-white/40 font-serif italic lowercase tracking-normal text-sm">Digital Artist Studio</span></p>
                <div class="flex gap-10 items-center">
                    <span class="flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-green-500"></span> Stable v1.0.0</span>
                    <a href="https://github.com/digitalartist221/madeline-framework" target="_blank" class="hover:text-brand-500 dark:hover:text-white transition-colors cursor-pointer">Licence MIT</a>
                </div>
            </div>
        </div>
    </footer>
@jeexmiingi

<script src="/js/madeline.js"></script>
<script>
    // Synchronisation de la navbar avec le routage SPA Madeline.js
    document.addEventListener('madeline:refresh', function(e) {
        let currentPath = new URL(e.detail.url || window.location.href).pathname;
        document.querySelectorAll('.nav-link').forEach(link => {
            const href = link.getAttribute('href');
            if (!href) return;
            
            if (href === '/dashboard' && currentPath === '/dashboard') {
                link.classList.add('active');
            } else if (href !== '/dashboard' && currentPath.startsWith(href)) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    });
</script>
@biir('extra_head')
</body>
</html>
