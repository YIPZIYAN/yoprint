<?php

namespace App\Livewire;

use App\Jobs\UploadFileJob;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    #[Validate('required|file|mimes:csv', onUpdate: false)]
    public $file;

    public function save()
    {
        $this->validate();
        UploadFileJob::dispatch($this->file->store('files'));
    }

    public function render()
    {
        return view('livewire.file-upload', [
            'fileUploads' => \App\Models\FileUpload::all(), //add resource here
        ]);
    }
}
