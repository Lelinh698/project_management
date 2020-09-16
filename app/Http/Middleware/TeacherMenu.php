<?php

namespace App\Http\Middleware;

use Event;

use Closure;

class TeacherMenu
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
            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add(
                [
                    'text' => 'search',
                    'search' => true,
                    'topnav' => true,
                ],
                [
                    'text' => 'blog',
                    'url'  => 'admin/blog',
                    'can'  => 'manage-blog',
                ],
                [
                    'text'        => 'Quản lý đồ án',
                    'url'         => '/admin',
                    'icon'        => 'fas fa-fw fa-tasks',
                ],
                [
                    'text'        => 'Quản lý sinh viên',
                    'url'         => '/admin/student',
                    'icon'        => 'fas fa-fw fa-tasks',
                ],
                [
                    'text'        => 'Tiêu chí đánh giá',
                    'url'         => '/admin/department_criteria',
                    'icon'        => 'fas fa-fw fa-tasks',
                ],
            );
        });
        return $next($request);
    }
}
