<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User();
        $user1->nombres = "yurani";
        $user1->apellidos = "belalcazar";
        $user1->edad = 23;  
        $user1->telefono = "3042094746";
        $user1->email = "yurani@gmail.com";
        $user1->password = bcrypt("12345678");  
    
        $user1->save();  
    
        $user2 = new User();
        $user2->nombres = "leidy";
        $user2->apellidos = "santacruz";
        $user2->edad = 20;
        $user2->telefono = "311234567";
        $user2->email = "leidy@gmail.com";
        $user2->password = bcrypt("12345678");
    
        $user2->save();

        $user3 = new User();
        $user3->nombres = "yesica";
        $user3->apellidos = "gonzalez";
        $user3->edad = 20;
        $user3->telefono = "32145678";
        $user3->email = "yesica@gmail.com";
        $user3->password = bcrypt("12345678");
    
        $user2->save();

        
    }
}
