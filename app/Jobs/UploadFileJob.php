<?php

namespace App\Jobs;

use App\Enum\UploadStatus;
use App\Imports\FileUploadsImport;
use App\Models\FileData;
use App\Models\FileUpload;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

class UploadFileJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private FileUpload $fileUpload)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        try {
            (new FileUploadsImport($this->fileUpload))
                ->queue($this->fileUpload->path, 'csv_import', Excel::CSV)
                ->chain([new NotifyCompletedImport($this->fileUpload)]);
        } catch (ValidationException|Throwable $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
              Log::error("Row {$failure->row()}: {$failure->errors()} ");
            }
            $this->fileUpload->update(['status' => UploadStatus::Failed]);
        }

    }


}
