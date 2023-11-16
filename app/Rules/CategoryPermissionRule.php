<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\CategoryUserPermission;

class CategoryPermissionRule implements ValidationRule
{
    protected $userId;
    protected $categoryId;
    protected $requiredPermission;

    public function __construct($userId, $categoryId, $requiredPermission)
    {
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->requiredPermission = $requiredPermission;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userPermissions = CategoryUserPermission::getUserPermission($this->userId, $this->categoryId);

        if($userPermissions === null || $userPermissions === 0 || !CategoryUserPermission::hasPermission($userPermissions, $this->requiredPermission)){
            $fail('The user does not have the required permissions for this action.');
        }
    }
}
