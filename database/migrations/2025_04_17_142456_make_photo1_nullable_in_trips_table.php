<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->string('photo1')->nullable()->change();
        });
    }

    
    public function down(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->string('photo1')->nullable(false)->change();
        });
    }
};
