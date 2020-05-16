<?php
  
use Illuminate\Database\Seeder;
use App\User;
   
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
            'nama' => 'admin',
            'email'=>'admin@gmail.com',
            'level'=>'admin',
            'password'=> bcrypt('admin'),
            ],

        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}