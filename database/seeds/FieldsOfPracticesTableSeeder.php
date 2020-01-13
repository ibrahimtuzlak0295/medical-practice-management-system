<?php

use Illuminate\Database\Seeder;

use App\FieldsOfPractice;

class FieldsOfPracticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(FieldsOfPractice::class, 5)->create();
    }
}
