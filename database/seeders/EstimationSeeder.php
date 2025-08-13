<?php

namespace Database\Seeders;

use App\Models\Estimation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstimationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estimation::insert([
            [
                'no_account' => '11011',
                'title' => 'Kas Kecil',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '11012',
                'title' => 'Bank BRI',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '11031',
                'title' => 'Perlengkapan Kantor',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '11032',
                'title' => 'Sewa Gedung di bayar dimuka',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '12001',
                'title' => 'Peralatan',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '21011',
                'title' => 'Hutang pembelian belum di tagih',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '21012',
                'title' => 'Hutang gajih karyawan',
                'balance' => 0,
                'end_balance' => 0,
            ],

            [
                'no_account' => '30001',
                'title' => 'Penjualan',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '30002',
                'title' => 'Pendapatan Jasa',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '30003',
                'title' => 'Retur Penjualan',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '40001',
                'title' => 'Beban Pokok Penjualan',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '50001',
                'title' => 'Beban Iklan',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '50002',
                'title' => 'Beban Komisi',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '50003',
                'title' => 'Beban Bensin, Parkir, Tol',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '50004',
                'title' => 'Beban Gajih, Upah & Honorer',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '50005',
                'title' => 'Beban Bonus, Pesangon',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '50006',
                'title' => 'Beban Transportasi',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '50007',
                'title' => 'Beban ALT (ATK, Listrik, Telekomunikasi, dll)',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '50008',
                'title' => 'Beban perlengkapan kantor',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '50009',
                'title' => 'Beban sewa gedung',
                'balance' => 0,
                'end_balance' => 0,
            ],
            [
                'no_account' => '70010',
                'title' => 'Beban operasional lainnya',
                'balance' => 0,
                'end_balance' => 0,
            ],
        ]);
    }
}
