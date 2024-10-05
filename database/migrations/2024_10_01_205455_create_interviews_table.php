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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('application_id'); 
            $table->unsignedBigInteger('applicant_id'); 
            $table->enum('status', ['scheduled','assigned', 'completed', 'canceled'])->default('scheduled'); 
            $table->text('agent_remarks')->nullable(); 
            $table->text('employer_remarks')->nullable(); 
            $table->date('interview_date'); 
            $table->timestamps(); 

            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
