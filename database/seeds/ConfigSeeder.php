<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super admin user
        DB::table('users')->insert(['name' => 'Super Admin', 'email' => 'super@admin.com', 'password' => bcrypt('123456'), 'phone' => NULL, 'phone' => '', 'cpf' => '1212121', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')]);

        // Product
        DB::table('products')->insert(['name' => 'Manga', 'price' => 3, 'stock' => 20, 'photo' => "https://conteudo.imguol.com.br/c/entretenimento/36/2020/05/22/manga-1590176595629_v2_615x300.jpg"]);
        DB::table('products')->insert(['name' => 'Brócolis', 'price' => 2, 'stock' => 15, 'photo' => "https://conteudo.imguol.com.br/c/entretenimento/53/2020/05/04/brocolis-1588626077191_v2_450x337.jpg"]);

    }
}
