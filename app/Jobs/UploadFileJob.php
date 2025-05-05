<?php

namespace App\Jobs;

use App\Enum\UploadStatus;
use App\Models\FileData;
use App\Models\FileUpload;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class UploadFileJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $file)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fileUpload = FileUpload::create([
            'name' => $this->file,
        ]);

        $fileUpload->status = UploadStatus::Processing;
        $fileUpload->save();

        try {
            $csv = Reader::createFromPath($this->file);
            $csv->setHeaderOffset(0);
            $records = iterator_to_array($csv->getRecords());
            FileData::upsert($records, 'unique_key',
                array_diff(array_keys($records[0]), ['unique_key']));
            $fileUpload->status = UploadStatus::Completed;
        } catch (\Exception $e) {
            $fileUpload->status = UploadStatus::Failed;
        }

    }
}
