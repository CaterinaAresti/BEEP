<?php

use Illuminate\Database\Seeder;

class PlanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $planTypes = [
            [
                'name' => 'Basic',
                'description' => 'A basic plan for beginners.',
                'price' => 0.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pro',
                'description' => 'An advanced plan for serious beekeepers.',
                'price' => 75.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Advanced',
                'description' => 'A comprehensive plan for advanced beekepers.',
                'price' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Research',
                'description' => 'A specialized plan for research purposes.',
                'price' => 6500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('plan_types')->insert($planTypes);
    }
}
