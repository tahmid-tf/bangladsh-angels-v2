<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    public function __construct(
        private readonly string $accountScope = 'all',
        private readonly string $approvalScope = 'all'
    ) {}

    public function query(): Builder
    {
        return User::query()
            ->when($this->accountScope === 'active', fn ($query) => $query->where('account_status', '!=', 'free'))
            ->when($this->accountScope === 'inactive', fn ($query) => $query->where('account_status', 'free'))
            ->when($this->approvalScope === 'approved', fn ($query) => $query->where('is_approved', true))
            ->when($this->approvalScope === 'pending', fn ($query) => $query->where('is_approved', false))
            ->orderBy('id')
            ->select([
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
