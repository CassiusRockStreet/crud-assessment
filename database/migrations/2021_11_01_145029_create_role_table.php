<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('role')->nullable();
            $table->string('alphabets')->nullable();
            $table->string('numbers')->nullable();
            $table->integer('length')->nullable();
            $table->timestamps();
            $table->string('is_admin')->nullable();
        });
        // Insert some stuff
        DB::table('role')->insert(
            array(
            'role' => 'admin',
            'numbers' => 'on',
            'alphabets' => 'on',
            'length' => 8,
            'is_admin' => 'on'
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
}
