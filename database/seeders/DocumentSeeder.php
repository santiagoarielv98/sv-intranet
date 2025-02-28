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
                'document_type' => 'id_card',
                'file_path' => asset('fake/fake-id-card.jpg'),
            ]);

            $employee->documents()->create([
                'document_type' => 'CV',
                'file_path' => asset('fake/fake-cv.pdf'),
            ]);

            $employee->documents()->create([
                'document_type' => 'contract',
                'file_path' => asset('fake/fake-contract.pdf'),
            ]);
        }
    }
}
