<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Fixing user role_ids...\n";

// Get role mappings
$roles = DB::table('roles')->get()->keyBy('name');
$roleMappings = [
    'admin' => $roles['admin']->id,
    'redaktur' => $roles['redaktur']->id,
    'reporter' => $roles['reporter']->id,
];

// Update user role_ids based on their role name
$users = DB::table('users')->get();

foreach ($users as $user) {
    if (isset($roleMappings[$user->role])) {
        DB::table('users')
            ->where('id', $user->id)
            ->update(['role_id' => $roleMappings[$user->role]]);
        
        echo "Updated user {$user->name}: role '{$user->role}' -> role_id {$roleMappings[$user->role]}\n";
    } else {
        echo "Warning: Unknown role '{$user->role}' for user {$user->name}\n";
    }
}

echo "User role_ids fixed successfully!\n";

// Verify the changes
echo "\nVerifying user role_ids:\n";
$users = DB::table('users')->select('id', 'name', 'role', 'role_id')->get();
foreach ($users as $user) {
    echo "- User: {$user->name}, Role: {$user->role}, Role ID: {$user->role_id}\n";
}
