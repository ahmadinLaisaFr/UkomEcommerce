<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderrs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('subtotal')->nullable();
            $table->decimal('discount')->default(0)->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('total')->nullable();
            $table->string('complete_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('post_code')->nullable();
            $table->string('city')->nullable();
            $table->enum('status', ['ordered', 'delivered', 'canceled'])->default('ordered')->nullable();
            $table->boolean('ship_diff')->default(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderrs');
    }
};
