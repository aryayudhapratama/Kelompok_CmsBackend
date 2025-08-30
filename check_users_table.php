<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking users table structure...\n";

// Get column listing
$columns = DB::getSchemaBuilder()->getColumnListing('users');
echo "Columns in users table: " . implode(', ', $columns) . "\n\n";

// Check if 'role' column exists
if (in_array('role', $columns)) {
    echo "'role' column exists in users table\n";
    
    // Check sample data
    $usersWithRole = DB::table('users')->select('id', 'name', 'role', 'role_id')->limit(3)->get();
    echo "Sample user data:\n";
    foreach ($usersWithRole as $user) {
        echo "- ID: {$user->id}, Name: {$user->name}, Role: {$user->role}, Role ID: {$user->role_id}\n";
    }
} else {
    echo "'role' column does NOT exist in users table\n";
}

// Check foreign key constraint
$foreignKeys = DB::select("
    SELECT 
        TABLE_NAME, COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
    FROM 
        INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
    WHERE 
        TABLE_NAME = 'users' AND REFERENCED_TABLE_NAME IS NOT NULL
");

echo "\nForeign keys in users table:\n";
if (count($foreignKeys) > 0) {
    foreach ($foreignKeys as $fk) {
        echo "- Column: {$fk->COLUMN_NAME}, References: {$fk->REFERENCED_TABLE_NAME}.{$fk->REFERENCED_COLUMN_NAME}\n";
    }
} else {
    echo "No foreign keys found\n";
}
