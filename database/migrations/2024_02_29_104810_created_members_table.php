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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_id');
            $table->unsignedBigInteger('type_member_id');
            $table->string('naam');
            $table->date('geboortedatum');

            $table->foreign('family_id')->references('id')->on('families');
            $table->foreign('type_member_id')->references('id')->on('type_members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
