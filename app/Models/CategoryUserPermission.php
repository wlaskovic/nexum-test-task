<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryUserPermission extends Model
{
    public $fillable = ['category_id', 'user_id', 'permissions'];

    const NONE = 0;
    const UPLOAD = 2;
    const DOWNLOAD = 4;
    const BOTH = 6;
    const CORE_PERMISSION = 20;

    public static function calculatePermission(array $permissions): int
    {
        $result = self::NONE;

        foreach ($permissions as $permission) {
            $result |= $permission;
        }

        return $result;
    }

    public static function revertPermissions(?int $categoryPermission): array
    {
        if (is_null($categoryPermission)) {
            return [];
        }
        
        $permissions = [];

        if (($categoryPermission & self::UPLOAD) === self::UPLOAD) {
            $permissions[] = self::UPLOAD;
        }

        if (($categoryPermission & self::DOWNLOAD) === self::DOWNLOAD) {
            $permissions[] = self::DOWNLOAD;
        }

        return $permissions;
    }

    public static function hasPermission(int $userPermission, int $requiredPermission): bool
    {
        return ($userPermission & $requiredPermission) === $requiredPermission;
    }

    public static function getUserPermission(int $userId, int $categoryId): ?int
    {
        $permission = self::where('user_id', $userId)
            ->where('category_id', $categoryId)
            ->value('permissions');

            return $permission;
    }

    
}
