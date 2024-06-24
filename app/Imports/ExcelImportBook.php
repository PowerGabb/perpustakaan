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

        // dd($row);
        $data = new Book;

        $data->title = $row['judul'];
        $data->book_code = $row['kode_buku'];
        $data->description = $row['description'];
        $data->jumlah = $row['jumlah'];
        // $data->author_id = $row['email'];
        // $data->rak_id = $row['phone'];
        // $data->publisher_id = $row['address'];
        $data->save();
        return $data;
    }

    public function rules(): array
    {
        return [
            'jumlah' => 'required',
        ];
    }
}
