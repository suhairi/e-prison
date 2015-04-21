<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserTableSeeder');

    }

}

class UserTableSeeder extends Seeder {

    public function run() {

        DB::table('users')->delete();

        DB::table('users')->insert(array(
                'name'      => 'suhairi',
                'email'     => 'suhairi81@gmail.com',
                'password'  => '$2y$10$Le.Xjp9TMIi1wIIi5jfovOdR0eBhFCj700DpbZaizWyOkTx1.1Y/6',
                'level'     => 1,
            )
        );

        $this->messaging1('suhairi', 'suhairi81@gmail.com', '1');

        DB::table('users')->insert(array(
                'name'      => 'najib',
                'email'     => 'najib@gmail.com',
                'password'  => '$2y$10$5of9dxMEL1l50tLzmYFtHemoX9lz/RQqCWlbKAECTm9RJYpZBrFci',
                'level'     => 2,
            )
        );

        $this->messaging1('najib', 'najib@gmail.com', '2');

        DB::table('prefixes')->insert(array(
                'desc'      => 'memoTerima',
                'details'   => 'JP/PRL/PKW/BLG/20/2',
                'status'    => 'active'
            )
        );

        $this->messaging2('memoTerima', 'JP/PRL/PKW/BLG/20/2');

        DB::table('prefixes')->insert(array(
                'desc'      => 'memoPolis',
                'details'   => 'JP/PRL/PKW/BLG/20/4',
                'status'    => 'active'
            )
        );

        $this->messaging2('memoPolis', 'JP/PRL/PKW/BLG/20/4');

        DB::table('prefixes')->insert(array(
                'desc'      => 'memoSelesai',
                'details'   => 'JP/PRL/PKW/BLG/20/3',
                'status'    => 'active'
            )
        );

        $this->messaging2('memoSelesai', 'JP/PRL/PKW/BLG/20/3');


    }

    public function messaging1($name, $email, $level) {

        $this->command->info('    ');
        $this->command->info('Seeding sampel akses pengguna');
        $this->command->info('    ');
        $this->command->info('User       : ' . $name);
        $this->command->info('Email      : ' . $email);
        $this->command->info('Password   : *******');
        $this->command->info('User Level : ' . $level);
    }

    public function messaging2($desc, $details, $status = 'active') {

        $this->command->info('    ');
        $this->command->info('Seeding sampel prefixes');
        $this->command->info('    ');
        $this->command->info('Description   : ' . $desc);
        $this->command->info('Details       : ' . $details);
        $this->command->info('Status        : ' . $status);
    }
}

