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
        Schema::create('super_admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('opened_by')->nullable()->constrained('super_admins', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->default(1)->constrained( 'super_admins', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('super_admins', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('deleted_by')->nullable()->constrained('super_admins', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('opened_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('super_admins');
    }
};
