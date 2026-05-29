<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('origin')->default('Arab Saudi');
            $table->text('description');
            $table->string('price');
            $table->string('old_price')->nullable();
            $table->string('badge_label')->default('');
            $table->string('badge_class')->default('bg-yellow-500 text-emerald-950');
            $table->string('image_url');
            $table->text('wa_text');
            $table->string('btn_class')->default('bg-emerald-900 hover:bg-emerald-800 text-white');
            $table->string('unit')->default('per 500 gram');
            $table->boolean('is_featured')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
