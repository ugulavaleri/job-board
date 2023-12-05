<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employee;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         User::factory()->create([
             'name' => 'domenti',
             'email' => 'domenti@gmail.com',
         ]);

        User::factory(200)->create();

        $users = User::all()->shuffle();

        for ($i = 0;$i < 20;$i++){
            Employee::factory()->create([
                'user_id' => $users->pop()->id
            ]);
        }

        $employees = Employee::all();

        for ($i = 0;$i < 100;$i++){
            Job::factory()->create([
                'employee_id' => $employees->random()->id
            ]);
        }

        foreach ($users as $user){
            $jobs = Job::inRandomOrder()->take(rand(1,4))->get();

            foreach ($jobs as $job){
                JobApplication::factory()->create([
                    'user_id' => $user->id,
                    'job_id' => $job->id,
                ]);
            }
        }
    }
}
