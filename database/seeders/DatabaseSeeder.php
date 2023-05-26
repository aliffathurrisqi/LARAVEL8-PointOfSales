<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

use App\Models\Product\ProductCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        $company = new Company();
        $company->name = "Alfari Studio";
        $company->address = "Jl. Ngagel Tirto IIB No.2, Ngagelrejo, Kec. Wonokromo, Kota SBY, Jawa Timur 60245";
        $company->email = "alfaristudio@gmail.com";
        $company->image = "logo.png";
        $company->save();

        $item = new ProductCategory();
        $item->id = 0;
        $item->name = "Tidak Berkategori";
        $item->save();
    }
}
