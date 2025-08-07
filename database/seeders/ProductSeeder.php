<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            'productId'=>Str::random(7),
            'productName'=>'Dell laptop',
            'Qty'=>'5',
            'buyingPrice'=>'500000',
            'sellingPrice'=>'800000',
            'isActive'=>1,
        ]);
    }
}
