<?php

namespace App\Livewire;

use App\Jobs\UploadFileJob;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class UploadFileInput extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public ?TemporaryUploadedFile $file = null;

    #[Validate('unique:file_uploads,hash',
        message: 'This file has already been uploaded and processed.')]
    public string $hash;

    public function render()
    {
        return view('livewire.upload-file-input');
    }

    public function save(): void
    {
        $this->hash = hash_file('sha256', $this->file->getRealPath());
        $this->validate();

        $fileUpload = $this->saveFile();
        UploadFileJob::dispatch($fileUpload);
    }

    /**
     * @return FileUpload
     */
    public function saveFile(): FileUpload
    {
        $fileName = now()->timestamp . '_' . uniqid() . '.' . $this->file->guessExtension();
        $this->file->storeAs('', $fileName, 'csv_import');
        return FileUpload::create([
            'name' => $this->file->getClientOriginalName(),
            'path' => $fileName,
            'hash' => $this->hash,
        ]);
    }
}
