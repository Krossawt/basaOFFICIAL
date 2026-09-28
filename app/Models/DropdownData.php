<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class DropdownData extends Model
{
    protected $table = 'dropdown_data';

    protected $primaryKey = 'dropdown_data_no';

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = ['from_dropdown_no', 'dropdown_data_name'];

    public function dropdown(): BelongsTo
    {
        return $this->belongsTo(Dropdown::class, 'from_dropdown_no', 'dropdown_no');
    }

    protected static function booted(): void
    {
        static::creating(function (self $dropdownData): void {
            if (filled($dropdownData->dropdown_data_no)) {
                return;
            }

            $number = DB::scalar("SELECT nextval('dropdown_data_seq')");
            $dropdownData->dropdown_data_no = 'DDT-' . str_pad((string) $number, 4, '0', STR_PAD_LEFT);
        });
    }
}
