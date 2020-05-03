<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('address')->nullable();
            $table->integer('category_id')->default(1);
            $table->integer('sub_category_id')->default(1);
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('snap_url')->nullable();
            $table->string('website_url')->nullable();
            $table->longText('profile_image_url')->nullable();
            $table->longText('profile_video_url')->nullable();
            $table->longText('tags')->nullable();
            $table->integer('rate')->default(0);
            $table->bigInteger('profile_visit')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
