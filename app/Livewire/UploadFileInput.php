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
    public string $hash;

    public function render()
    {
        return view('livewire.upload-file-input');
    }

    public function save()
    {
        $this->hash = hash_file('sha256', $this->file->getRealPath());
        $isSameHash = FileUpload::where('hash', $this->hash)->first();
        if ($isSameHash != null) {
            $this->validate(['hash' => 'unique:file_uploads,hash'],
                ['hash.unique' => 'This file has already been uploaded and processed.',]);
        }

        $fileName = now()->timestamp . '_' . uniqid() . '.' . $this->file->guessExtension();
        $this->file->storeAs('', $fileName, "csv_import");
        FileUpload::create([
            'name' => $this->file->getClientOriginalName(),
            'path' => $fileName,
            'hash' => $this->hash,
        ]);

//        UploadFileJob::dispatch();
    }
}
