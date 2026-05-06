@extends('layouts.admin')
@section('page_title', 'Email Campaigns | Dashboard')
@section('page_content')
<section class="container mx-auto p-4 md:p-6">
    <div class="bg-white rounded-xl shadow p-4 md:p-5 mb-5">
        <h1 class="text-lg md:text-xl font-bold text-gray-900">Email Campaign Manager</h1>
        <p class="text-sm text-gray-600 mt-1">Filter recipients, compose campaigns, run a test send, and then launch to selected contacts.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Users matched</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['users_considered'] }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Reachable contacts</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['reachable_contacts'] }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Email addresses</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_addresses'] }}</p>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.mail') }}" class="bg-white rounded-xl shadow p-4 md:p-5 mb-5">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-3">
            <div class="xl:col-span-2">
                <label for="search" class="block text-xs font-semibold text-gray-600 mb-1">Search</label>
                <input id="search" name="search" type="text" value="{{ $filters['search'] }}" placeholder="Name, email, phone, company" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label for="account_status" class="block text-xs font-semibold text-gray-600 mb-1">Account tier</label>
                <select id="account_status" name="account_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm">
                    <option value="">All</option>
                    <option value="free" @selected($filters['account_status'] === 'free')>Free</option>
                    <option value="core" @selected($filters['account_status'] === 'core')>Core</option>
                    <option value="advanced" @selected($filters['account_status'] === 'advanced')>Advanced</option>
                    <option value="institutional" @selected($filters['account_status'] === 'institutional')>Institutional</option>
                </select>
            </div>
            <div>
                <label for="payment_status" class="block text-xs font-semibold text-gray-600 mb-1">Payment</label>
                <select id="payment_status" name="payment_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm">
                    <option value="">All</option>
                    <option value="paid" @selected($filters['payment_status'] === 'paid')>Paid</option>
                    <option value="due" @selected($filters['payment_status'] === 'due')>Due</option>
                    <option value="free" @selected($filters['payment_status'] === 'free')>Non-payable</option>
                </select>
            </div>
            <div>
                <label for="approval" class="block text-xs font-semibold text-gray-600 mb-1">Approval</label>
                <select id="approval" name="approval" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm">
                    <option value="">All</option>
                    <option value="approved" @selected($filters['approval'] === 'approved')>Approved</option>
                    <option value="pending" @selected($filters['approval'] === 'pending')>Pending</option>
                </select>
            </div>
            <div>
                <label for="verified" class="block text-xs font-semibold text-gray-600 mb-1">Email verification</label>
                <select id="verified" name="verified" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm">
                    <option value="">All</option>
                    <option value="verified" @selected($filters['verified'] === 'verified')>Verified</option>
                    <option value="unverified" @selected($filters['verified'] === 'unverified')>Unverified</option>
                </select>
            </div>
        </div>
        <div class="mt-4 flex flex-wrap gap-2">
            <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-[#0a5554] text-white text-sm font-semibold hover:bg-[#084646]">Apply audience filters</button>
            <a href="{{ route('admin.mail') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200">Reset</a>
        </div>
    </form>

    @if (session('success'))
        <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="emailForm" action="{{ route('mail.send') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div class="bg-white rounded-xl shadow p-4 md:p-5">
            <h2 class="text-base font-semibold text-gray-900 mb-3">Compose Campaign</h2>
            <div class="space-y-3">
                <div>
                    <label for="subject" class="block text-xs font-semibold text-gray-600 mb-1">Email subject</label>
                    <input id="subject" name="subject" type="text" value="{{ old('subject') }}" maxlength="255" required class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm" placeholder="Subject line for this campaign">
                </div>
                <div>
                    <label for="message" class="block text-xs font-semibold text-gray-600 mb-1">Email message</label>
                    <div class="border border-gray-300 rounded-lg overflow-hidden">
                        <div class="flex flex-wrap items-center gap-2 p-2 border-b border-gray-200 bg-gray-50">
                            <button type="button" data-cmd="bold" class="px-2 py-1 text-xs font-semibold rounded bg-white border border-gray-200">Bold</button>
                            <button type="button" data-cmd="italic" class="px-2 py-1 text-xs font-semibold rounded bg-white border border-gray-200">Italic</button>
                            <button type="button" data-cmd="underline" class="px-2 py-1 text-xs font-semibold rounded bg-white border border-gray-200">Underline</button>
                            <button type="button" data-cmd="insertUnorderedList" class="px-2 py-1 text-xs font-semibold rounded bg-white border border-gray-200">Bullet List</button>
                            <button type="button" data-cmd="formatBlock" data-value="h3" class="px-2 py-1 text-xs font-semibold rounded bg-white border border-gray-200">Heading</button>
                            <button type="button" data-cmd="createLink" class="px-2 py-1 text-xs font-semibold rounded bg-white border border-gray-200">Link</button>
                        </div>
                        <div id="message-editor" contenteditable="true" class="min-h-[220px] p-3 text-sm text-gray-800 focus:outline-none">{!! old('message_html', old('message')) !!}</div>
                    </div>
                    <textarea id="message" name="message" rows="4" maxlength="50000" class="hidden">{{ old('message') }}</textarea>
                    <input type="hidden" id="message_html" name="message_html" value="{{ old('message_html') }}">
                    <p class="mt-1 text-xs text-gray-500">Use the editor for rich formatting. Plain text is supported too.</p>
                </div>
                <div>
                    <label for="campaign_images" class="block text-xs font-semibold text-gray-600 mb-1">Campaign images (optional)</label>
                    <input id="campaign_images" name="campaign_images[]" type="file" accept="image/*" multiple class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-white">
                    <p class="mt-1 text-xs text-gray-500">Upload up to multiple images. They will be included in the email content.</p>
                    @php
                        $draftImageIds = collect(old('draft_image_ids', []))
                            ->map(fn ($id) => (int) $id)
                            ->filter(fn ($id) => $id > 0)
                            ->values();
                        $draftImages = $draftImageIds->isNotEmpty()
                            ? auth()->user()->getMedia('mail_campaign_images_draft')->whereIn('id', $draftImageIds->all())
                            : collect();
                    @endphp
                    @if ($draftImages->isNotEmpty())
                        <div class="mt-3">
                            <p class="text-xs font-semibold text-gray-600 mb-2">Retained attachments from previous attempt</p>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($draftImages as $image)
                                    <div class="flex items-start gap-2 rounded-lg border border-gray-200 bg-gray-50 p-2">
                                        <img src="{{ $image->getUrl() }}" alt="Retained campaign image" class="h-16 w-16 rounded object-cover border border-gray-200">
                                        <div class="text-xs text-gray-600">
                                            <label class="inline-flex items-center gap-1">
                                                <input type="checkbox" name="draft_image_ids[]" value="{{ $image->id }}" checked>
                                                Keep
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <h2 class="text-base font-semibold text-gray-900">Recipients</h2>
                <span class="text-xs text-gray-600"><span id="selected-count">0</span> selected</span>
            </div>
            <div class="overflow-x-auto max-h-[55vh] overflow-y-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">
                        <tr>
                            <th class="px-4 py-2">
                                <input type="checkbox" id="select-all" class="cursor-pointer">
                            </th>
                            <th class="px-4 py-2 font-semibold text-gray-700">Member</th>
                            <th class="px-4 py-2 font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-2 font-semibold text-gray-700">Phone</th>
                            <th class="px-4 py-2 font-semibold text-gray-700">Tier</th>
                            <th class="px-4 py-2 font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($validEmails as $user)
                            @foreach ($user->emails as $email)
                                <tr>
                                    <td class="px-4 py-2">
                                        <input type="checkbox" name="emails[]" value="{{ $email }}" class="email-checkbox cursor-pointer" @checked(in_array($email, old('emails', []), true))>
                                    </td>
                                    <td class="px-4 py-2 text-gray-900">{{ $user->name }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $email }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $user->phone ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ ucfirst($user->account_status ?: 'unknown') }}</td>
                                    <td class="px-4 py-2">
                                        @if ($user->is_approved)
                                            <span class="px-2 py-0.5 rounded-full text-xs bg-green-100 text-green-700">Approved</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full text-xs bg-amber-100 text-amber-700">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-600">No recipients match the selected filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4 md:p-5">
            <h2 class="text-base font-semibold text-gray-900 mb-3">Send Options</h2>
            <div class="flex flex-col md:flex-row md:items-end gap-3">
                <div class="flex-1">
                    <label for="preview_email" class="block text-xs font-semibold text-gray-600 mb-1">Test recipient (optional)</label>
                    <input id="preview_email" name="preview_email" type="email" value="{{ old('preview_email', auth()->user()->email) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm" placeholder="name@example.com">
                </div>
                <button type="submit" name="send_mode" value="test" class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 text-gray-800 text-sm font-semibold hover:bg-gray-200">
                    Send Test
                </button>
                <button type="submit" name="send_mode" value="live" class="inline-flex items-center px-4 py-2 rounded-lg bg-[#0a5554] text-white text-sm font-semibold hover:bg-[#084646]">
                    Send Campaign
                </button>
            </div>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow p-4 md:p-5 mt-5">
        <h2 class="text-base font-semibold text-gray-900 mb-3">Campaign Send History</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-3 py-2 font-semibold text-gray-700">Subject</th>
                        <th class="px-3 py-2 font-semibold text-gray-700">Sender</th>
                        <th class="px-3 py-2 font-semibold text-gray-700">Mode</th>
                        <th class="px-3 py-2 font-semibold text-gray-700">Recipients</th>
                        <th class="px-3 py-2 font-semibold text-gray-700">Sent At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($campaignLogs as $log)
                        <tr>
                            <td class="px-3 py-2 text-gray-900">{{ $log->subject }}</td>
                            <td class="px-3 py-2 text-gray-700">{{ $log->sender?->name ?? 'System' }}</td>
                            <td class="px-3 py-2 text-gray-700 uppercase">{{ $log->send_mode }}</td>
                            <td class="px-3 py-2 text-gray-700">{{ $log->recipients_count }}</td>
                            <td class="px-3 py-2 text-gray-700">{{ optional($log->sent_at)->format('M j, Y g:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-6 text-center text-gray-500">No campaign sends logged yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.email-checkbox');
    const selectedCount = document.getElementById('selected-count');

    function refreshSelectedCount() {
        const totalSelected = document.querySelectorAll('.email-checkbox:checked').length;
        selectedCount.textContent = String(totalSelected);
    }

    if (selectAll) {
        selectAll.addEventListener('click', function () {
            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAll.checked;
            });
            refreshSelectedCount();
        });
    }

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', refreshSelectedCount);
    });

    const editor = document.getElementById('message-editor');
    const messageHtmlInput = document.getElementById('message_html');
    const emailForm = document.getElementById('emailForm');
    const editorButtons = document.querySelectorAll('[data-cmd]');

    function syncEditorHtml() {
        if (!editor || !messageHtmlInput) return;
        messageHtmlInput.value = editor.innerHTML.trim();
    }

    editorButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const cmd = button.getAttribute('data-cmd');
            const value = button.getAttribute('data-value');
            if (!cmd) return;

            if (cmd === 'createLink') {
                const url = window.prompt('Enter URL');
                if (!url) return;
                document.execCommand(cmd, false, url);
            } else {
                document.execCommand(cmd, false, value || null);
            }

            syncEditorHtml();
        });
    });

    if (editor) {
        editor.addEventListener('input', syncEditorHtml);
    }

    if (emailForm) {
        emailForm.addEventListener('submit', syncEditorHtml);
    }

    syncEditorHtml();
    refreshSelectedCount();
</script>
@endsection