<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $employees = Employee::all();

        foreach ($employees as $employee) {
            $employee->documents()->create([
                'name' => 'ID Card',
                'path' => 'fake/fake-id-card.jpg',
            ]);

            $employee->documents()->create([
                'name' => 'CV',
                'path' => 'fake/fake-cv.pdf',
            ]);

            $employee->documents()->create([
                'name' => 'Contract',
                'path' => 'fake/fake-contract.pdf',
            ]);
        }
    }
}
