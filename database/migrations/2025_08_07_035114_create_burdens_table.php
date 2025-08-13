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
        Schema::create('burdens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estimation_id')->constrained('estimations')->onDelete('cascade');
            $table->string('number')->unique();
            $table->date('date');
            $table->date('date_expired');
            $table->decimal('total', 15, 2);
            $table->text('description')->nullable();
            $table->enum('status', ['Pending', 'Success'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('burdens');
    }
};
