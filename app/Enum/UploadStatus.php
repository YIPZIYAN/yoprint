<?php

namespace App\Enum;

enum UploadStatus: string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Failed = 'failed';
    case Completed = 'completed';
}
