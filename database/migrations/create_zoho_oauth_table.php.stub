<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZohoOauthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoho_oauth', function (Blueprint $table) {
            $table->id();
            $table->string('refresh_token')->index();
            $table->string('access_token')->unique();
            $table->timestamp('expires_at');
            $table->string('token_type')->nullable();
            $table->string('api_domain')->nullable();
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
        Schema::dropIfExists('zoho_oauth');
    }
}
