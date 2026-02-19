<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;

class CardSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos un bucle para generar 100 cartas automáticamente
        for ($i = 1; $i <= 100; $i++) {

            // Lógica para asignar rareza y precio según el número
            if ($i % 10 === 0) {
                $rarity = 'oro';
                $price = 1000;
            } elseif ($i % 5 === 0) {
                $rarity = 'plata';
                $price = 250;
            } else {
                $rarity = 'bronce';
                $price = 50;
            }

            Card::updateOrCreate(
                ['name' => "Pokemon #$i"], // Nombre genérico basado en el ID
                [
                    'sell_price' => $price,
                    'rarity' => $rarity,
                    // Usamos el ID del bucle para obtener la imagen correspondiente
                    'image_url' => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/$i.png"
                ]
            );
        }
    }
}