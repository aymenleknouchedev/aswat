<?php

namespace App\Enums;

enum CacheKeys: string
{
    case CATEGORIES = 'categories';
    case PERMISSIONS = 'permissions';
    case ROLES = 'roles';
    case PAGES = 'pages';
    case SECTIONS = 'sections';
}
