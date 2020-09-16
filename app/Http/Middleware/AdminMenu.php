<?php

namespace App\Http\Middleware;

use Event;

use Closure;

class AdminMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Event::listen('JeroenNoten\LaravelAdminLte\Events\BuildingMenu', function ($event) {
            $event->menu->add(
                [
                    'text' => 'blog',
                    'url'  => 'admin/blog',
                    'can'  => 'manage-blog',
                ],
                [
                    'text'        => 'Quản lý đồ án',
                    'url'         => '/admin/project',
                    'icon'        => 'fas fa-fw fa-tasks',
                ],
                [
                    'text'        => 'Quản lý sinh viên',
                    'url'         => '/admin/student',
                    'icon'        => 'fas fa-fw fa-users',
                ],
                [
                    'text'        => 'Quản lý giảng viên',
                    'url'         => '/admin/teacher',
                    'icon'        => 'fas fa-fw fa-users',
                ],
                [
                    'text'        => 'Quản lý kế hoạch',
                    'url'         => '/admin/plan',
                    'icon'        => 'fas fa-fw fa-users',
                ],
            );
        });
        return $next($request);
    }
}
