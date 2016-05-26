<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Chat;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ChatsTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder{

    public function run()
    {
        // TODO: Implement run() method.
        DB::table('users')->delete();
        User::create([
        'name' => 'admin',
        'email' => 'pavel@gmail.com',
        'password' => Hash::make('mw123456'),
        'activated' => 1,
        'color' => '000000',
        'admin' => 1
        ]);
    }
}

class ChatsTableSeeder extends Seeder{

    public function run()
    {
        // TODO: Implement run() method.
        DB::table('chats')->delete();
        Chat::create([
            'user' => '1',
            'msg' => 'Seeder message',
        ]);
    }
}