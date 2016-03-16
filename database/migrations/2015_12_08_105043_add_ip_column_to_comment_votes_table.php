<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddIpColumnToCommentVotesTable
 *
 */
class AddIpColumnToCommentVotesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comment_votes', function (Blueprint $table) {
            $table->integer('ip')->after('type')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comment_votes', function (Blueprint $table) {
            $table->dropColumn('ip');
        });
    }

}
