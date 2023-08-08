<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->string('currency', 3)->default('YER');
        });

        Schema::table('order_items', function (Blueprint $table) {
            //
            $table->Float("sar_price")->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('currency');
        });

        Schema::table('order_items', function (Blueprint $table) {
            //
            $table->dropColumn('sar_price');
        });
    }
}
