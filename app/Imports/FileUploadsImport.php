<?php

namespace App\Imports;

use App\Enum\UploadStatus;
use App\Models\FileData;
use App\Models\FileUpload;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\ImportFailed;
use function PHPUnit\Framework\isString;

class FileUploadsImport implements ToModel, WithHeadingRow, WithBatchInserts,
    WithUpserts, WithChunkReading, ShouldQueue, WithCustomCsvSettings, WithEvents
{
    use Importable;

    public function __construct(public FileUpload $fileUpload)
    {
    }

    public function model(array $row): FileData
    {
        $cleanedRow = $this->getCleanedRow($row);

        return new FileData([
            'unique_key' => $cleanedRow['unique_key'],
            'size' => $cleanedRow['size'],
            'style' => $cleanedRow['style'],
            'product_title' => $cleanedRow['product_title'],
            'product_description' => $cleanedRow['product_description'],
            'color_name' => $cleanedRow['color_name'],
            'sanmar_mainframe_color' => $cleanedRow['sanmar_mainframe_color'],
            'piece_price' => $cleanedRow['piece_price'],
        ]);
    }

    public function batchSize(): int
    {
        return 3000;
    }

    public function uniqueBy()
    {
        return 'unique_key';
    }

    public function chunkSize(): int
    {
        return 3000;
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'UTF-8'
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $this->fileUpload->update(['status' => UploadStatus::Processing]);
            },
            ImportFailed::class => function (ImportFailed $event) {
                $this->fileUpload->update(['status' => UploadStatus::Failed]);
            },
        ];
    }

    /**
     * @param array $row
     * @return array|array[]|null[]|string[]|\string[][]
     */
    public function getCleanedRow(array $row): array
    {
        return array_map(function ($value) {
            if (is_string($value)) {
                return preg_replace('/[^\x20-\x7E]/', '', $value);
            }
            return $value;
        }, $row);
    }
}
