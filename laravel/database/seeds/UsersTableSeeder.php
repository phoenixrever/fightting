<?php

use Illuminate\Database\Seeder;
use App\Http\Models\User;
use Spatie\Permission\Models\Permission;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=100;$i<150;$i++){
            Permission::create([
                'name' => "phoenixhell".$i,
                'description' => 'google@.gmail.com'.$i,
            ]);
        }
    }
}
