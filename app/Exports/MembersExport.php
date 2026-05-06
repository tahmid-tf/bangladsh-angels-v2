<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public function collection()
    {
        return User::query()
            ->orderBy('id')
            ->get([
                'id',
                'name',
                'email',
                'phone',
                'gender',
                'company_name',
                'designation',
                'primary_country',
                'account_status',
                'payment_status',
                'role',
                'is_approved',
                'created_at',
                'updated_at',
            ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Gender',
            'Company Name',
            'Designation',
            'Primary Country',
            'Account Status',
            'Payment Status',
            'Role',
            'Is Approved',
            'Created At',
            'Updated At',
        ];
    }
}
