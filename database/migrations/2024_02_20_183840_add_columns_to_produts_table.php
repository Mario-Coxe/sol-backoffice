<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produts', function (Blueprint $table) {

            $table->string('incoming_products')->default('0')->after('stock');
            $table->string('products_left')->default('0')->after('incoming_products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produts', function (Blueprint $table) {
            $table->dropColumn('incoming_products');
            $table->dropColumn('products_left');
        });
    }
};