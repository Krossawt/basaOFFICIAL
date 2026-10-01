<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Restructure dropdown_data:
     *
     *   dropdown_data_official_no  – New VARCHAR primary key (DDT-0001, DDT-0002, …)
     *                                 Auto-incremented via dropdown_data_official_seq.
     *                                 Globally unique across all dropdowns.
     *
     *   dropdown_data_no           – Changed from PK to a scoped label
     *                                 (DDT-0001-0001, DDT-0001-0002, …).
     *                                 Format: DDT-{parent_seq_4}-{local_seq_4}
     *                                 The parent part mirrors the dropdowns_seq counter
     *                                 for the owning dropdown; the local part is scoped
     *                                 per dropdown.
     */
    public function up(): void
    {
        // 1. Sequence for the new global primary key
        DB::statement("CREATE SEQUENCE IF NOT EXISTS dropdown_data_official_seq START 1 INCREMENT 1");

        // 2. Drop the existing primary-key constraint on dropdown_data_no
        //    (PostgreSQL names it <table>_pkey by convention)
        DB::statement("ALTER TABLE dropdown_data DROP CONSTRAINT IF EXISTS dropdown_data_pkey");

        // 3. Add the new primary-key column (nullable first so existing rows are unaffected)
        Schema::table('dropdown_data', function (Blueprint $table) {
            $table->string('dropdown_data_official_no', 20)->nullable()->first();
        });

        // 4. Backfill existing rows with sequential official numbers
        DB::statement("
            UPDATE dropdown_data
            SET dropdown_data_official_no = 'DDT-' || LPAD(nextval('dropdown_data_official_seq')::text, 4, '0')
            WHERE dropdown_data_official_no IS NULL
        ");

        // 5. Make the column NOT NULL and add the primary key
        DB::statement("ALTER TABLE dropdown_data ALTER COLUMN dropdown_data_official_no SET NOT NULL");
        DB::statement("ALTER TABLE dropdown_data ADD PRIMARY KEY (dropdown_data_official_no)");

        // 6. Backfill dropdown_data_no into the new DDT-XXXX-YYYY format
        //    using a window ROW_NUMBER() partitioned by from_dropdown_no,
        //    combined with the parent dropdown's sequence number extracted from dropdown_no.
        DB::statement("
            UPDATE dropdown_data dd
            SET dropdown_data_no =
                'DDT-' ||
                LPAD(SUBSTRING(d.dropdown_no FROM 4)::integer::text, 4, '0') ||
                '-' ||
                LPAD(rn.local_seq::text, 4, '0')
            FROM (
                SELECT
                    dropdown_data_official_no,
                    from_dropdown_no,
                    ROW_NUMBER() OVER (PARTITION BY from_dropdown_no ORDER BY dropdown_data_no) AS local_seq
                FROM dropdown_data
            ) rn
            JOIN dropdowns d ON d.dropdown_no = rn.from_dropdown_no
            WHERE dd.dropdown_data_official_no = rn.dropdown_data_official_no
        ");
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        // 1. Restore dropdown_data_no as primary key
        DB::statement("ALTER TABLE dropdown_data DROP CONSTRAINT IF EXISTS dropdown_data_pkey");
        DB::statement("ALTER TABLE dropdown_data ADD PRIMARY KEY (dropdown_data_no)");

        // 2. Drop the official_no column
        Schema::table('dropdown_data', function (Blueprint $table) {
            $table->dropColumn('dropdown_data_official_no');
        });

        // 3. Drop the sequence
        DB::statement("DROP SEQUENCE IF EXISTS dropdown_data_official_seq");
    }
};
