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
     * Table: dropdowns
     *   dropdown_no       – VARCHAR primary key, auto-incremented via sequence (DD-0001 style)
     *   dropdown_Name     – VARCHAR(25) display name
     *   dropdown_status   – BOOLEAN  (true = Active, false = Inactive), default true
     *   dropdown_created_on / dropdown_updated_on – timestamps
     */
    public function up(): void
    {
        // Sequence that powers the auto-increment for dropdown_no
        DB::statement("CREATE SEQUENCE IF NOT EXISTS dropdowns_seq START 1 INCREMENT 1");

        Schema::create('dropdowns', function (Blueprint $table) {
            // VARCHAR primary key – value filled by model boot from the sequence
            $table->string('dropdown_no', 20)->primary();
            $table->string('dropdown_Name', 25);
            $table->boolean('dropdown_status')->default(true)->comment('true = Active, false = Inactive');
            $table->timestamp('dropdown_created_on')->useCurrent();
            $table->timestamp('dropdown_updated_on')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dropdowns');
        DB::statement("DROP SEQUENCE IF EXISTS dropdowns_seq");
    }
};

