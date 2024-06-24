<?php

namespace App\Imports;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ExcelImportUser implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $data = new User;

        $data->name = $row['name'];
        $data->nisn = $row['nisn'];
        $data->class = $row['class'];
        $data->email = $row['email'];
        $data->phone = $row['phone'];

        // Mengatur password default jika kolom password kosong
        $data->password = $row['password'] === '' ? 'siswa' : bcrypt($row['password']);

        $data->address = $row['address'];
        // Mengatur role default sebagai 'siswa' bukan 'admin'
        $data->role = $row['role'] === '' ? 'siswa' : $row['role'];
        $data->save();
        return $data;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
