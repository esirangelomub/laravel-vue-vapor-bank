<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    public function upload(FileUploadRequest $request)
    {
        if ($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
        }
        return response()->json([
            'status' => true,
            'message' => "Document Uploaded successfully!",
            'data' => $filePath ?? null
        ]);
    }
}
