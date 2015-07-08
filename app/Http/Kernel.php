<?php
namespace VirtualProject\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession'
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'csrf' => 'VirtualProject\Http\Middleware\VerifyCsrfToken',
        'auth' => 'VirtualProject\Http\Middleware\Authenticate',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest' => 'VirtualProject\Http\Middleware\RedirectIfAuthenticated',
        'acl' => 'Kodeine\Acl\Middleware\HasPermission',
        'manager' => 'VirtualProject\Http\Middleware\CheckIsManager',
        'check_delete' => 'VirtualProject\Http\Middleware\CheckDeleteMember',
        'direct_access' => 'VirtualProject\Http\Middleware\CheckDirectAccess',
        'is_disabled' => 'VirtualProject\Http\Middleware\CheckUserDisabled',
        'check_edit' => 'VirtualProject\Http\Middleware\CheckUserHasEdit'
    ];
}
