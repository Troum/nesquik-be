<?php

use Illuminate\Database\Seeder;

class CodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Code::class, 10)->create();
    }
}
