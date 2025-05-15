<?php

namespace App\Http\Controllers;

use App\Models\FailedFileUpload;
use App\Http\Requests\StoreFailedFileUploadRequest;
use App\Http\Requests\UpdateFailedFileUploadRequest;

class FailedFileUploadController extends Controller
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
    public function store(StoreFailedFileUploadRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FailedFileUpload $failedFileUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FailedFileUpload $failedFileUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFailedFileUploadRequest $request, FailedFileUpload $failedFileUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FailedFileUpload $failedFileUpload)
    {
        //
    }
}
