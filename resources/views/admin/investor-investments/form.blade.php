@php
    $selectedInvestorId = old('investor_id', $investorInvestment->investor_id);
    $selectedDealId = old('deal_id', $investorInvestment->deal_id);
@endphp

@if ($errors->any())
    <div role="alert" class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
        <p class="font-bold">Please correct the highlighted fields.</p>
        <ul class="mt-2 list-disc pl-5">
            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ $action }}" class="bg-white rounded-xl shadow p-4 md:p-6" id="investment-form">
    @csrf
    @if ($method !== 'POST') @method($method) @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="relative">
            <label for="investor_name" class="block text-sm font-semibold text-gray-700 mb-1">Investor name <span class="text-red-500">*</span></label>
            <input id="investor_name" name="investor_name" type="text" value="{{ old('investor_name', $investorInvestment->investor_name) }}" autocomplete="off" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-controls="investor-name-suggestions" placeholder="Start typing an investor name" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
            <div id="investor-name-suggestions" class="absolute z-20 mt-1 hidden max-h-64 w-full overflow-auto rounded-lg border border-gray-200 bg-white p-1 shadow-lg" role="listbox"></div>
        </div>

        <div class="relative">
            <label for="investor_email" class="block text-sm font-semibold text-gray-700 mb-1">Investor email <span class="text-red-500">*</span></label>
            <input id="investor_email" name="investor_email" type="email" value="{{ old('investor_email', $investorInvestment->investor_email) }}" autocomplete="off" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-controls="investor-email-suggestions" placeholder="Start typing an investor email" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
            <div id="investor-email-suggestions" class="absolute z-20 mt-1 hidden max-h-64 w-full overflow-auto rounded-lg border border-gray-200 bg-white p-1 shadow-lg" role="listbox"></div>
        </div>

        <input id="investor_id" name="investor_id" type="hidden" value="{{ $selectedInvestorId }}">

        <div class="relative md:col-span-2">
            <label for="startup_name" class="block text-sm font-semibold text-gray-700 mb-1">Startup <span class="text-red-500">*</span></label>
            <input id="startup_name" name="startup_name" type="text" value="{{ old('startup_name', $investorInvestment->startup_name) }}" autocomplete="off" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-controls="startup-suggestions" placeholder="Start typing a startup name" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]">
            <div id="startup-suggestions" class="absolute z-20 mt-1 hidden max-h-64 w-full overflow-auto rounded-lg border border-gray-200 bg-white p-1 shadow-lg" role="listbox"></div>
            <input id="deal_id" name="deal_id" type="hidden" value="{{ $selectedDealId }}">
        </div>

        <div>
            <label for="amount" class="block text-sm font-semibold text-gray-700 mb-1">Amount invested <span class="text-red-500">*</span></label>
            <input id="amount" name="amount" type="number" min="0.0001" step="0.0001" value="{{ old('amount', $investorInvestment->amount) }}" placeholder="0.00" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]" required>
        </div>

        <div>
            <label for="currency" class="block text-sm font-semibold text-gray-700 mb-1">Currency <span class="text-red-500">*</span></label>
            <input id="currency" name="currency" list="currency-options" maxlength="3" value="{{ old('currency', $investorInvestment->currency ?: 'BDT') }}" placeholder="BDT" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 uppercase focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]" required>
            <datalist id="currency-options">
                @foreach (['BDT', 'USD', 'EUR', 'GBP', 'SGD', 'INR', 'AED', 'CAD', 'AUD', 'JPY'] as $currency)<option value="{{ $currency }}">@endforeach
            </datalist>
            <p class="mt-1 text-xs text-gray-500">Use a three-letter currency code. Values are never combined across currencies.</p>
        </div>

        <div>
            <label for="completed_at" class="block text-sm font-semibold text-gray-700 mb-1">Investment completed on <span class="text-red-500">*</span></label>
            <input id="completed_at" name="completed_at" type="date" max="{{ now()->toDateString() }}" value="{{ old('completed_at', optional($investorInvestment->completed_at)->format('Y-m-d')) }}" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:ring-2 focus:ring-[#0a5554] focus:border-[#0a5554]" required>
        </div>
    </div>

    <div class="mt-6 flex flex-col-reverse gap-2 border-t border-gray-200 pt-5 sm:flex-row sm:justify-end">
        <a href="{{ route('admin.investor-investments.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200">Cancel</a>
        <button class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-[#0a5554] text-white text-sm font-semibold hover:bg-[#084646]">{{ $submitLabel }}</button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const endpoint = @json(route('admin.investor-investments.suggestions'));
    const investorId = document.getElementById('investor_id');
    const dealId = document.getElementById('deal_id');
    const nameInput = document.getElementById('investor_name');
    const emailInput = document.getElementById('investor_email');

    function setup(input, menu, field, onSelect, onChange) {
        let timer;
        let controller;

        const close = () => {
            menu.classList.add('hidden');
            input.setAttribute('aria-expanded', 'false');
        };

        const load = () => {
            if (controller) controller.abort();
            controller = new AbortController();
            const url = new URL(endpoint, window.location.origin);
            url.searchParams.set('field', field);
            url.searchParams.set('q', input.value.trim());

            fetch(url, { headers: { Accept: 'application/json' }, signal: controller.signal })
                .then(response => response.ok ? response.json() : Promise.reject())
                .then(({ data }) => {
                    menu.replaceChildren();
                    data.forEach(item => {
                        const button = document.createElement('button');
                        button.type = 'button';
                        button.className = 'block w-full rounded-lg px-3 py-2.5 text-left text-sm hover:bg-emerald-50 focus:bg-emerald-50 focus:outline-none';
                        button.setAttribute('role', 'option');
                        button.innerHTML = field === 'startup'
                            ? `<strong class="text-gray-900"></strong>`
                            : `<strong class="block text-gray-900"></strong><span class="block text-xs text-gray-500"></span>`;
                        button.querySelector('strong').textContent = field === 'email' ? item.email : (item.name || item.title);
                        const detail = button.querySelector('span');
                        if (detail) detail.textContent = field === 'email' ? item.name : item.email;
                        button.addEventListener('click', () => { onSelect(item); close(); });
                        menu.appendChild(button);
                    });
                    menu.classList.toggle('hidden', data.length === 0);
                    input.setAttribute('aria-expanded', String(data.length > 0));
                })
                .catch(error => { if (error?.name !== 'AbortError') close(); });
        };

        input.addEventListener('input', () => {
            onChange();
            clearTimeout(timer);
            timer = setTimeout(load, 180);
        });
        input.addEventListener('focus', load);
        input.addEventListener('keydown', event => { if (event.key === 'Escape') close(); });
        document.addEventListener('click', event => { if (!menu.contains(event.target) && event.target !== input) close(); });
    }

    const chooseInvestor = item => {
        investorId.value = item.id;
        nameInput.value = item.name;
        emailInput.value = item.email;
    };

    setup(nameInput, document.getElementById('investor-name-suggestions'), 'name', chooseInvestor, () => investorId.value = '');
    setup(emailInput, document.getElementById('investor-email-suggestions'), 'email', chooseInvestor, () => investorId.value = '');
    setup(document.getElementById('startup_name'), document.getElementById('startup-suggestions'), 'startup', item => {
        dealId.value = item.id;
        document.getElementById('startup_name').value = item.title;
    }, () => dealId.value = '');

    document.getElementById('currency').addEventListener('input', event => event.target.value = event.target.value.toUpperCase());
});
</script>
