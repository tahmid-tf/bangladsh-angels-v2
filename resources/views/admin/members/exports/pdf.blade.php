<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Members Export</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #111827; }
        h1 { margin: 0 0 8px 0; font-size: 18px; }
        .meta { margin-bottom: 12px; color: #4b5563; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #d1d5db; padding: 6px; text-align: left; vertical-align: top; }
        th { background: #f3f4f6; font-weight: 700; }
    </style>
</head>
<body>
    <h1>BAN Members Export</h1>
    <div class="meta">
        Generated at: {{ $generatedAt->format('M j, Y g:i A') }} | Total records: {{ $users->count() }}<br>
        Filters — Account scope: {{ ucfirst($accountScope ?? 'all') }}, Approval scope: {{ ucfirst($approvalScope ?? 'all') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Tier</th>
                <th>Payment</th>
                <th>Role</th>
                <th>Approved</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->account_status }}</td>
                    <td>{{ $user->payment_status }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->is_approved ? 'Yes' : 'No' }}</td>
                    <td>{{ optional($user->created_at)->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
