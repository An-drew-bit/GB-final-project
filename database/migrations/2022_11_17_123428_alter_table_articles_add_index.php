<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->fullText(['title', 'description']);
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::table('articles', function (Blueprint $table) {
                $table->dropIndex(['title', 'description']);
            });
        }
    }
};
