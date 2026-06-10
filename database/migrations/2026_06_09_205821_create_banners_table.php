<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Banners y promociones para el home del ecommerce.
     * Ej: "2x1 en cappuccinos los martes", "Nueva temporada de bebidas frías"
     */
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('mobile_image')->nullable();      // versión optimizada para móvil
            $table->string('cta_text')->nullable();          // texto del botón
            $table->string('cta_url')->nullable();           // url del botón
            $table->enum('position', ['hero', 'sidebar', 'popup', 'strip'])->default('hero');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('is_active');
            $table->index('position');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
