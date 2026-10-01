<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class DropdownData extends Model
{
    protected $table = 'dropdown_data';

    /**
     * dropdown_data_official_no is now the true primary key.
     * It is globally unique (DDT-0001, DDT-0002, …).
     */
    protected $primaryKey = 'dropdown_data_official_no';

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'from_dropdown_no',
        'dropdown_data_name',
        // dropdown_data_no and dropdown_data_official_no are generated in boot
    ];

    public function dropdown(): BelongsTo
    {
        return $this->belongsTo(Dropdown::class, 'from_dropdown_no', 'dropdown_no');
    }

    protected static function booted(): void
    {
        static::creating(function (self $dropdownData): void {
            // ── 1. Assign global primary key: DDT-0001, DDT-0002, … ──────────
            if (blank($dropdownData->dropdown_data_official_no)) {
                $globalSeq = DB::scalar("SELECT nextval('dropdown_data_official_seq')");
                $dropdownData->dropdown_data_official_no =
                    'DDT-' . str_pad((string) $globalSeq, 4, '0', STR_PAD_LEFT);
            }

            // ── 2. Assign scoped key: DDT-{parent_4}-{local_4} ───────────────
            if (blank($dropdownData->dropdown_data_no)) {
                // Derive the 4-digit parent number from the owning dropdown's dropdown_no
                // e.g. "DD-0002" → "0002"
                $parentNo = $dropdownData->from_dropdown_no; // e.g. "DD-0002"
                $parentPart = str_pad(
                    (string) (int) substr($parentNo, strrpos($parentNo, '-') + 1),
                    4,
                    '0',
                    STR_PAD_LEFT
                );

                // Count existing items for this dropdown to determine local sequence
                $localSeq = static::where('from_dropdown_no', $dropdownData->from_dropdown_no)->count() + 1;
                $localPart = str_pad((string) $localSeq, 4, '0', STR_PAD_LEFT);

                $dropdownData->dropdown_data_no = "DDT-{$parentPart}-{$localPart}";
            }
        });
    }
}
