<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('influencer_id');
            $table->longText('payment_token')->nullable();
            $table->string('full_name');
            $table->longText('occasion');
            $table->longText('instruction');
            $table->string('delivery_email');
            $table->string('delivery_phone');
            $table->integer('amount');
            $table->string('date')->nullable();
            $table->string('social_media')->nullable();
            $table->string('duration')->nullable();
            $table->longText('video_url')->nullable();
            $table->integer('status')->default(2);
            $table->integer('privacy')->default(0);
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
        Schema::dropIfExists('bookings');
    }
}
