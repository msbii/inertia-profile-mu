<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        $query = User::query();

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%");
        }

        $users = $query->get();

        // Transformasi data supaya ada "No"
        return $users->map(function ($user, $index) {
            return [
                'No' => $index + 1,
                'Nama' => $user->name,
                'Email' => $user->email,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Email',
        ];
    }
}
