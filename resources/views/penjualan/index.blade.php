@extends('layouts.app')

@section('title', 'NusaKasir - Penjualan')

@section('content')
<!-- Bagian Judul & Tombol Tambah -->
<div class="flex justify-between items-end mb-8">
    <div>
        <div class="text-[11px] font-bold text-emerald-600 tracking-wider mb-1 uppercase">Ringkasan Toko</div>
        <h1 class="text-3xl font-bold text-slate-900 mb-1">Penjualan</h1>
        <p class="text-sm text-slate-500">Pantau dan kelola semua transaksi penjualan tokomu.</p>
    </div>
    <a href="{{ route('penjualan.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors flex items-center gap-2 shadow-sm shadow-emerald-200">
        <span class="text-lg leading-none">+</span> Tambah transaksi
    </a>
</div>

<!-- Kartu Ringkasan (Statistik) -->
<div class="grid grid-cols-4 gap-5 mb-8">
    <!-- Total Transaksi -->
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex justify-between items-start mb-4">
            <div class="text-sm font-medium text-slate-500">Total transaksi</div>
            <div class="p-2 bg-slate-50 border border-slate-100 rounded-lg"><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></div>
        </div>
        <div class="text-3xl font-bold text-slate-900 mb-1">{{ $penjualan->count() }}</div>
        <div class="text-[11px] text-slate-500">Semua transaksi tercatat</div>
    </div>
    <!-- Transaksi Selesai -->
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex justify-between items-start mb-4">
            <div class="text-sm font-medium text-slate-500">Transaksi selesai</div>
            <div class="p-2 bg-emerald-50 border border-emerald-100 rounded-lg"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
        </div>
        <div class="text-3xl font-bold text-slate-900 mb-1">{{ $penjualan->where('status', 'Selesai')->count() }}</div>
        <div class="text-[11px] text-slate-500">Berhasil diselesaikan</div>
    </div>
    <!-- Menunggu Pembayaran -->
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex justify-between items-start mb-4">
            <div class="text-sm font-medium text-slate-500">Menunggu pembayaran</div>
            <div class="p-2 bg-orange-50 border border-orange-100 rounded-lg"><svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
        </div>
        <div class="text-3xl font-bold text-slate-900 mb-1">{{ $penjualan->where('status', 'Pending')->count() }}</div>
        <div class="text-[11px] text-slate-500">Transaksi berstatus pending</div>
    </div>
    <!-- Total Omzet -->
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex justify-between items-start mb-4">
            <div class="text-sm font-medium text-slate-500">Total omzet</div>
            <div class="p-2 bg-emerald-50 border border-emerald-100 rounded-lg"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg></div>
        </div>
        <div class="text-xl font-bold text-slate-900 mb-1 mt-2">Rp {{ number_format((float) $totalomzet, 0, ',', '.') }}</div>
        <div class="text-[11px] text-slate-500 mt-1.5">Dari transaksi yang selesai</div>
    </div>
</div>

<!-- Tabel Transaksi -->
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    
    <!-- Toolbar Tabel (Pencarian & Filter dummy) -->
    <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-white">
        <div>
            <h2 class="text-base font-bold text-slate-900">Semua transaksi</h2>
            <p class="text-[11px] text-slate-500 mt-0.5">Daftar transaksi penjualan yang tercatat.</p>
        </div>
        <div class="flex gap-2">
            <div class="relative">
                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Cari transaksi..." class="pl-9 pr-4 py-2 border border-slate-200 rounded-lg text-sm w-56 focus:outline-none focus:border-emerald-500">
            </div>
            <select class="border border-slate-200 rounded-lg px-4 py-2 text-sm text-slate-700 bg-white focus:outline-none">
                <option>Semua status</option>
            </select>
            <button class="bg-slate-50 border border-slate-200 hover:bg-slate-100 text-slate-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Terapkan</button>
        </div>
    </div>

    <!-- Data Tabel -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-200 text-[10px] uppercase tracking-wider text-slate-400 font-semibold bg-white">
                    <th class="px-6 py-4">Transaksi</th>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Produk</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($penjualan as $item)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800 text-xs">{{ $item->kode_transaksi }}</div>
                            <div class="text-[11px] text-slate-500 mt-1">{{ $item->tanggal->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800 text-xs">{{ $item->nama_pelanggan }}</div>
                            <div class="text-[11px] text-slate-500 mt-1">Pelanggan</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded bg-slate-50 border border-slate-200 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-800 text-xs">{{ $item->nama_produk }}</div>
                                    <div class="text-[11px] text-slate-500 mt-1">{{ $item->jumlah }} unit</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800 text-xs">Rp {{ number_format((float) $item->total, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($item->status == 'Selesai')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600 border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Selesai
                                </span>
                            @elseif($item->status == 'Pending')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium bg-orange-50 text-orange-600 border border-orange-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Pending
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium bg-red-50 text-red-600 border border-red-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Batal
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('penjualan.show', $item) }}" class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded transition-colors" title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                <a href="{{ route('penjualan.edit', $item) }}" class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('penjualan.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-slate-300 mb-2"><svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg></div>
                            <div class="text-slate-500 text-sm font-medium">Belum ada transaksi tercatat.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection