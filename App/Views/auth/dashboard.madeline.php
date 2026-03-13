@use('layout')

@def('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="py-12 px-6 max-w-7xl mx-auto">
    <!-- Header Hero -->
    <header class="mb-14 flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
        <div>
            <div class="flex items-center gap-3 mb-4">
                <div class="h-1 w-12 bg-brand-500 rounded-full"></div>
                <span class="text-[10px] font-black uppercase tracking-[0.4em] text-brand-500">Cockpit Opérationnel</span>
            </div>
            <h1 class="text-6xl font-black text-[#050510] tracking-tighter mb-2">Synthèse <span class="text-gray-300">Business.</span></h1>
            <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] ml-1 opacity-70">Intelligence financière propulsée par Madeline</p>
        </div>
        
        <div class="p-6 rounded-3xl bg-gray-50/50 border border-gray-100 backdrop-blur-sm self-stretch md:self-auto flex items-center gap-8">
            <div class="text-right border-r border-gray-200 pr-8">
                <p class="text-[8px] font-black uppercase tracking-widest text-gray-400 mb-1">Solde Cash-flow</p>
                <p class="text-2xl font-black {{ $bilan >= 0 ? 'text-green-500' : 'text-red-500' }}">
                    {{ number_format($bilan, 0, ',', ' ') }} <span class="text-[10px] opacity-50">XOF</span>
                </p>
            </div>
            <div class="text-right">
                <p class="text-[8px] font-black uppercase tracking-widest text-gray-400 mb-1">Encaissements Payés</p>
                <p class="text-2xl font-black text-[#050510]">
                    {{ number_format($revenus, 0, ',', ' ') }} <span class="text-[10px] opacity-50">XOF</span>
                </p>
            </div>
        </div>
    </header>

    <!-- KPI Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="p-8 rounded-[2.5rem] bg-[#050510] text-white shadow-2xl shadow-black/10 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-brand-500/10 rounded-full blur-2xl group-hover:bg-brand-500/20 transition-all"></div>
            <div class="flex justify-between items-start mb-8 relative z-10">
                <div class="w-10 h-10 rounded-2xl bg-white/10 flex items-center justify-center border border-white/10">
                    <svg class="w-5 h-5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="text-[9px] font-black uppercase tracking-widest text-gray-500 mt-2">CRM</span>
            </div>
            <h3 class="text-4xl font-black mb-1 tracking-tight">{{ $countClients }}</h3>
            <p class="text-[8px] font-black uppercase tracking-[0.3em] text-gray-500 opacity-60">Clients Actifs</p>
        </div>

        <div class="p-8 rounded-[2.5rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl transition-all group">
            <div class="flex justify-between items-start mb-8">
                <div class="w-10 h-10 rounded-2xl bg-brand-50 flex items-center justify-center border border-brand-100">
                    <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-14L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <span class="text-[9px] font-black uppercase tracking-widest text-gray-400 mt-2">Inventory</span>
            </div>
            <h3 class="text-4xl font-black mb-1 tracking-tight text-[#050510]">{{ $countProducts }}</h3>
            <p class="text-[8px] font-black uppercase tracking-[0.3em] text-gray-400">Références Catalogue</p>
        </div>

        <div class="p-8 rounded-[2.5rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl transition-all group">
            <div class="flex justify-between items-start mb-8">
                <div class="w-10 h-10 rounded-2xl bg-gray-50 flex items-center justify-center border border-gray-100">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <span class="text-[9px] font-black uppercase tracking-widest text-gray-400 mt-2">Ops</span>
            </div>
            <h3 class="text-4xl font-black mb-1 tracking-tight text-[#050510]">{{ $countDocs }}</h3>
            <p class="text-[8px] font-black uppercase tracking-[0.3em] text-gray-400">Dossiers Édités</p>
        </div>

        <div class="p-8 rounded-[2.5rem] bg-white border border-gray-100 shadow-sm hover:shadow-xl transition-all group">
            <div class="flex justify-between items-start mb-8">
                <div class="w-10 h-10 rounded-2xl bg-green-50 flex items-center justify-center border border-green-100">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <span class="text-[9px] font-black uppercase tracking-widest text-gray-400 mt-2">Treasury</span>
            </div>
            <h3 class="text-4xl font-black mb-1 tracking-tight text-green-600">{{ $countSent > 0 ? round(($countRead / $countSent) * 100) : 0 }}%</h3>
            <p class="text-[8px] font-black uppercase tracking-[0.3em] text-gray-400">Taux Engagement</p>
        </div>
    </div>

    <!-- Charts & Intelligence -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <!-- Revenue Evolution -->
        <div class="p-10 rounded-[4rem] bg-white border border-gray-100 shadow-sm relative overflow-hidden">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h3 class="text-xl font-black text-[#050510]">Performance Mensuelle</h3>
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-1">Évolution du CA consolidé</p>
                </div>
                <div class="px-5 py-2.5 bg-gray-50 rounded-full text-[9px] font-black uppercase tracking-widest text-gray-400 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-brand-500 rounded-full animate-pulse"></span> Temps Réel
                </div>
            </div>
            <div class="h-[300px]">
                <canvas id="evolutionChart"></canvas>
            </div>
        </div>

        <!-- Budget & Top Clients -->
        <div class="space-y-8">
            <div class="p-10 rounded-[3.5rem] bg-[#050510] text-white shadow-2xl shadow-black/20">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="text-xl font-black">Top Clients <span class="text-brand-500 text-xs">(Val. Vie)</span></h3>
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <div class="space-y-6">
                    @baat($topClients as $tc)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-[10px] font-black border border-white/5">
                                {{ strtoupper(substr($tc['name'], 0, 1)) }}
                            </div>
                            <span class="text-xs font-bold text-gray-400">{{ $tc['name'] }}</span>
                        </div>
                        <span class="text-xs font-black">{{ number_format($tc['value'], 0, ',', ' ') }} <span class="text-[8px] opacity-40 uppercase ml-1">XOF</span></span>
                    </div>
                    <div class="w-full bg-white/5 h-1 rounded-full overflow-hidden">
                        <div class="bg-brand-500 h-full" style="width: {{ $revenus > 0 ? min(100, ($tc['value'] / $revenus) * 300) : 0 }}%"></div>
                    </div>
                    @jeexbaat
                </div>
            </div>

            <div class="p-10 rounded-[3.5rem] bg-white border border-gray-100 shadow-sm flex flex-col justify-center">
                <div class="flex justify-between items-center mb-8 px-2 text-center">
                    <div>
                        <p class="text-[8px] font-black uppercase text-gray-400 mb-1">Encaissements</p>
                        <p class="text-xl font-black text-green-500">{{ number_format($revenus, 0, ',', ' ') }}</p>
                    </div>
                    <div class="h-8 w-px bg-gray-100"></div>
                    <div>
                        <p class="text-[8px] font-black uppercase text-gray-400 mb-1">En Attente</p>
                        <p class="text-xl font-black text-brand-500">{{ number_format($revenus_attente, 0, ',', ' ') }}</p>
                    </div>
                    <div class="h-8 w-px bg-gray-100"></div>
                    <div>
                        <p class="text-[8px] font-black uppercase text-gray-400 mb-1">Dépenses</p>
                        <p class="text-xl font-black text-red-500">{{ number_format($depenses, 0, ',', ' ') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Stream -->
    <div class="p-10 rounded-[4rem] bg-white border border-gray-100 shadow-sm">
        <div class="flex justify-between items-center mb-10">
            <h3 class="text-xl font-black text-[#050510]">Journal d'activité</h3>
            <a href="/documents" class="text-[10px] font-black uppercase tracking-widest text-brand-500 hover:text-brand-600 transition-colors">Tout voir ↗</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-50">
                        <th class="pb-6 text-[9px] font-black uppercase tracking-widest text-gray-300">Référence</th>
                        <th class="pb-6 text-[9px] font-black uppercase tracking-widest text-gray-300">Date d'édition</th>
                        <th class="pb-6 text-[9px] font-black uppercase tracking-widest text-gray-300">État Flux</th>
                        <th class="pb-6 text-right text-[9px] font-black uppercase tracking-widest text-gray-300">Engagement TTC</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @mboloo($recentDocs as $doc)
                    <tr class="group hover:bg-gray-50/50 transition-all">
                        <td class="py-6 pr-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-brand-50 group-hover:text-brand-500 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-black text-[#050510]">{{ $doc->type }}</p>
                                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter">{{ $doc->numero }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-6 text-xs font-bold text-gray-400">{{ date('d M Y', strtotime($doc->date_emission)) }}</td>
                        <td class="py-6">
                            <div class="flex items-center gap-3">
                                <span class="px-4 py-1.5 rounded-full text-[8px] font-black uppercase tracking-[0.2em] {{ $doc->statut === 'paye' ? 'bg-green-100 text-green-600' : ($doc->statut === 'brouillon' ? 'bg-gray-100 text-gray-500' : 'bg-brand-100 text-brand-600') }}">
                                    {{ $doc->statut }}
                                </span>
                                @ndax($doc->is_read)
                                <div class="bg-brand-500/10 p-1.5 rounded-full" title="Consulté par le client">
                                    <svg class="w-3 h-3 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </div>
                                @jeexndax
                            </div>
                        </td>
                        <td class="py-6 text-right font-black text-sm text-[#050510]">{{ number_format($doc->total_ttc, 0, ',', ' ') }} <span class="text-[10px] text-gray-300 font-normal">XOF</span></td>
                    </tr>
                    @jeexmboloo
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Chart Excellence : Évolution Mensuelle
const ctx2 = document.getElementById('evolutionChart').getContext('2d');
const gradient = ctx2.createLinearGradient(0, 0, 0, 300);
gradient.addColorStop(0, 'rgba(139, 92, 246, 0.4)');
gradient.addColorStop(1, 'rgba(139, 92, 246, 0)');

new Chart(ctx2, {
    type: 'line',
    data: {
        labels: @json($revenueEvolution['labels']),
        datasets: [{
            label: 'Chiffre d\'Affaires',
            data: @json($revenueEvolution['values']),
            borderColor: '#8b5cf6',
            borderWidth: 4,
            pointBackgroundColor: '#fff',
            pointBorderColor: '#8b5cf6',
            pointBorderWidth: 3,
            pointRadius: 6,
            pointHoverRadius: 8,
            tension: 0.4,
            fill: true,
            backgroundColor: gradient,
        }]
    },
    options: {
        performance: { mode: 'active' },
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: { 
                grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                ticks: { font: { size: 9, weight: 'bold' }, color: '#9ca3af', callback: v => v >= 1000 ? (v/1000) + 'k' : v }
            },
            x: { 
                grid: { display: false },
                ticks: { font: { size: 9, weight: 'bold' }, color: '#9ca3af' }
            }
        },
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#050510',
                padding: 15,
                titleFont: { size: 11, weight: 'bold' },
                bodyFont: { size: 12 },
                displayColors: false,
                callbacks: {
                    label: (c) => ' ' + c.formattedValue + ' XOF'
                }
            }
        }
    }
});
</script>
@jeexdef