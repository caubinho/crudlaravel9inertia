<?php

namespace App\Services;

use App\Tenant\ManagerTenant;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadFile
{
    public function store(UploadedFile $file, string $path): string
    {
        $uuid = app(ManagerTenant::class)->getTenantIdentify();

        return $file->store($uuid.'/'.$path);
    }

    public function storeAs(UploadedFile $file, string $path, string $customName): string
    {
        $uuid = app(ManagerTenant::class)->getTenantIdentify();

        return $file->storeAs($uuid.'/'.$path, $customName);

    }

    public function removeFile(string $filePath): bool
    {
        if(Storage::exists($filePath))
            return Storage::delete($filePath);

        return false;
    }
}
