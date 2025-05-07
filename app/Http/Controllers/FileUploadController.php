<?php

namespace App\Http\Controllers;

use App\Enum\UploadStatus;
use App\Jobs\UploadFileJob;
use App\Models\FileUpload;
use App\Http\Requests\StoreFileUploadRequest;
use App\Http\Requests\UpdateFileUploadRequest;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileUploadRequest $request)
    {
        $fileName = now()->format('Ymd_His') . '_' . $request->file('csvFile')->getClientOriginalName();
        UploadFileJob::dispatch(
            $request->file('csvFile')->storeAs('files', $fileName),
            $fileName);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileUploadRequest $request, FileUpload $fileUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FileUpload $fileUpload)
    {
        //
    }
}
