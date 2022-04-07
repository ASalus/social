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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('video')->after('image')->nullable();
            $table->json('mentions')->after('video')->nullable();
            $table->json('tags')->after('mentions')->nullable();
            $table->boolean('to_post')->after('tags')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('video');
            $table->dropColumn('mentions');
            $table->dropColumn('tags');
            $table->dropColumn('to_post');
        });
    }
};
