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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->index('p_ci');
            $table->foreignId('outlet_id')->nullable()->index('p_oi');
            $table->foreignId('product_type_id')->nullable()->index('p_pti');
            $table->string('name')->nullable()->index('p_n');
            $table->string('unit', 50)->nullable();
            $table->decimal('price', 28, 2)->nullable();
            $table->boolean('fraction_quantity')->nullable()->default(0);
            $table->decimal('minimum_quantity', 10, 2)->nullable();
            $table->decimal('duration_time', 10, 2)->nullable();
            $table->string('duration_type', 15)->nullable();
            $table->boolean('wash')->nullable()->default(1);
            $table->boolean('dry')->nullable()->default(1);
            $table->boolean('iron')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
