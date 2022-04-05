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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('is_active')->default(true);
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('position')->nullable();
            $table->boolean('is_active')->default(true);
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('contacts')->nullable();
            $table->timestamps();
        });

        Schema::create('displays', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable(); 

            $table->string('location')->nullable();

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->integer('width')->nullable();
            $table->integer('height')->nullable();

            $table->integer('width_px')->nullable();
            $table->integer('height_px')->nullable();

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
 
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('duration')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();

            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();

            $table->integer('notify_days')->default(5);
            $table->integer('price')->nullable();
            $table->integer('status')->default(0);
            $table->integer('order_type')->default(0);
            $table->integer('payment_type')->default(0);

            $table->unsignedBigInteger('display_id');
            $table->foreign('display_id')
                ->references('id')
                ->on('displays')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('video_id');
            $table->foreign('video_id')
                ->references('id')
                ->on('videos')
                ->onUpdate('cascade')
                ->onDelete('cascade'); 

            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('countries');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('displays');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('orders');
    }
};
