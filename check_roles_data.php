<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking roles data...\n";

// Get all roles
$roles = DB::table('roles')->get();

if ($roles->count() > 0) {
    echo "Roles in database:\n";
    foreach ($roles as $role) {
        echo "- ID: {$role->id}, Name: {$role->name}, Description: {$role->description}\n";
    }
} else {
    echo "No roles found in database\n";
}

echo "\nChecking users role_id values:\n";
$users = DB::table('users')->select('id', 'name', 'role', 'role_id')->get();

if ($users->count() > 0) {
    foreach ($users as $user) {
        echo "- User: {$user->name}, Role: {$user->role}, Role ID: {$user->role_id}\n";
    }
} else {
    echo "No users found\n";
}
