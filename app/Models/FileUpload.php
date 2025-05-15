<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FileUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'hash',
        'status',
    ];

    public function failedFileUploads(): HasMany
    {
        return $this->hasMany(FailedFileUpload::class);
    }

}
