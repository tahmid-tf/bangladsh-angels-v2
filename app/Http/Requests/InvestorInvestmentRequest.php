<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvestorInvestmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->isAdmin();
    }

    public function rules(): array
    {
        return [
            'investor_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')->where(fn ($query) => $query->where('role', 'investor')),
            ],
            'deal_id' => ['required', 'integer', Rule::exists('deals', 'id')],
            'amount' => ['required', 'numeric', 'gt:0', 'decimal:0,4'],
            'currency' => ['required', 'string', 'size:3', 'regex:/^[A-Za-z]{3}$/'],
            'completed_at' => ['required', 'date', 'before_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'investor_id.required' => 'Choose an investor from the suggestions.',
            'investor_id.exists' => 'Choose a valid investor account from the suggestions.',
            'deal_id.required' => 'Choose a startup from the suggestions.',
            'deal_id.exists' => 'Choose a valid startup from the suggestions.',
            'currency.regex' => 'Enter a three-letter currency code such as BDT or USD.',
            'completed_at.before_or_equal' => 'The completion date cannot be in the future.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'currency' => strtoupper(trim((string) $this->input('currency'))),
        ]);
    }
}
