<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Shop;
class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('floor');
            $table->boolean('lot_no');
            $table->timestamps();
        });

        Shop::create([
            'name' => 'Midvelly',
            'floor' => '10',
            'lot_no' => '10-8',
            ]);

       Shop::create([
            'name' => 'KLCC',
            'floor' => '11',
            'lot_no' => '12-1',
            ]);

       Shop::create([
            'name' => 'Quill',
            'floor' => '12',
            'lot_no' => '9-2',
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shops');
    }
}
