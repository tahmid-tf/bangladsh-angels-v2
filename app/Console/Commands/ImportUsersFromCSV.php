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
        $skippedRowsFile = storage_path('app/imports/skipped_rows_log.txt'); // File to store skipped rows

        if (!file_exists($filePath)) {
            $this->error('File not found!');
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $headers = array_map('trim', $data[0]); // First row as column names
        unset($data[0]); // Remove header row

        $passwordLog = fopen($passwordLogFile, 'w'); // Open the log file for writing
        $skippedRowsLog = fopen($skippedRowsFile, 'w'); // Open the log file for skipped rows

        foreach ($data as $index => $row) {
            // Ensure the row has the same number of elements as headers
            if (count($row) < count($headers)) {
                // Pad the row with null values
                $row = array_pad($row, count($headers), null);
            } elseif (count($row) > count($headers)) {
                // Truncate the row to match headers if it has extra columns
                $row = array_slice($row, 0, count($headers));
            }

            // Combine headers and row data
            $row = array_combine($headers, $row);

            // Apply default values for all missing keys
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

            // Handle email null case
            if (is_null($row['Email'])) {
                $this->warn("Row missing email: " . json_encode($row));
                fwrite($skippedRowsLog, "Skipped Row (Missing Email): " . json_encode($row) . PHP_EOL);
                continue; // Skip the row
            }

            // Handle boolean and integer fields properly
            $row['Referred'] = filter_var($row['Referred'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0; // Convert to 1 or 0
            $row['Overseas'] = filter_var($row['Overseas'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

            // Generate a unique password
            $rawPassword = Str::random(12); // Generate a random 12-character password
            $hashedPassword = bcrypt($rawPassword); // Hash the password for storage

            // Insert or update user data in the database
            try {
                $user = User::updateOrCreate(
                    ['email' => $row['Email']], // Match by unique email
                    [
                        'name' => $row['Name'],
                        'password' => $hashedPassword, // Store the hashed password
                        'gender' => strtolower($row['Gender']),
                        'primary_contact' => $row['1st Point of Contact'],
                        'secondary_contact' => $row['2nd Point of Contact (Strategic Investment Analyst)'],
                        'designation' => $row['Designation'],
                        'joining_date' => $row['Joining Date'],
                        'company_name' => $row['Organization'],
                        'registered_by' => $row['Who signed up'],
                        'level' => $row['Nature of Membership'],
                        'phone' => $row['Phone/Whatsapp'],
                        'was_referred' => $row['Referred'], // Ensure boolean is set correctly
                        'renewed' => $row['Renewed'],
                        'last_renewed_at' => $row['Last Renewed'],
                        'account_owner' => $row['Owner'],
                        'total_invested' => $row['Invested'],
                        'revenue_generated' => $row['Revenue Generated for BAN (Commissions & Membership Fees, USD)'],
                        'notes' => $row['Notes'],
                        'is_overseas' => $row['Overseas'], // Ensure boolean is set correctly
                        'primary_country' => $row['Country/region'],
                    ]
                );

                // Log the raw password and corresponding user ID to the file
                fwrite($passwordLog, "User ID: {$user->id}, Email: {$row['Email']}, Password: {$rawPassword}" . PHP_EOL);

                $this->info('Processed row: ' . json_encode($row));
            } catch (\Exception $e) {
                $this->error("Error inserting/updating row: " . json_encode($row));
                fwrite($skippedRowsLog, "Skipped Row (Database Error): " . json_encode($row) . PHP_EOL);
                fwrite($skippedRowsLog, "Error: " . $e->getMessage() . PHP_EOL);
            }
        }

        fclose($passwordLog); // Close the log file
        fclose($skippedRowsLog); // Close the skipped rows log file
        $this->info('Import completed successfully!');
        $this->info('Passwords have been logged to: ' . $passwordLogFile);
        $this->info('Skipped rows have been logged to: ' . $skippedRowsFile);
    }





    
}
