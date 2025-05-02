<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['hotel', 'hostel']);
            $table->text('description');
            $table->string('address');
            $table->string('city');
            $table->string('photo1');
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();
            $table->string('proof_document')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
