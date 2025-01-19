<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // Import this class

class ImportUsersFromCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from a CSV file';
    

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = storage_path('app/imports/users.csv'); // Adjust file path if necessary
        $passwordLogFile = storage_path('app/imports/passwords_log.txt'); // File to store raw passwords

        if (!file_exists($filePath)) {
            $this->error('File not found!');
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $headers = array_map('trim', $data[0]); // First row as column names
        unset($data[0]); // Remove header row

        $passwordLog = fopen($passwordLogFile, 'w'); // Open the log file for writing

        foreach ($data as $index => $row) {
            if (count($headers) !== count($row)) {
                $this->error("Row $index has a mismatch: Headers count = " . count($headers) . ", Row count = " . count($row));
                $this->error("Row data: " . json_encode($row));
                continue; // Skip this row for now
            }

            $row = array_combine($headers, $row);

            // Apply default values for missing fields
            $row['Name'] = $row['Name'] ?? 'Unknown';
            $row['Gender'] = $row['Gender'] ?? 'other'; // Default to "other"
            $row['1st Point of Contact'] = $row['1st Point of Contact'] ?? null;
            $row['2nd Point of Contact (Strategic Investment Analyst)'] = $row['2nd Point of Contact (Strategic Investment Analyst)'] ?? null;
            $row['Designation'] = $row['Designation'] ?? 'Unknown';
            $row['Organization'] = $row['Organization'] ?? null;
            $row['Individual / Institutional / Co-members'] = $row['Individual / Institutional / Co-members'] ?? 'Unknown';
            $row['Who signed up'] = $row['Who signed up'] ?? null;
            $row['Nature of Membership'] = $row['Nature of Membership'] ?? 'Unknown';
            $row['Phone/Whatsapp'] = $row['Phone/Whatsapp'] ?? 'Unknown';
            $row['Email'] = $row['Email'] ?? null;
            $row['Joining Date'] = $row['Joining Date'] ?? null;
            $row['Referred'] = strtolower($row['Referred'] ?? 'no') === 'yes' ? true : false;
            $row['Renewed'] = $row['Renewed'] ?? null;
            $row['Last Renewed'] = $row['Last Renewed'] ?? null;
            $row['Owner'] = $row['Owner'] ?? null;
            $row['Invested'] = $row['Invested'] ?? 0.0;
            $row['Revenue Generated for BAN (Commissions & Membership Fees, USD)'] = $row['Revenue Generated for BAN (Commissions & Membership Fees, USD)'] ?? 0.0;
            $row['Notes'] = $row['Notes'] ?? null;
            $row['Status'] = $row['Status'] ?? 'Active';
            $row['Overseas'] = strtolower($row['Overseas'] ?? 'no') === 'x' ? true : false;
            $row['Country/region'] = $row['Country/region'] ?? 'Unknown';

            // Handle email null case
            if (is_null($row['Email'])) {
                $this->warn("Row missing email: " . json_encode($row));
                $row['Email'] = 'unknown_' . uniqid() . '@example.com'; // Generate a placeholder email
            }

            // Generate a unique password
            $rawPassword = Str::random(12); // Generate a random 12-character password
            $hashedPassword = bcrypt($rawPassword); // Hash the password for storage
            
            // Insert or update user data in the database
            $user = User::updateOrCreate(
                ['email' => $row['Email']], // Match by unique email
                [
                    'name' => $row['Name'],
                    'password' => $hashedPassword, // Store the hashed password
                    'gender' => strtolower($row['Gender']),
                    'primary_contact' => $row['1st Point of Contact'],
                    'secondary_contact' => $row['2nd Point of Contact (Strategic Investment Analyst)'],
                    'designation' => $row['Designation'],
                    'company_name' => $row['Organization'],
                    // 'used_by' => $row['Individual / Institutional / Co-members'],
                    'registered_by' => $row['Who signed up'],
                    'level' => $row['Nature of Membership'],
                    'phone' => $row['Phone/Whatsapp'],
                    'was_referred' => $row['Referred'],
                    'renewed' => $row['Renewed'],
                    'last_renewed_at' => $row['Last Renewed'],
                    'account_owner' => $row['Owner'],
                    'total_invested' => $row['Invested'],
                    'revenue_generated' => $row['Revenue Generated for BAN (Commissions & Membership Fees, USD)'],
                    'notes' => $row['Notes'],
                    'is_overseas' => $row['Overseas'],
                    'primary_country' => $row['Country/region'],
                ]
            );

            // Log the raw password and corresponding user ID to the file
            fwrite($passwordLog, "User ID: {$user->id}, Email: {$row['Email']}, Password: {$rawPassword}" . PHP_EOL);

            $this->info('Processed row: ' . json_encode($row));
        }

        fclose($passwordLog); // Close the log file
        $this->info('Import completed successfully!');
        $this->info('Passwords have been logged to: ' . $passwordLogFile);
    }

    
}
