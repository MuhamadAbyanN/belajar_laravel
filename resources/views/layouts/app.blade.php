<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NusaKasir')</title>
    
    <!-- Memuat Tailwind CSS & Font Inter -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Mempertahankan CSS lama secara diam-diam agar halaman Tambah & Edit buatan modul sebelumnya tidak rusak */
        .card { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; margin-top: 20px;}
        .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
        label { display: block; font-weight: 600; margin-bottom: 7px; font-size: 14px;}
        input, select, textarea { width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; background: white; font: inherit; }
        .error { color: #dc2626; font-size: 12px; margin-top: 4px; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-slate-800 bg-[#f8f9fa]">
    
    <!-- Sidebar Kiri -->
    <aside class="w-64 bg-[#111827] text-white flex flex-col">
        <div class="h-16 flex items-center px-6 border-b border-slate-700/50">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center font-bold text-lg">N</div>
                <span class="font-bold text-lg">NusaKasir</span>
            </div>
        </div>
        <div class="p-4">
            <div class="text-[11px] font-semibold text-slate-400 mb-4 tracking-wider">MENU UTAMA</div>
            <a href="{{ route('penjualan.index') }}" class="flex items-center gap-3 bg-emerald-500/10 text-emerald-400 px-4 py-3 rounded-xl border border-emerald-500/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                <span class="font-medium text-sm">Transaksi penjualan</span>
            </a>
        </div>
        <div class="mt-auto p-4">
            <div class="bg-slate-800 rounded-xl p-4 border border-slate-700">
                <div class="text-xs font-semibold mb-1 text-slate-200">Praktikum Laravel</div>
                <div class="text-[11px] text-slate-400">CRUD penjualan sederhana</div>
            </div>
        </div>
    </aside>

    <!-- Konten Kanan -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <!-- Navbar Atas -->
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 shrink-0">
            <div class="text-sm text-slate-500">
                Aplikasi / <span class="text-slate-800 font-medium">Transaksi penjualan</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <div class="text-sm font-semibold text-slate-800 leading-tight">Admin Toko</div>
                    <div class="text-xs text-slate-500">Pengelola penjualan</div>
                </div>
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center font-bold border border-emerald-100">
                    AT
                </div>
            </div>
        </header>

        <!-- Area Data Utama -->
        <main class="flex-1 overflow-y-auto p-8">
            
            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
            
        </main>
    </div>
</body>
</html>