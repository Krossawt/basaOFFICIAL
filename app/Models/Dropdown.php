<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Dropdown extends Model
{
    protected $table = 'dropdowns';

    protected $primaryKey = 'dropdown_no';

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'dropdown_Name',
        'dropdown_status',
        'is_roles_dropdown',
        'is_permissions_dropdown',
    ];

    protected $casts = [
        'dropdown_status'         => 'boolean',
        'is_roles_dropdown'       => 'boolean',
        'is_permissions_dropdown' => 'boolean',
    ];

    public function data(): HasMany
    {
        return $this->hasMany(DropdownData::class, 'from_dropdown_no', 'dropdown_no');
    }

    protected static function booted(): void
    {
        static::creating(function (self $dropdown): void {
            if (filled($dropdown->dropdown_no)) {
                return;
            }

            $number = DB::scalar("SELECT nextval('dropdowns_seq')");
            $dropdown->dropdown_no = 'DD-' . str_pad((string) $number, 4, '0', STR_PAD_LEFT);
        });
    }
}
