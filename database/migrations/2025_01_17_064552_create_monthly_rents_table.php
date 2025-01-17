<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('monthly_rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_room_id')->constrained()->cascadeOnDelete(); 
            $table->integer('electricity'); 
            $table->integer('water'); 
            $table->decimal('total_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2); 
            $table->date('payment_date')->nullable(); 
            $table->string('electricity_image')->nullable(); 
            $table->string('water_image')->nullable();
            $table->timestamps();
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_rents');
    }
};
