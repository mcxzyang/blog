<?php

namespace App\Listeners;

use App\Events\BreadcrumbEvent;
use App\Services\PermissionService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BreadcrumbListener
{

    protected $permission;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PermissionService $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Handle the event.
     *
     * @param  BreadcrumbEvent  $event
     * @return void
     */
    public function handle(BreadcrumbEvent $event)
    {
        $file_path = storage_path('framework/cache') . '/Breadcrumbs.php';
        if (file_exists($file_path))unlink($file_path);
        $this->breadcrumbs($file_path);
    }

    public function breadcrumbs($file_path) {
        $str = $this->permission->getBreadCrumbCache($file_path);
        file_put_contents($file_path,$str);
        include $file_path;
    }
}
