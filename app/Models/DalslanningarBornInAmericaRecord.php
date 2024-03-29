<?php

namespace App\Models;

use App\Traits\RecordCount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Models\Archive;

class DalslanningarBornInAmericaRecord extends Model
{

    use HasFactory, Searchable, RecordCount;

    protected $fillable = [
        'user_id',
        'archive_id',
        'old_id',
        'last_name',
        'first_name',
        'birth_date',
        'birth_place',
        'death_date',
        'death_place',
        'profession',
        'source_nr',
        'comments',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}
