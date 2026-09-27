<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'guard_name',
        'roleID',
        'roleName',
        'canCreate',
        'canRead',
        'canUpdate',
        'canDelete',
        'canPrint',
        'canImport',
        'canExport',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'canCreate' => 'boolean',
        'canRead'   => 'boolean',
        'canUpdate' => 'boolean',
        'canDelete' => 'boolean',
        'canPrint'  => 'boolean',
        'canImport' => 'boolean',
        'canExport' => 'boolean',
    ];

    /**
     * Boot the model and auto-generate roleID on creation.
     * Format: Role-001, Role-002, Role-003, ...
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Role $role) {
            if (empty($role->roleID)) {
                $latest = static::withoutGlobalScopes()
                    ->whereNotNull('roleID')
                    ->orderByDesc('id')
                    ->value('roleID');

                $nextNumber = 1;

                if ($latest && preg_match('/Role-(\d+)/', $latest, $matches)) {
                    $nextNumber = (int) $matches[1] + 1;
                }

                $role->roleID = 'Role-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
