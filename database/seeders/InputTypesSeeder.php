<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputTypesSeeder extends Seeder
{
    public function run()
    {
        $inputTypes = [
            [
                'title' => 'Input Text',
                'slug' => 'input_text',
                'name' => 'input',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Input Number',
                'slug' => 'input_number',
                'name' => 'input',
                'type' => 'number',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Input Email',
                'slug' => 'input_email',
                'name' => 'input',
                'type' => 'email',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Textarea',
                'slug' => 'textarea',
                'name' => 'textarea',
                'type' => 'textarea',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Radio',
                'slug' => 'radio',
                'name' => 'radio',
                'type' => 'radio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Checkbox',
                'slug' => 'checkbox',
                'name' => 'checkbox',
                'type' => 'checkbox',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Dropdown',
                'slug' => 'dropdown',
                'name' => 'select',
                'type' => 'select',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('input_types')->insert($inputTypes);
    }
}
