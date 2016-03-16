<?php

use Illuminate\Database\Migrations\Migration;

/**
 * Class EditUserIdColumnToNullableInCommentVotesTable
 *
 */
class EditUserIdColumnToNullableInCommentVotesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `comment_votes` CHANGE `user_id` `user_id` INT(10) UNSIGNED NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `comment_votes` CHANGE `user_id` `user_id` INT(10) UNSIGNED NOT NULL;");
    }

}
