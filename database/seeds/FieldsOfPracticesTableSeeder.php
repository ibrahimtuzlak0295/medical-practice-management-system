<?php

use Illuminate\Database\Seeder;

class FieldsOfPracticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Practice::class, 5)->create();
    }
}
