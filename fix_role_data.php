<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Fixing role data...\n";

// Get all roles
$roles = DB::table('roles')->get()->keyBy('name');
echo "Available roles:\n";
foreach ($roles as $role) {
    echo "- ID: {$role->id}, Name: {$role->name}\n";
}

// Get users with their current role
$users = DB::table('users')->get();
echo "\nFixing user roles:\n";

foreach ($users as $user) {
    if ($user->role_id == 0 && !empty($user->role)) {
        // Find the role ID based on role name
        $roleName = strtolower($user->role);
        
        if (isset($roles[$roleName])) {
            $roleId = $roles[$roleName]->id;
            DB::table('users')
                ->where('id', $user->id)
                ->update(['role_id' => $roleId]);
            
            echo "Fixed user {$user->name}: role '{$user->role}' -> role_id {$roleId}\n";
        } else {
            echo "Warning: Role '{$user->role}' not found for user {$user->name}\n";
        }
    } elseif ($user->role_id > 0) {
        echo "User {$user->name} already has role_id: {$user->role_id}\n";
    } else {
        echo "Warning: User {$user->name} has invalid role data (role: '{$user->role}', role_id: {$user->role_id})\n";
    }
}

echo "\nVerification:\n";
$verifiedUsers = DB::table('users')->select('id', 'name', 'role', 'role_id')->get();
foreach ($verifiedUsers as $user) {
    echo "- User: {$user->name}, Role: {$user->role}, Role ID: {$user->role_id}\n";
}
