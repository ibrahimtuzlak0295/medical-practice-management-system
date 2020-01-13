<?php

use Illuminate\Database\Seeder;

use App\Practice;

class PracticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Practice::class, 15)->create();
    }
}
