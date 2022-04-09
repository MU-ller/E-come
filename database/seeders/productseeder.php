<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class productseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')
        ->insert([
            [
                'name' => 'LG mobile',
                'price' =>'$200',
                'catagory'=>'mobile',
                'discription' =>" asmart feather with 8gb ram",
                 'gallery' => 'https://prd.best/wp-content/uploads/2020/03/oppo-A5p1.jpg'

            ],
            [
                'name' => 'Oppo mobile',
                'price' =>'$100',
                'catagory'=>'mobile',
                'discription' =>" asmart feather with 4GB ram",
                 'gallery' => 'https://www.unlockphonetool.com/wp-content/uploads/2014/11/Unlock-LG-Phone-Free.jpg'

            ],
              [
                'name' => 'Panasonic TV',
                'price' =>'$600',
                'catagory'=>'TV',
                'discription' =>"a smart feacher with 40 in",
                 'gallery' => 'https://tvrepaircompany.ca/wp-content/uploads/2020/04/Panasonic-TV.jpg'

              ],
                      [
                'name' => 'Sony TV',
                'price' =>'$800',
                'catagory'=>'TV',
                'discription' =>"a smart feacher with 90 in",
                 'gallery' => 'https://tvpricebd.com/wp-content/uploads/2020/05/sony-65x7500f-4k-android-tv-500x500-2048x2048.jpeg'

                      ],
                [
                'name' => 'lg fridge',
                'price' =>'$300',
                'catagory'=>'fridge',
                'discription' =>"a smart fridge with two doors",
                'gallery' => 'https://www.pexels.com/photo/white-wooden-kitchen-cabinet-1599791/'

            ]
        ]);
        
    }
}
