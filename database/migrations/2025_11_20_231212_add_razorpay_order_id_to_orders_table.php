<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // In the migration file
public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->string('razorpay_order_id')->nullable()->after('id');
        // Add index for better performance
        $table->index('razorpay_order_id');
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn('razorpay_order_id');
    });
}
};
