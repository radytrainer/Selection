<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('province');
            $table->timestamps();
        });
        DB::table('provinces')->insert(
            array(
                    'id' => 1,
                    'province' => 'Battambang'));

        DB::table('provinces')->insert(
                array(
                    'id' => 2,
                    'province' => 'Kompot'));
        DB::table('provinces')->insert(
                        array(

                    'id' => 3,
                    'province' => 'Kep'));
        DB::table('provinces')->insert(
                        array(
                    'id' => 4,
                    'province' => 'Kompong Chnag'
                        ));
        DB::table('provinces')->insert(
                            array(
                    'id' => 5,
                    'province' => 'Posat'));
        DB::table('provinces')->insert(
                        array(
                    'id' => 6,
                    'province' => 'Pailen'));
        DB::table('provinces')->insert(
                        array(            
                    'id' => 7,
                    'province' => 'Banteay MeanChey'));
        DB::table('provinces')->insert(
                        array(
                    'id' => 8,
                    'province' => 'Siem Reap',
                        ));
        DB::table('provinces')->insert(
                            array(                 
                    'id' => 9,
                    'province' => 'Prey Veng'));
        DB::table('provinces')->insert(
                        array(
                    'id' => 11,
                    'province' => 'Kompong Cham'));
        DB::table('provinces')->insert(
                        array(
                    'id' => 12,
                    'province' => 'Svay Reang'));
        DB::table('provinces')->insert(
                        array(        
                    'id' => 13,
                    'province' => 'Takeo'));
        DB::table('provinces')->insert(
                        array(            
                    'id' => 14,
                    'province' => 'Kandal'));
        DB::table('provinces')->insert(
                        array(            
                    'id' => 15,
                    'province' => 'Kompong Speu'));
        DB::table('provinces')->insert(
                        array(                
                    'id' => 16,
                    'province' => 'Kratie'));
        DB::table('provinces')->insert(
                        array(
                    'id' => 17,
                    'province' => 'Steng Treng'));
        DB::table('provinces')->insert(
                        array(            
                    'id' => 18,
                    'province' => 'Mondol Kiri'));
        DB::table('provinces')->insert(
                        array(             
                    'id' => 19,
                    'province' => 'Preah Vihea'
                        ));
        DB::table('provinces')->insert(
                            array(                 
                    'id' => 20,
                    'province' => 'Ratanak Kiri'));
        DB::table('provinces')->insert(
                        array(              
                    'id' => 21,
                    'province' => 'Koh Kong'));
        DB::table('provinces')->insert(
                        array(             
                    'id' => 22,
                    'province' => 'Oudor Meanchey'));
        DB::table('provinces')->insert(
                        array(             
                    'id' => 23,
                    'province' => 'Preah Sey Hanuk'));
        DB::table('provinces')->insert(
                        array(             
                    'id' => 24,
                    'province' => 'Tbong Kmom'));
        DB::table('provinces')->insert(
                        array(              
                    'id' => 25,
                    'province' => 'Kompong Thom',

                        ));
     


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('province');
    }
}
