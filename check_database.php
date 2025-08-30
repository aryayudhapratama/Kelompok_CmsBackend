<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Checking database...\n";
echo "Users count: " . \App\Models\User::count() . "\n";
echo "Roles count: " . \App\Models\Role::count() . "\n";

// Check if users have roles
$users = \App\Models\User::with('role')->get();
foreach ($users as $user) {
    echo "User: {$user->name}, Role ID: {$user->role_id}, Role: " . ($user->role ? $user->role->name : 'NULL') . "\n";
}

// List all roles
$roles = \App\Models\Role::all();
echo "Available roles:\n";
foreach ($roles as $role) {
    echo "- ID: {$role->id}, Name: {$role->name}\n";
}
