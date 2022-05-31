<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'duration',
        'level',
    ];

    public function dev(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Dev::class);
    }

}
