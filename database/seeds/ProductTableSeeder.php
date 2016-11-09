<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::create([
            'name' =>'React Native',
            'cate_id' => 9,
            'introduce' => '如果你对开发Web端的原生移动应用感兴趣，《React Native：用JavaScript开发移动应用》就是一本不容错过的以实例代码为引导的入门书籍',
            'price' => 65.98,
            'preview' => '/images/4.jpg',
        ]);

        \App\Models\Product::create([
            'name' =>'React',
            'cate_id' => 9,
            'introduce' => '身出名门，Fackbook开源巨献，一经推出，瞬间亮瞎全球攻城狮,以BAT为首的一线国内互联网企业均以快速跟进研发、实践React，下一次求职你就一定会被面到',
            'price' => 98.00,
            'preview' => '/images/3.jpg',
        ]);
    }
}
