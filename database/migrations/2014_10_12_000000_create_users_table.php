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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->default('default.jpg');
            $table->rememberToken();
            $table->timestamps();
            $table->smallInteger('user_role')->default(1);
            $table->smallInteger('user_has_department')->default(1);
            $table->smallInteger('user_has_role')->default(1);
        });
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->smallInteger('Owner');
        });
        DB::table('users')->insert([
            'id'  => 0,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('asd321asd'),
            'user_role' => 0,
            'user_has_department' => 0,
            'user_has_role' => 0,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('departments');
    }
}
