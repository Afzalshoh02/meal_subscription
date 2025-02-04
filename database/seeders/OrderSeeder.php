<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $tariffIds = [];
        for ($i = 0; $i < 5; $i++) {
            $tariffIds[] = DB::table('tariffs')->insertGetId([
                'ration_name' => $faker->word . ' Plan',
                'cooking_day_before' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            $firstDate = Carbon::now()->addDays(rand(1, 10));
            $lastDate = (clone $firstDate)->addDays(rand(5, 20));

            $orderId = DB::table('orders')->insertGetId([
                'client_name' => $faker->name,
                'client_phone' => $faker->unique()->numerify('79#########'),
                'tariff_id' => $faker->randomElement($tariffIds),
                'schedule_type' => $faker->randomElement(['EVERY_DAY', 'EVERY_OTHER_DAY', 'EVERY_OTHER_DAY_TWICE']),
                'comment' => $faker->optional()->sentence,
                'first_date' => $firstDate,
                'last_date' => $lastDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $currentDate = clone $firstDate;
            while ($currentDate <= $lastDate) {
                DB::table('meals')->insert([
                    'order_id' => $orderId,
                    'cooking_date' => $currentDate->format('Y-m-d'),
                    'delivery_date' => $currentDate->addDays(1)->format('Y-m-d'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                switch (DB::table('orders')->where('id', $orderId)->value('schedule_type')) {
                    case 'EVERY_DAY':
                        $currentDate->addDay();
                        break;
                    case 'EVERY_OTHER_DAY':
                        $currentDate->addDays(2);
                        break;
                    case 'EVERY_OTHER_DAY_TWICE':
                        $currentDate->addDays(3);
                        break;
                }
            }
        }
    }
}
