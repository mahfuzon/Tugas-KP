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
                'level'=>'peserta',
               'password'=> bcrypt('user'),
            ],
            [
                'name'=>'guru',
                'email'=>'guru@gmail.com',
                 'level'=>'guru',
                'password'=> bcrypt('guru'),
             ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}