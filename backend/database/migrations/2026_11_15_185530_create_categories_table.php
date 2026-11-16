<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->cascadeOnUpdate()->nullOnDelete();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text("new_text")->nullable();
            $table->string('icon_url')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement('
            ALTER TABLE categories
            ADD CONSTRAINT chk_parent_not_self
            CHECK ( parent_id IS NULL
                OR parent_id <> id
                )
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
