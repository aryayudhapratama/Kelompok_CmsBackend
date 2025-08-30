<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Debugging roles...\n";

// Check first user
$user = \App\Models\User::first();
if ($user) {
    echo "First user: {$user->name}\n";
    echo "Role ID: {$user->role_id}\n";
    echo "Role relation type: " . gettype($user->role) . "\n";
    
    if (is_object($user->role)) {
        echo "Role object class: " . get_class($user->role) . "\n";
        echo "Role name: " . $user->role->name . "\n";
    } else {
        echo "Role value: " . $user->role . "\n";
    }
} else {
    echo "No users found\n";
}

// Check all roles
echo "\nAll roles:\n";
$roles = \App\Models\Role::all();
foreach ($roles as $role) {
    echo "- ID: {$role->id}, Name: {$role->name}\n";
}
