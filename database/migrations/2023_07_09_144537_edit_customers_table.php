<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('add_to_cart', function (Blueprint $table) {
        //     // $table->dropForeign('add_to_cart_customer_id_foreign');
        //     $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        // });
        Schema::table('customers', function (Blueprint $table) {
            //
            // $table->dropColumn('user_password');
            // $table->renameColumn('user_name', 'name');
            // $table->renameColumn('user_email', 'email');
            // $table->dropUnique('customers_user_email_unique');
            // $table->unsignedInteger('id')->change();
            $table->string("phone")->default('')->change();
            $table->string("avatar")->default('')->change();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = 'customers';
        $foreignKeys = Schema::getConnection()
            ->getDoctrineSchemaManager()
            ->listTableForeignKeys($table);

        foreach ($foreignKeys as $foreignKey) {
            Schema::table($table, function (Blueprint $table) use ($foreignKey) {
                $table->dropForeign($foreignKey->getName());
            });
        }
    }
}
