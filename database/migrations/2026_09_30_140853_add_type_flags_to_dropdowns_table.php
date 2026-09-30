<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds two boolean flags to the dropdowns table:
     *   is_roles_dropdown       – marks this dropdown as a Roles Dropdown
     *   is_permissions_dropdown – marks this dropdown as a Permissions Dropdown
     */
    public function up(): void
    {
        Schema::table('dropdowns', function (Blueprint $table) {
            $table->boolean('is_roles_dropdown')
                  ->default(false)
                  ->comment('true = this dropdown is used as a Roles Dropdown')
                  ->after('dropdown_status');

            $table->boolean('is_permissions_dropdown')
                  ->default(false)
                  ->comment('true = this dropdown is used as a Permissions Dropdown')
                  ->after('is_roles_dropdown');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dropdowns', function (Blueprint $table) {
            $table->dropColumn(['is_roles_dropdown', 'is_permissions_dropdown']);
        });
    }
};
