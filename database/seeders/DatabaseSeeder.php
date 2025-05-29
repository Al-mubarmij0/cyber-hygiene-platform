<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder; // Ensure Seeder is imported

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the AdminUserSeeder to create your dedicated admin user
        $this->call(AdminUserSeeder::class);

        // This will create a 'Test User' with the default 'user' role.
        // It's useful for testing non-admin functionalities.
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            // The 'role' column is not explicitly set here.
            // When not provided, it will use the default value defined in your migration
            // (which should be 'user' for new users).
        ]);

        // If you had other factories or seeders for regular users, they would go here.
        // For example, if you wanted 10 more regular users:
        // User::factory(10)->create();
    }
}