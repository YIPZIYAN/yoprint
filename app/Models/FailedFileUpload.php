<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedFileUpload extends Model
{
    /** @use HasFactory<\Database\Factories\FailedFileUploadFactory> */
    use HasFactory;

    protected $fillable = ['row', 'remark'];
}
