<?php

namespace App\Imports;

use App\Models\FileData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class FileUploadsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts, WithChunkReading, ShouldQueue, WithCustomCsvSettings
{
    use Importable;

    public function model(array $row): FileData
    {
        return new FileData([
            'unique_key' => $row['unique_key'],
            'size' => $row['size'],
            'style' => $row['style'],
            'product_title' => $row['product_title'],
            'product_description' => $row['product_description'],
            'color_name' => $row['color_name'],
            'sanmar_mainframe_color' => $row['sanmar_mainframe_color'],
            'piece_price' => $row['piece_price'],
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
}
