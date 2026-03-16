<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ @biir('pageTitle') ?? 'Madeline — Software de gestion industrielle' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
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
    <!-- MAIN Layout — Centered content  -->
    <!-- =============================== -->
    <main id="madeline-app" class="min-h-screen relative z-10">
        <div class="px-12 py-16 max-w-[1200px] mx-auto">
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
                        Conçu avec amour au Sénégal.
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
