<?php

namespace derbala\Routers;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class FetchPermissionRoutesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:permission_routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create pivot table between permissions and routes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // DB::table('permission_routes')->truncate();
        $routeCollection = Route::getRoutes();
        $permissions = DB::select('select * from permissions');
        foreach ($permissions as $i=>$permission) {
            $arrPermission = explode('.',$permission->name);
            foreach ($routeCollection as $key=>$value) {
                $name = explode(".",($value->getName()));
                if(count($name)>2 && count($arrPermission)>2) {
                    //if the permission equal 'create' we will assign create, store and index routes to this permission
                    if($arrPermission[2]== 'create'){

                        if( $name[2] == 'store') {
                            if(($name[1] ?? null) == $arrPermission[1]) {
                            DB::table('permission_route')->insert([
                                'permission_id' => $i+1,
                                'route_id' => $key+1,
                            ]);
                            }
                        }
                        elseif( $name[2] == 'index') {
                            if(($name[1] ?? null) == $arrPermission[1]) {
                            DB::table('permission_route')->insert([
                                'permission_id' => $i+1,
                                'route_id' => $key+1,
                            ]);
                            }
                        }
                    }
                    //if the permission equal 'edit' we will assign edit, update and index routes to this permission
                    elseif($arrPermission[2]== 'edit'){
                        if( $name[2] == 'update') {
                            if(($name[1] ?? null) == $arrPermission[1]) {
                            DB::table('permission_route')->insert([
                                'permission_id' => $i+1,
                                'route_id' => $key+1,
                            ]);
                            }
                        }
                        elseif( $name[2] == 'index') {
                            if(($name[1] ?? null) == $arrPermission[1]) {
                            DB::table('permission_route')->insert([
                                'permission_id' => $i+1,
                                'route_id' => $key+1,
                            ]);
                            }
                        }
                    }
                    //if the permission equal 'destroy' we will assign destroy and index routes to this permission
                    elseif($arrPermission[2]== 'destroy'){
                        if( $name[2] == 'index') {
                            if(($name[1] ?? null) == $arrPermission[1]) {
                            DB::table('routes')->insert([
                                'permission_id' => $i+1,
                                'route_id' => $key+1,
                            ]);
                            }
                        }
                    }
                }
            }
        }
        foreach ($routeCollection as $key=>$value) {
            foreach ($permissions as $i=>$permission) {
                if ($permission->name == $value->getName()) {  
                    DB::table('permission_route')->insert([
                        'permission_id' => $i+1,
                        'route_id' => $key+1,
                    ]);
                }
                continue;
            }
        }
        return Command::SUCCESS;
    }
}
