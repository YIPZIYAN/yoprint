<?php

namespace App\Jobs;

use App\Enum\UploadStatus;
use App\Imports\FileUploadsImport;
use App\Models\FileData;
use App\Models\FileUpload;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Validators\ValidationException;

class UploadFileJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $file, public $fileName)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $fileUpload = FileUpload::create([
            'name' => $this->fileName,
        ]);

        try {
            (new FileUploadsImport($fileUpload))->queue($this->file, null, Excel::CSV)->chain([
                new NotifyCompletedImport($fileUpload)
            ]);
        } catch (ValidationException $e) {
            $fileUpload->update(['status' => UploadStatus::Failed]);
        }

    }

//            $fileUpload->status = UploadStatus::Completed;
//        } catch (\Exception $e) {
//            $fileUpload->status = UploadStatus::Failed;
//        } finally {
//            $fileUpload->save();
//        }


}
