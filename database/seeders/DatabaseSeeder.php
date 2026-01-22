<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear al usuario Admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'wallet' => 100,
        ]);

        // 2. Insertar tus 20 cartas exactas
        $cards = [
            ['name' => 'Soldado de Recluta', 'rarity' => 'Común', 'price' => 2],
            ['name' => 'Arquero de Bosque', 'rarity' => 'Común', 'price' => 2],
            ['name' => 'Escudo de Madera', 'rarity' => 'Común', 'price' => 2],
            ['name' => 'Poción de Vida', 'rarity' => 'Común', 'price' => 3],
            ['name' => 'Daga Oxidada', 'rarity' => 'Común', 'price' => 3],
            ['name' => 'Caballero de Hierro', 'rarity' => 'Rara', 'price' => 15],
            ['name' => 'Mago Aprendiz', 'rarity' => 'Rara', 'price' => 15],
            ['name' => 'Anillo de Plata', 'rarity' => 'Rara', 'price' => 20],
            ['name' => 'Ballesta Pesada', 'rarity' => 'Rara', 'price' => 20],
            ['name' => 'Lobo Huargo', 'rarity' => 'Rara', 'price' => 25],
            ['name' => 'Dragón de Cría', 'rarity' => 'Épica', 'price' => 60],
            ['name' => 'Hechizo de Fuego', 'rarity' => 'Épica', 'price' => 60],
            ['name' => 'Armadura Real', 'rarity' => 'Épica', 'price' => 75],
            ['name' => 'Espada Rúnica', 'rarity' => 'Épica', 'price' => 80],
            ['name' => 'Gólem de Piedra', 'rarity' => 'Épica', 'price' => 90],
            ['name' => 'Fénix Dorado', 'rarity' => 'Legendaria', 'price' => 250],
            ['name' => 'Rey Exiliado', 'rarity' => 'Legendaria', 'price' => 300],
            ['name' => 'Cetro de los Dioses', 'rarity' => 'Legendaria', 'price' => 450],
            ['name' => 'Dragón Ancestral', 'rarity' => 'Legendaria', 'price' => 500],
            ['name' => 'Titán de Obsidiana', 'rarity' => 'Legendaria', 'price' => 600],
        ];

        foreach ($cards as $card) {
            DB::table('cards')->insert([
                'name' => $card['name'],
                'rarity' => $card['rarity'],
                'sell_price' => $card['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}