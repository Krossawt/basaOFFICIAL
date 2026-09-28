<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Table: dropdown_data
     *   dropdown_data_no    – VARCHAR primary key, auto-incremented via sequence
     *   from_dropdown_no    – FK → dropdowns.dropdown_no
     *   dropdown_data_name  – VARCHAR(25) item label
     */
    public function up(): void
    {
        // Sequence that powers the auto-increment for dropdown_data_no
        DB::statement("CREATE SEQUENCE IF NOT EXISTS dropdown_data_seq START 1 INCREMENT 1");

        Schema::create('dropdown_data', function (Blueprint $table) {
            // Primary key – value filled by model boot from the sequence
            $table->string('dropdown_data_no', 20)->primary();

            // Foreign key back to the parent dropdown
            $table->string('from_dropdown_no', 20);
            $table->foreign('from_dropdown_no')
                ->references('dropdown_no')
                ->on('dropdowns')
                ->onDelete('cascade');

            $table->string('dropdown_data_name', 25);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dropdown_data');
        DB::statement("DROP SEQUENCE IF EXISTS dropdown_data_seq");
    }
};

