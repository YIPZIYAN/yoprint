<?php

namespace App\Livewire;

use App\Models\FileUpload;
use Livewire\Component;

class FileUploadTable extends Component
{
    public function render()
    {
        return view('livewire.file-upload-table',[
            'fileUploads' => FileUpload::all()
        ]);
    }
}
