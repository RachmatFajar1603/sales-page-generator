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
        Schema::create('sales_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('product_name');
            $table->string('target_audience');
            $table->decimal('price', 10, 2)->nullable();
            $table->text('description');
            $table->text('key_features')->nullable();
            $table->text('unique_selling_points')->nullable();
            $table->string('tone')->default('persuasive');
            $table->string('template')->default('modern');
            $table->longText('generated_content')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_pages');
    }
};
