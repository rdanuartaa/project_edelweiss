<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        $tags = ['trip', 'lava', 'hutan', 'alam', 'bebas'];

        foreach ($tags as $tag) {
            Tag::create([
                'nama' => $tag
            ]);
        }
    }
}
