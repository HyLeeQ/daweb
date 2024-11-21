<!-- <?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        // Các middleware toàn cục
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // Định nghĩa middleware cho các route cụ thể ở đây
        'admin' => \App\Http\Middleware\CheckAdmin::class,
        'teacher' => \App\Http\Middleware\CheckTeacher::class,
        'parent' => \App\Http\Middleware\CheckParent::class,
    ];
} 
