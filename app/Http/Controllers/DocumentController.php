<?php

namespace App\Http\Controllers;

use App\Models\CategoryUserPermission;
use App\Models\Document;
use App\Rules\CategoryPermissionRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function download(int $documentId)
    {
        $document = Document::find($documentId);
        
        $path = "public/uploads/{$document->user_id}/{$document['category_id']}/{$document['version_name']}";
        $userPermission = CategoryUserPermission::getUserPermission($document->user_id, $document['category_id']);

        if (Storage::exists($path) && CategoryUserPermission::hasPermission($userPermission, CategoryUserPermission::DOWNLOAD)) {
            return Storage::download($path);
        }
        
        abort(403);
    }
}   
