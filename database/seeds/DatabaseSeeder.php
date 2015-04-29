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

//        DB::table('users')->delete();

        DB::table('users')->insert(array(
                'name'      => 'suhairi',
                'email'     => 'suhairi81@gmail.com',
                'password'  => '$2y$10$Le.Xjp9TMIi1wIIi5jfovOdR0eBhFCj700DpbZaizWyOkTx1.1Y/6',
                'level'     => 1,
            )
        );

        DB::table('users')->insert(array(
                'name'      => 'najib',
                'email'     => 'najib@gmail.com',
                'password'  => '$2y$10$5of9dxMEL1l50tLzmYFtHemoX9lz/RQqCWlbKAECTm9RJYpZBrFci',
                'level'     => 2,
            )
        );

        DB::table('prefixes')->insert(array(
                'desc'      => 'memoTerima',
                'details'   => 'JP/PRL/PKW/BLG/20/2',
                'status'    => 'active'
            )
        );

        DB::table('prefixes')->insert(array(
                'desc'      => 'memoPolis',
                'details'   => 'JP/PRL/PKW/BLG/20/4',
                'status'    => 'active'
            )
        );

        DB::table('prefixes')->insert(array(
                'desc'      => 'memoSelesai',
                'details'   => 'JP/PRL/PKW/BLG/20/3',
                'status'    => 'active'
            )
        );

        DB::table('daerah')->insert(array(              // ID
            [ 'desc'    => 'KUALA MUDA' ],              //  1
            [ 'desc'    => 'KOTA SETAR' ],              //  2
            [ 'desc'    => 'KUBANG PASU / JITRA' ],     //  3
            [ 'desc'    => 'KULIM' ],                   //  4
            [ 'desc'    => 'LANGKAWI' ],                //  5
            [ 'desc'    => 'POKOK SENA' ],              //  6
            [ 'desc'    => 'PENDANG' ],                 //  7
            [ 'desc'    => 'BANDAR BAHARU' ],           //  8
            [ 'desc'    => 'YAN' ],                     //  9
            [ 'desc'    => 'PADANG TERAP' ],            // 10
            [ 'desc'    => 'BALING' ],                  // 11
            [ 'desc'    => 'SIK' ]                      // 12
        ));

        //Selesai

        $this->messaging();

    }

    public function messaging() {

        $this->command->info('Proses seeding Selesai!');

    }


}

