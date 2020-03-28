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
               'name'=>'Admin',
               'email'=>'admin@gmail.com',
                'level'=>'admin',
               'password'=> bcrypt('admin'),
            ],
            [
               'name'=>'peserta',
               'email'=>'user@gmail.com',
                'level'=>'pserta',
               'password'=> bcrypt('user'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}