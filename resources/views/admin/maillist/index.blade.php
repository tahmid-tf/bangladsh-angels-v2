@extends('layouts.admin')
@section('page_title','Email List | Dashboard')
@section('page_content')
<div class="max-w-5xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Member Emails List ({{count($validEmails)}})</h2>

    <form id="emailForm" action="{{route('mail.send')}}" method="POST">
        @csrf
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 text-left text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">
                            <input type="checkbox" id="select-all" class="cursor-pointer">
                        </th>
                        <th class="px-4 py-2">Member Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($validEmails as $user)
                        @foreach ($user->emails as $email)
                            <tr class="border-t">
                                <td class="px-4 py-2">
                                    <input type="checkbox" name="emails[]" value="{{ $email }}" class="email-checkbox cursor-pointer">
                                </td>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $email }}</td>
                                <td class="px-4 py-2">{{ $user->phone ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold">
                Send Email
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('select-all').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.email-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
@endsection