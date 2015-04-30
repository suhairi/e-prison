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

        //  Sample Profil

        DB::table('profile')->insert(array(
            'noKP'          => '900918026209',
            'nama'          => 'MOHD ARIF BIN MOHD JASNI ',
            'jobDesc'       => 'PEMBANTU KEDAI MAKAN',
            'race'          => 'MELAYU',
            'religion'      => 'ISLAM',
            'phone'         => '0125780003',
            'maritalStatus' => 'BUJANG',
            'photo'         => '900918026209.jpg'
        ));

        DB::table('profileext')->insert(array(
            'noKP'          => '900918026209',
            'hairColor'     => 'HITAM',
            'skinColor'     => 'HITAM MANIS',
            'weight'        => '51',
            'height'        => '163',
            'placeOB'       => 'HOSPITAL DAERAH BALING, KEDAH',
            'education'     => 'TINGKATAN LIMA',
            'marks'         => 'PARUT CACAR DI LENGAN KIRI DAN PARUT LUKA DI BAWAH LENGAN KIRI',
            'bodyMarks'     => 'TIADA'
        ));

        DB::table('cases')->insert(array(
            'caseNo'            => '83RS-01-01/2014',
            'noKP'              => '900918026209',
            'seksyenKesalahan'  => 'SEK 380 KK',
            'memoTerima'        => 'JP/PRL/PKW/BLG/20/2(18)',
            'memoPolis'         => 'JP/PRL/PKW/BLG/20/4(14)',
            'memoSelesai'       => 'JP/PRL/PKW/BLG/20/3(14)',
            'noDaftar'          => 'PKW 0002-14-02-04',
            'hukuman'           => '3 BULAN DAN 4 JAM',
            'tarikhMasuk'       => '2014-01-09'
        ));

        DB::table('remitance')->insert(array(
            'caseNo'         => '83RS-01-01/2014',
            'tarikhHukum'   => '2014-01-09',
            'tarikhLewat'   => '2014-04-08',
            'tarikhAwal'    => '2014-03-25'
        ));

        DB::table('parent')->insert(array(
            'noKP'          => '900918026209',
            'noKPParent'    => '',
            'name'          => 'MOHD JASNI BIN AB SANI',
            'relationship'  => 'BAPA',
            'address'       => 'KAMPUNG SEBERANG WAT, JLN. HOSPITAL, BALING',
            'phone'         => ''
        ));

        // #################   Mesej Selesai   #######################

        $this->messaging();

        // #################                    #######################

    }

    public function messaging() {

        $this->command->info('Proses seeding Selesai!');

    }


}

