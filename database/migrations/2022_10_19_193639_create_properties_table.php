<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->unsignedSmallInteger('property_type_id')->index();
            $table->string('county')->index();
            $table->string('country')->index();
            $table->string('town')->index();
            $table->text('description');
            $table->string('address')->index();
            $table->string('image_full');
            $table->string('image_thumbnail');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->unsignedSmallInteger('num_bedrooms');
            $table->unsignedSmallInteger('num_bathrooms');
            $table->unsignedBigInteger('price');
            $table->string('type')->index();
            $table->timestamps();
        });

        if (App::environment('local', 'testing')) {
            // Call seeder
            Artisan::call(
                'db:seed',
                [
                    '--class' => 'PropertySeeder',
                    '--force' => true,
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
