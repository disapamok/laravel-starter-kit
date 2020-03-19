<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use stdClass;

class SidebarProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //$routeCollection = Route::getRoutes();

        // foreach ($routeCollection as $value) {
        //     echo $value->getPath();
        // }

        $except = ['api','admin/does'];
        $groups = array();

        $routes = Route::getRoutes();
        foreach($routes as $route){
            $prefix = $route->action['prefix'];
            $methods = $route->methods;

            if(!in_array($prefix,$except) & in_array('GET',$methods) & !in_array($prefix,$groups) ){
                $key = ($prefix == null ? 'independent' : $prefix);
                $routeTitle = $prefix != null ? $route->action['Title'] : '';
                $keyExists = isset($groups[$key]['items']) ? $groups[$key]['items'] : array();

                $groups[$key] = $prefix == null ?
                array('items' => $keyExists) :
                array('items' => $keyExists,'title'=> ($prefix != null ? is_array($routeTitle) ? end($routeTitle) : $routeTitle : '' ) );
                $std = new stdClass();
                $std->name = $route->action['as'];
                $std->title = $route->defaults["Menu"];
                array_push($groups[$key]['items'],$std);
            }
        }
        //dd($groups);
        View::share('Menu', $groups);
    }
}
