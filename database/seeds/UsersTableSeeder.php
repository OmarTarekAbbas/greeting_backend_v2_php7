<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Emad mohamed',
                'email' => 'emad@ivas.com.eg',
                'password' => '$2y$10$Nc4Maoj0UnAMApVIr/PwZOP/uaPAf7f9WE1G2GBbwl0K19PTkoieu',
                'admin' => 1,
                'remember_token' => 'G72JJBeM8iSRnc3Tcia7ETAqlAUfBgnoP68RSB9sRO4CeRl9Kl3ulW8dkMzt',
                'created_at' => '2015-09-08 12:24:49',
                'updated_at' => '2017-01-30 13:42:16',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'noura',
                'email' => 'noura@ivas.mobi',
                'password' => '$2y$10$d4qcUhosKcQM9U6qPO6bd.tM.NFMbf4z/3lSkuH.KwhJ4uzMRDWMu',
                'admin' => 1,
                'remember_token' => 'kVheQfUA9mvm1bbvDeaXVk20QD3iD0zlvk4pH52UjZZxhbLRcgBtD7clY8WH',
                'created_at' => '2015-09-08 12:44:18',
                'updated_at' => '2015-09-13 13:58:14',
            ),
            2 =>
            array (
                'id' => 4,
                'name' => 'user 3',
                'email' => 'yousef@ivas.mobi',
                'password' => '$2y$10$PZTlbSHqXbt6LW0I3/WRE.MCPRYPorWD9QeqaDb7fmKe3KUd7D9i.',
                'admin' => 1,
                'remember_token' => 'qONidm6GglhqVEoM384ZjxXZaKlj6qcFeejC1DraeGfgqimwnnhft4loA18m',
                'created_at' => '2015-09-10 11:24:04',
                'updated_at' => '2015-09-14 10:02:59',
            ),
            3 =>
            array (
                'id' => 5,
                'name' => 'user 4',
                'email' => 'islam@ivas.mobi',
                'password' => '$2y$10$uwiq1aEjCVp3NEm6xG4xJe8syLVkCmo98ahI/vV10uhWTT/52cW3e',
                'admin' => 1,
                'remember_token' => NULL,
                'created_at' => '2015-09-10 15:03:45',
                'updated_at' => '2015-09-13 06:23:23',
            ),
            4 =>
            array (
                'id' => 6,
                'name' => 'Amr Youssef',
                'email' => 'amr.usef@ivas.mobi',
                'password' => '$2y$10$ffG.shiWGABuqpBWO92fMu7MHWhHtjoCBr5DTTjR67HrWMWmC5J4S',
                'admin' => 1,
                'remember_token' => 'FE1mCZFNenk1KQd3UExadDFDyfAl79S0V7930jmrLoKV1HMLtAiVXgGWMion',
                'created_at' => '2015-09-13 10:33:53',
                'updated_at' => '2015-09-13 13:22:50',
            ),
            5 =>
            array (
                'id' => 7,
                'name' => 'sayed',
                'email' => 'sayed@ivas.mobi',
                'password' => '$2y$10$pgbNcZ5Yj.zk19gwAa7PpexQo1cOFj/i/ifSFqlEjAfb0cEXnKJxm',
                'admin' => 0,
                'remember_token' => '2HangK3ZmC9Z63jnfLran1cDYa4QvYEHDNKK8mqmLRaqpCVU1pxKffqExpYG',
                'created_at' => '2015-09-13 13:22:40',
                'updated_at' => '2015-09-22 20:33:20',
            ),
            6 =>
            array (
                'id' => 8,
                'name' => 'Ahmed Hegazy',
                'email' => 'ahegazy@ivas.mobi',
                'password' => '$2y$10$1lVhfH92qpkQSIZANfFAdeFnntfkLw.z6k1AtIE4EZQglGCKO9MyC',
                'admin' => 1,
                'remember_token' => 'pNxImF9b1ecrJrZd3HkhfduEOZHIbzyM7haA6j9QeosKr6RSW26WtZesj3fO',
                'created_at' => '2015-09-14 08:36:55',
                'updated_at' => '2015-09-14 09:08:21',
            ),
            7 =>
            array (
                'id' => 9,
                'name' => 'Tasnim Roshdy',
                'email' => 'tasnim@ivas.mobi',
                'password' => '$2y$10$74COKWzTUOdLyo9fYF5I9O2yCLAgrUIXaZ6NnHX80ZzmXu89HWncu',
                'admin' => 1,
                'remember_token' => 'kKYgPOWnlWUjRzhHD1NcjqYlhcw5tFna8WwgiBf2qmg7BZnZ6wrwskpJo5dH',
                'created_at' => '2015-09-14 09:46:27',
                'updated_at' => '2015-09-14 09:55:31',
            ),
            8 =>
            array (
                'id' => 10,
                'name' => 'Amr Hassan',
                'email' => 'amr@ivas.mobi',
                'password' => '$2y$10$NWWcxknj8ABCb61pG/iEzek6Lt1jeAsvjPyCmGFJ0ybOPuOZXe.Ye',
                'admin' => 0,
                'remember_token' => 'T30BOf0N68oABeHGzfkUGAMMfPQIIDro75ZQHjWUP1fVT83MrA4fYlVsgBHH',
                'created_at' => '2015-09-14 11:25:23',
                'updated_at' => '2015-09-14 11:28:28',
            ),
            9 =>
            array (
                'id' => 11,
                'name' => 'Mohamed Hamdy',
                'email' => 'mhamdy@ivas.mobi',
                'password' => '$2y$10$svxIbiVi6fRqKCj5puRBKeUNdF8tG/HELhKhcgVeUVccLnRoeKHkC',
                'admin' => 0,
                'remember_token' => 'iHkuCAaiZPVvvbo7wHLdD2m26OjVb7GP7YLeGjeGOFToWcHeVtiiMpwtdfCN',
                'created_at' => '2015-09-14 11:52:13',
                'updated_at' => '2015-09-14 12:45:22',
            ),
            10 =>
            array (
                'id' => 12,
                'name' => 'Hany Shaker',
                'email' => 'hany@ivas.mobi',
                'password' => '$2y$10$fvw72G4SmN1645I2nqm.kOGl2vqQ38.oPT.RHoTZXS9M2TBSGUWD2',
                'admin' => 0,
                'remember_token' => 'TKtnvKMpfFTifz5OX3SVvG2MvLappZIUUwBMTnbhK0ZBxkwWxVipz0ZKEVCv',
                'created_at' => '2015-09-16 14:26:56',
                'updated_at' => '2016-02-22 15:24:12',
            ),
            11 =>
            array (
                'id' => 13,
                'name' => 'Saad ',
                'email' => 'saad@ivas.mobi',
                'password' => '$2y$10$ngRKZ.MhvOFDt4ddtEiFEeZIXdOnj95j2PWDt0PweBbn2xxCUeZLi',
                'admin' => 0,
                'remember_token' => 'ycbSf6gv5qiprvKj9MiHOKaydFK88zSc8vZHpuvDcQQSk2mgjVlgTOZUGI8Z',
                'created_at' => '2015-09-16 19:10:23',
                'updated_at' => '2015-09-17 07:53:25',
            ),
            12 =>
            array (
                'id' => 14,
                'name' => 'Marwan',
                'email' => 'marawan@ivas.mobi',
                'password' => '$2y$10$dK0bmGV1e9gjc3Lw13nMI.9Ndh099bUrAPCb8jn4uAEc89fy5N9Cq',
                'admin' => 1,
                'remember_token' => '0wNT30fZkTOtJuLI4dM5fjK1TdLTljlreCOqm0VqCx9xhQt3L65wsXpkczg6',
                'created_at' => '2016-01-12 09:28:13',
                'updated_at' => '2016-02-02 11:05:55',
            ),
            13 =>
            array (
                'id' => 15,
                'name' => 'ayman',
                'email' => 'ayman@ayman.com',
                'password' => '$2y$10$U5YAF54c1dDYX5gHcG8jmeGY7LoW4a8MDQ32fP6pz.xoeiGrFpPlu',
                'admin' => 1,
                'remember_token' => 'Vl6ceCxSI8hqBWkqe32ddyglovqqj1r0HDCRoqmit0azDX4PDjr8SjKpDYGF',
                'created_at' => '2016-02-22 15:23:59',
                'updated_at' => '2016-02-22 15:24:24',
            ),
            14 =>
            array (
                'id' => 16,
                'name' => 'admin',
                'email' => 'admin@ivas.com.eg',
                'password' => '$2y$10$cVF538eBwaXK83Zjdnqjbu08JIWXwJYd1h4HxWVRBShXkizMQNZwK',
                'admin' => 1,
                'remember_token' => 'bCWwn0bcV0v2QzRC7qFt4v61EA9MXxL0qfWVAtm95hT7b6iwlswl2LcF1DcS',
                'created_at' => '2018-06-07 08:46:1',
                'updated_at' => '2018-06-07 08:46:16',
            ),
        ));


    }
}
