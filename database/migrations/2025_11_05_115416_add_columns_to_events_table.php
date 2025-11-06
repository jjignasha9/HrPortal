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
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events','title')) $table->string('title')->after('id');
            if (!Schema::hasColumn('events','description')) $table->text('description')->nullable()->after('title');
            if (!Schema::hasColumn('events','event_date')) $table->date('event_date')->nullable()->after('description');
            if (!Schema::hasColumn('events','media_paths')) $table->json('media_paths')->nullable()->after('event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            foreach (['media_paths','event_date','description','title'] as $col) {
                if (Schema::hasColumn('events',$col)) $table->dropColumn($col);
            }
        });
    }
};
