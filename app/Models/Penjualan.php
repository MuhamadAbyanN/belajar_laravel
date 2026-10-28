<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak menggunakan standar jamak bahasa Inggris (opsional)
    protected $table = 'penjualan';

    // Menentukan kolom mana saja yang boleh diisi secara massal
    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'nama_pelanggan',
        'nama_produk',
        'jumlah',
        'harga_satuan',
        'total',
        'status',
        'catatan',
    ];

    /**
     * Menentukan konversi (casting) tipe data saat diambil atau disimpan ke database.
     */
    protected function casts(): array
    {
        return [
            'tanggal'      => 'date',
            'harga_satuan' => 'decimal:2',
            'total'        => 'decimal:2',
        ];
    }
}