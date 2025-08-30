<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking foreign keys in users table...\n";

// Check MySQL foreign keys
try {
    $foreignKeys = DB::select("
        SELECT 
            TABLE_NAME, COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
        FROM 
            INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
        WHERE 
            TABLE_NAME = 'users' AND REFERENCED_TABLE_NAME IS NOT NULL
    ");

    if (count($foreignKeys) > 0) {
        echo "Foreign keys found:\n";
        foreach ($foreignKeys as $fk) {
            echo "- Constraint: {$fk->CONSTRAINT_NAME}\n";
            echo "  Column: {$fk->COLUMN_NAME}\n";
            echo "  References: {$fk->REFERENCED_TABLE_NAME}.{$fk->REFERENCED_COLUMN_NAME}\n\n";
        }
    } else {
        echo "No foreign keys found in users table\n";
    }
} catch (Exception $e) {
    echo "Error checking foreign keys: " . $e->getMessage() . "\n";
}

// Check if role_id column has foreign key constraint
echo "\nChecking role_id column details:\n";
$columnDetails = DB::select("
    SELECT 
        COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_KEY, EXTRA
    FROM 
        INFORMATION_SCHEMA.COLUMNS 
    WHERE 
        TABLE_NAME = 'users' AND COLUMN_NAME = 'role_id'
");

if (count($columnDetails) > 0) {
    $column = $columnDetails[0];
    echo "role_id column details:\n";
    echo "- Type: {$column->COLUMN_TYPE}\n";
    echo "- Nullable: {$column->IS_NULLABLE}\n";
    echo "- Key: {$column->COLUMN_KEY}\n";
    echo "- Extra: {$column->EXTRA}\n";
} else {
    echo "role_id column not found\n";
}
