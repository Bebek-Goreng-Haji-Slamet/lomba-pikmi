<?php

namespace Database\Factories;

use App\Models\FoodShare;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FoodShare>
 */
class FoodShareFactory extends Factory
{
    protected $model = FoodShare::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $items = [
            [
                'food_name' => 'Paket Bento Ayam Teriyaki',
                'provider_name' => 'HokBen Sudirman',
                'description' => '10 Porsi Paket Bento - Kondisi Layak, Sisa Produksi Siang',
                'location_detail' => 'Jl. Jenderal Sudirman No. 54, Jakarta Pusat',
                'image_url' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c',
            ],
            [
                'food_name' => 'Nasi Kapau Rendang',
                'provider_name' => 'Nasi Kapau Merdeka',
                'description' => '8 Porsi Nasi Kapau Rendang - Fresh, Belum Tersentuh Display',
                'location_detail' => 'Jl. Merdeka Barat No. 21, Bandung',
                'image_url' => 'https://images.unsplash.com/photo-1526318896980-cf78c088247c',
            ],
            [
                'food_name' => 'Lontong Sayur Betawi',
                'provider_name' => 'Dapur Betawi Cikini',
                'description' => '12 Porsi Lontong Sayur - Sisa Catering Kantor Pagi',
                'location_detail' => 'Jl. Cikini Raya No. 18, Jakarta Pusat',
                'image_url' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19',
            ],
            [
                'food_name' => 'Ayam Geprek Sambal Matah',
                'provider_name' => 'Warung Geprek Tugu',
                'description' => '15 Box Ayam Geprek - Layak Konsumsi, Sisa Event Komunitas',
                'location_detail' => 'Jl. Tugu Pahlawan No. 7, Surabaya',
                'image_url' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38',
            ],
            [
                'food_name' => 'Sate Taichan Komplit',
                'provider_name' => 'Sate Senayan Blok M',
                'description' => '20 Tusuk Sate Taichan - Baru Dimasak, Sisa Produksi Malam',
                'location_detail' => 'Jl. Melawai No. 90, Jakarta Selatan',
                'image_url' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1',
            ],
        ];

        $pick = $this->faker->randomElement($items);

        return [
            'food_name' => $pick['food_name'],
            'provider_name' => $pick['provider_name'],
            'servings' => $this->faker->numberBetween(5, 30),
            'status' => $this->faker->randomElement(['Available', 'Available', 'Booked', 'Collected']),
            'image_url' => $pick['image_url'],
            'pickup_limit' => now()->addHours($this->faker->numberBetween(1, 24)),
            'location_detail' => $pick['location_detail'],
            'description' => $pick['description'],
        ];
    }
}