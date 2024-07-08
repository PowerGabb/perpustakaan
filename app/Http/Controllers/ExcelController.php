<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImportUser; // Sesuaikan dengan nama class import
use App\Imports\ExcelImportBook; // Sesuaikan dengan nama class import
use App\Models\Book;

class ExcelController extends Controller
{
    public function importExcelUser(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
  
            // Validasi file excel
            if ($file->isValid()) {
                try {

                    // Upload file excel
                    Excel::import(new ExcelImportUser, $file);

                    // Berhasil import data
                    
                    
                    return redirect()->back()->with('success', 'Data Excel berhasil diimport!');
                } catch (\Exception $e) {
                    // Gagal import data
                    return redirect()->back()->with('error', $e->getMessage());
                }
            } else {
                // File tidak valid
                return redirect()->back()->with('error', 'File Excel tidak valid!');
            }
        } else {
            // Tidak ada file yang diupload
            return redirect()->back()->with('error', 'Silakan pilih file Excel untuk diimport!');
        }
    }
    public function importExcelBook(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Validasi file excel
            if ($file->isValid()) {
                try {
                    

                    
                    Excel::import(new ExcelImportBook, $file);
                    // Berhasil import data
                    $data = Book::whereNull('title')->get();
                    foreach ($data as $value) {
                        $value->delete();
                    }
                    return redirect()->back()->with('success', 'Data Excel berhasil diimport!');
                } catch (\Exception $e) {
                    // Gagal import data
                    return redirect()->back()->with('error', $e->getMessage());
                }
            } else {
                // File tidak valid
                return redirect()->back()->with('error', 'File Excel tidak valid!');
            }
        } else {
            // Tidak ada file yang diupload
            return redirect()->back()->with('error', 'Silakan pilih file Excel untuk diimport!');
        }
    }
}
