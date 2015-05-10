<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info(' ');
        $this->call('UserTableSeeder');
    }

}

class UserTableSeeder extends Seeder {

    public function run() {

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
            'mahkamah'          => 1,
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

        DB::table('officer')->insert(array(
            'staffId'       => '1234',
            'noKP'          => '750918026209',
            'name'          => 'AHMAD KAMAL B AHMAD ALI',
            'position'      => 'KIP',
            'penempatan'    => 3
        ));

        DB::table('penempatan')->insert(array(
            'organisasi'    => 'KEDAH',
            'namaPenuh'     => 'PEJABAT PAROL DAN PERKHIDMATAN KOMUNITI NEGERI KEDAH',
            'alamat1'       => 'PEJABAT PAROL DAN PERKHIDMATAN KOMUNITI NEGERI KEDAH,',
            'alamat2'       => 'TINGKAT BAWAH, BANGUNAN WISMA PERSEKUTUAN ALOR SETAR,',
            'alamat3'       => 'JALAN KAMPUNG BARU, 05000 ALOR SETAR,',
            'alamat4'       => 'KEDAH.',
            'noTel'         => '04-7342673'
        ));

        DB::table('penempatan')->insert(array(
            'organisasi'    => 'IBU PEJABAT PENJARA MALAYSIA',
            'namaPenuh'     => 'PEJABAT PAROL DAN PERKHIDMATAN KOMUNITI IBU PEJABAT PENJARA MALAYSIA',
            'alamat1'       => 'IBU PEJABAT PENJARA MALAYSIA,',
            'alamat2'       => 'BUKIT WIRA 04300 KAJANG,',
            'alamat3'       => 'SELANGOR.',
            'noTel'         => '03-87341805'
        ));

        DB::table('penempatan')->insert(array(
            'organisasi'    => 'BALING / SIK KEDAH',
            'namaPenuh'     => 'PEJABAT PAROL DAN PERKHIDMATAN KOMUNITI DAERAH BALING / SIK KEDAH',
            'alamat1'       => 'NO 109, JALAN PERSISIRAN KOTA 4/5,',
            'alamat2'       => 'PULAI, 09100 BALING',
            'alamat3'       => 'KEDAH.',
            'noTel'         => '04-4746079'
        ));

        DB::table('penerima')->insert(array(
            'name'          => 'Pengarah Parol Dan Perkhidmatan Komuniti, Negeri Kedah.',
            'organisasi'    => 'Pejabat Parol Dan Perkhidmatan Komuniti, Negeri Kedah.',
            'alamat1'       => 'Pejabat Parol Dan Perkhidmatan Komuniti Negeri Kedah, Tingkat Bawah,',
            'alamat2'       => 'Negeri Kedah, Tingkat Bawah,',
            'alamat3'       => 'Bangunan Wisma Persekutuan Alor Setar,',
            'alamat4'       => 'Jalan Kampung Baru, 05000 Alor Setar, Kedah.',
            'noTel'         => '04-7342673'
        ));

        DB::table('penerima')->insert(array(
            'name'          => 'Pengarah Parol Dan Perkhidmatan Komuniti, Ibu Pejabat Penjara Malaysia.',
            'organisasi'    => 'Pejabat Parol Dan Perkhidmatan Komuniti, Ibu Pejabat Penjara Malaysia.',
            'alamat1'       => 'Ibu Pejabat Penjara Malaysia',
            'alamat2'       => 'Bukit Wira, 04300 Kajang,',
            'alamat3'       => 'Selangor.',
            'noTel'         => '04-7342673'
        ));

        DB::table('kehadiran')->insert(array(
            'desc'          => 'PUSAT KEHADIRAN WAJIB DAERAH BALING / SIK KEDAH',
            'negeri'        => 'KEDAH'
        ));

        // #################   Mesej Selesai   #######################

        $this->messaging();

        // #################                    #######################

    }

    public function messaging() {

        $this->command->info(' ');
        $this->command->info('Proses seeding Selesai!');

    }


}

