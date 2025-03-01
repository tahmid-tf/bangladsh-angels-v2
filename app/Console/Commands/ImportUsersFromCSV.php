<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ImportUsersFromCSV extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'import:users';

    /**
     * The console command description.
     */
    protected $description = 'Import users from a CSV file and log passwords.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = storage_path('app/imports/users.csv');
        $passwordLogFile = storage_path('app/imports/passwords_log.txt');
        $skippedRowsFile = storage_path('app/imports/skipped_rows_log.txt');

        if (!file_exists($filePath)) {
            $this->error("❌ CSV file not found at: $filePath");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $headers = array_map('trim', $data[0]);
        unset($data[0]);

        $passwordLog = fopen($passwordLogFile, 'w');
        $skippedRowsLog = fopen($skippedRowsFile, 'w');

        $successCount = 0;
        $skipCount = 0;

        foreach ($data as $index => $row) {
            $row = array_map(fn($item) => trim(preg_replace('/\s+/', ' ', $item)), $row);
            $row = array_pad($row, count($headers), null);
            $row = array_combine($headers, $row);

            // Default values for missing fields
            $defaults = [
                'Name' => 'Unknown',
                'Gender' => 'other',
                '1st Point of Contact' => null,
                '2nd Point of Contact (Strategic Investment Analyst)' => null,
                'Designation' => 'Unknown',
                'Organization' => null,
                'Individual / Institutional / Co-members' => 'Unknown',
                'Who signed up' => null,
                'Nature of Membership' => 'Unknown',
                'Phone/Whatsapp' => 'Unknown',
                'Email' => null,
                'Joining Date' => null,
                'Referred' => false,
                'Renewed' => null,
                'Last Renewed' => null,
                'Owner' => null,
                'Invested' => 0.0,
                'Revenue Generated for BAN (Commissions & Membership Fees, USD)' => 0.0,
                'Notes' => null,
                'Status' => 'Active',
                'Overseas' => false,
                'Country/region' => 'Unknown',
            ];

            $row = array_merge($defaults, $row);

            // Validate email
            if (empty($row['Email']) || !filter_var($row['Email'], FILTER_VALIDATE_EMAIL)) {
                fwrite($skippedRowsLog, "❌ Skipped (Invalid Email): " . json_encode($row) . PHP_EOL);
                $skipCount++;
                continue;
            }

            // Handle multi-line cells and sanitize dates
            $row['Last Renewed'] = $this->parseDate(explode("\n", $row['Last Renewed'])[0], $row['Email']);
            $row['Joining Date'] = $this->parseDate($row['Joining Date'], $row['Email']);

            // Convert boolean fields
            $row['Referred'] = filter_var($row['Referred'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            $row['Overseas'] = filter_var($row['Overseas'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

            // Generate password
            $rawPassword = Str::random(12);
            $hashedPassword = bcrypt($rawPassword);

            try {
                $user = User::updateOrCreate(
                    ['email' => $row['Email']],
                    [
                        'name'               => $row['Name'],
                        'password'           => $hashedPassword,
                        'gender'             => strtolower($row['Gender']),
                        'primary_contact'    => $row['1st Point of Contact'],
                        'secondary_contact'  => $row['2nd Point of Contact (Strategic Investment Analyst)'],
                        'designation'        => $row['Designation'],
                        'joining_date'       => $row['Joining Date'],
                        'company_name'       => $row['Organization'],
                        'registered_by'      => $row['Who signed up'],
                        'level'              => $row['Nature of Membership'],
                        'phone'              => $row['Phone/Whatsapp'],
                        'was_referred'       => $row['Referred'],
                        'renewed'            => $row['Renewed'],
                        'last_renewed_at'    => $row['Last Renewed'],
                        'account_owner'      => $row['Owner'],
                        'total_invested'     => $row['Invested'],
                        'revenue_generated'  => $row['Revenue Generated for BAN (Commissions & Membership Fees, USD)'],
                        'notes'              => $row['Notes'],
                        'is_overseas'        => $row['Overseas'],
                        'primary_country'    => $row['Country/region'],
                    ]
                );

                fwrite($passwordLog, "✅ User ID: {$user->id}, Email: {$row['Email']}, Password: {$rawPassword}" . PHP_EOL);
                $this->info("✅ Successfully imported: {$row['Email']}");
                $successCount++;
            } catch (\Exception $e) {
                fwrite($skippedRowsLog, "❌ Failed: {$row['Email']} - {$e->getMessage()}" . PHP_EOL);
                $this->error("⚠️ Failed to import {$row['Email']}: {$e->getMessage()}");
                $skipCount++;
            }
        }

        fclose($passwordLog);
        fclose($skippedRowsLog);

        $this->info("\n🎉 Import completed successfully!");
        $this->info("✅ Successfully imported: {$successCount} users.");
        $this->info("🚫 Skipped rows: {$skipCount}.");
        $this->info("🔑 Passwords logged at: {$passwordLogFile}");
        $this->info("📜 Skipped rows logged at: {$skippedRowsFile}");
    }

    /**
     * Parse dates safely and standardize to Y-m-d format.
     */
    private function parseDate($date, $email)
    {
        if (empty($date)) {
            return null;
        }

        $formats = ['d/m/y', 'd/m/Y', 'Y-m-d', 'm/d/Y'];

        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat($format, trim($date))->format('Y-m-d');
            } catch (\Exception $e) {
                continue;
            }
        }

        fwrite(fopen(storage_path('app/imports/skipped_rows_log.txt'), 'a'), "⚠️ Invalid Date for {$email}: {$date}\n");
        return null;
    }
}
