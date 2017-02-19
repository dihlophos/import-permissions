<?php

use Illuminate\Database\Seeder;

class ProductTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `product_types` (`id`, `name`) VALUES
                (1, 'Мясное сырье и полуфабрикаты'),
                (2, 'Готовые мясные продукты'),
                (3, 'Рыба, рыбопродукты, морепродукты сырые'),
                (4, 'Готовые рыба, рыбопродукты, морепродукты'),
                (5, 'Яйцо'),
                (6, 'Корма'),
                (7, 'Биологические отходы')");
    }
}
