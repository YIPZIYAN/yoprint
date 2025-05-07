<?php

namespace App\Livewire;

use App\Http\Resources\FileUploadResource;
use App\Models\FileUpload;
use Livewire\Component;

class FileUploadTable extends Component
{
    public function render()
    {
        return view('livewire.file-upload-table',[
            'fileUploads' => FileUploadResource::collection(FileUpload::all())->toArray(request())
        ]);
    }
}
