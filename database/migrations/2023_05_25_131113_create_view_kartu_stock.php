<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewKartuStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "CREATE VIEW view_kartu_stock AS
            (SELECT master_products.id, master_products.code, master_products.name, IF(sum(purchasing_detail.quantity) IS NOT NULL, sum(purchasing_detail.quantity), 0) AS stock_in FROM master_products
            LEFT JOIN purchasing_detail ON master_products.id = purchasing_detail.product_id
            LEFT JOIN purchasing ON purchasing_detail.purchasing_id = purchasing.id
            WHERE purchasing.deleted_at IS NULL
            GROUP BY master_products.id,  master_products.code,  master_products.name);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_kartu_stock');
    }
}
