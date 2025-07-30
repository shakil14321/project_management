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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('client');
            $table->string('number');
            $table->string('email');
            $table->string('company_address')->nullable();
            $table->text('details')->nullable();
            $table->json('project_type')->nullable();
            $table->text('proposal')->nullable(); // PDF file path
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('project_type');
    });
    }
};
