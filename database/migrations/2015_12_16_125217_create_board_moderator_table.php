<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBoardModeratorTable
 *
 */
class CreateBoardModeratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_moderator', function (Blueprint $table) {
            $table->integer('board_id')->unsigned();
            $table->integer('moderator_id')->unsigned();

            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
            $table->foreign('moderator_id')->references('id')->on('moderators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('board_moderator');
    }

}
