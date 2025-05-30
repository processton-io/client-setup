<?php

namespace Processton\LocaleDatabase\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Processton\Locale\Models\City;
use Processton\Locale\Models\Country;
use Processton\Locale\Models\Region;
use Processton\Locale\Models\Zone;

class LocaleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $GRegion = Region::create([
            'color' => '#1f77b4',
            'name' => 'Global',
            'code' => 'GLOBAL',
        ]);

        Region::create([
            'color' => '#007bff',
            'name' => 'North America',
            'code' => 'NA',
            'parent_id' => $GRegion->id
        ]);

        Region::create([
            'color' => '#ff7f0e',
            'name' => 'Latin America',
            'code' => 'LATAM',
            'parent_id' => $GRegion->id
        ]);

        Region::create([
            'color' => '#9467bd',
            'name' => 'Europe, Middle East, and Africa',
            'code' => 'EMEA',
            'parent_id' => $GRegion->id
        ]);

        $APACRegion = Region::create([
            'color' => '#2ca02c',
            'name' => 'Asia-Pacific',
            'code' => 'APAC',
            'parent_id' => $GRegion->id
        ]);

        Region::create([
            'color' => '#f5c000',
            'name' => 'South Asia',
            'code' => 'SA',
            'parent_id' => $GRegion->id
        ]);

        Region::create([
            'color' => '#d62728',
            'name' => 'Sub-Saharan Africa',
            'code' => 'SSA',
            'parent_id' => $GRegion->id
        ]);

        Region::create([
            'color' => '#e5e5e5',
            'name' => 'Oceania',
            'code' => 'AUS/NZ',
            'parent_id' => $GRegion->id
        ]);
        $Country = Country::create([
            'color' => '#00401A',
            'region_id' => $APACRegion->id,
            'name' => 'Pakistan',
            'iso_2_code' => 'PK',
            'iso_3_code' => 'PAK',
            'dial_code' => '+92',
        ]);

        foreach (['Karachi', 'Lahore', 'Islamabad', 'Quetta'] as $city) {

            $city = City::create([
                'country_id' => $Country->id,
                'name' => $city,
            ]);

            foreach(['North', 'South', 'East', 'West'] as $zone) {
                Zone::create([
                    'color' => self::getRandomColor(),
                    'city_id' => $city->id,
                    'name' => $zone . ' ' . $city->name,
                    'code' => $zone.'_' . $city->name,
                ]);
            }

        }


        $this->call(CurrenciesTableSeeder::class);
    }


    public static function getRandomColor(){
        $colors = [
            'color' => '#6B8E23',
            'color' => '#00247D',
            'color' => '#FFD700',
            'color' => '#008000',
            'color' => '#FF4500',
            'color' => '#4682B4',
            'color' => '#B22222',
            'color' => '#FFD700',
            'color' => '#8B0000',
            'color' => '#1E90FF',
            'color' => '#FF6347',
            'color' => '#FF4500',
            'color' => '#FF9933',
            'color' => '#00008B',
            'color' => '#00BFFF',
            'color' => '#8A2BE2',
            'color' => '#32CD32',
            'color' => '#FF4500',
            'color' => '#FFD700',
            'color' => '#228B22',
            'color' => '#FF8C00',
            'color' => '#8B0000',
            'color' => '#FF6347',
            'color' => '#008000',
            'color' => '#000000',
            'color' => '#00A859',
            'color' => '#007FFF',
            'color' => '#FF0000',
            'color' => '#FF4500',
            'color' => '#008000',
            'color' => '#FFD700',
            'color' => '#FF6347',
            'color' => '#008080',
            'color' => '#FFA500',
            'color' => '#FF4500',
            'color' => '#FFD700',
            'color' => '#008000',
            'color' => '#FF4500',
            'color' => '#FF6347',
            'color' => '#4682B4',
            'color' => '#FFD700',
            'color' => '#8B0000',
            'color' => '#FF4500',
            'color' => '#FFD700',
            'color' => '#FFD700',
            'color' => '#FF4500',
            'color' => '#008000',
            'color' => '#FF6347',
            'color' => '#4682B4',
            'color' => '#FFA500',
            'color' => '#FF9933',
            'color' => '#FFD700',
            'color' => '#FF4500',
            'color' => '#4682B4',
            'color' => '#FF6347',
            'color' => '#1E90FF',
            'color' => '#FF4500',
            'color' => '#FF6347',
            'color' => '#4682B4',
            'color' => '#FFD700',
            'color' => '#FF4500',
            'color' => '#4682B4',
            'color' => '#FF6347',
            'color' => '#FFD700',
            'color' => '#FF4500',
            'color' => '#4682B4',
            'color' => '#FF6347',
            'color' => '#FFD700',
            'color' => '#FF4500',
            'color' => '#FFD700',
            'color' => '#FF4500',
            'color' => '#FFD700',
        ];

        return $colors[array_rand($colors)];
    }

}
