<?php

namespace App\Imports;

use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ExcelImportBook implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $books = Book::updateOrCreate(
            ['id' => $row['nomor_urut']],
            [
                'title' => $row['judul_buku'],
                'no_inventaris' => $row['nomor_inventaris'],
                'book_code' => $row['klasifikasi_buku'],
                'pengarang' => $row['pengarang'],
                'penerbit' => $row['penerbit'],
                'kota_terbit' => $row['kota_terbit'],
                'edisi' => $row['cetakan_atau_edisi'],
                'publication_year' => $row['tahun_terbit'],
                'rak' => $row['rak'],
                'jumlah_halaman' => $row['jumlah_halaman'],
                'tinggi_buku' => $row['tinggi_buku'],
                'isbn' => $row['isbn'],
                'kategori' => $row['kategori'],
                'sumber' => $row['sumber'],
                'harga' => $row['harga'],
                'keterangan' => $row['keterangan'],
                'jumlah' => $row['jumlah_buku'],
            ]
        );

        return $books;
    }

    public function rules(): array
    {
        
        return [
          
        ];
    }
}

