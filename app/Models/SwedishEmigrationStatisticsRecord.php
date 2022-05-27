<?php

namespace App\Models;

use App\Traits\RecordCount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SwedishEmigrationStatisticsRecord extends Model
{
    use HasFactory, Searchable, RecordCount;

    protected $fillable = [
        'user_id',
        'archive_id',
        'source',
        'svar_batch_number',
        'svar_image_number',
        'from_year',
        'from_province',
        'from_parish',
        'gender',
        'civil_status',
        'last_name',
        'first_name',
        'profession',
        'birth_year',
        'birth_month',
        'birth_day',
        'destination',
        'comments',
        'family_number',
        'nationality',
    ];

    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }

        public function toSearchableArray()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'from_province' => $this->from_province,
            'from_parish' => $this->from_parish,
            'last_resident' => $this->last_resident,
            'profession' => $this->profession,
            'destination' => $this->destination,

            ];
    }
}