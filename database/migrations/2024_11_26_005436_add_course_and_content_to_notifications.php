<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('notifications', function (Blueprint $table) {
        $table->string('title')->nullable()->after('user_id');
        $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('cascade');
        $table->foreignId('content_id')->nullable()->constrained('contents')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('notifications', function (Blueprint $table) {
        $table->dropForeign(['course_id']);
        $table->dropForeign(['content_id']);
        $table->dropColumn(['course_id', 'content_id']);
    });
}

};
