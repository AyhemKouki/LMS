<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['instructor_id']);

            $table->renameColumn('instructor_id', 'user_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('admin_id')->references('id')->on('admins')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['admin_id']);

            $table->renameColumn('user_id', 'instructor_id');
            $table->dropColumn('admin_id');

            // Re-add the original foreign key
            $table->foreign('instructor_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }
};
