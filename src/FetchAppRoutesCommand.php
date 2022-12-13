<?php

namespace derbala\routers;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class FetchAppRoutesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:routes {routes} {allow_trans}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert routes to database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //DB::table('app_routes')->delete();
        //DB::table('permissions')->delete();
        $routes = $this->argument('routes');
        $allow_trans = $this->argument('allow_trans');
        $routes = explode("_",$routes);
        $routeCollection = Route::getRoutes();
        foreach ($routeCollection as $value) {
            DB::table('routes')->insert([
                'method'=> $value->methods()[0],
                'route'=> $value->uri(),
                'name'=> $value->getName(),
                'action'=> $value->getActionName(),
            ]);
            //convert the name to array
            $name = explode(".",($value->getName()));
            $methodName = $value->methods()[0];
            $routeURL = $value->uri();
            $routeURL = explode("/",$routeURL);
            foreach ($routes as $route){
                //check if the route url equals to the route name in the command
                if($routeURL[0] == $route) {
                    if ($methodName == 'GET' ) {
                        //check the name if it contains more that 2 elements
                        if(count($name)>2) {
                            if($name[2] == 'index') {
                                $txt = ucfirst('list') . ' ' . ucfirst($name[1]);
                            }
                            else{
                                $txt = ucfirst($name[2]) . ' ' . ucfirst($name[1]);
                            }
                        }
                        //check the name if it contains more that 1 element
                        elseif(count($name)>1){
                            if(!empty($value->getName() !== 'admin.')){
                                $txt = ucfirst($name[0]) . ' ' . ucfirst($name[1]);
                            }
                        }
                        //check the name if it contains 1 element
                        elseif(count($name) == 1){
                                $txt = ucfirst($name[0]);
                        }
                        if(!empty($txt)){
                            $label = $txt;
                            if($allow_trans){
                                $label = '{"' . \App::getLocale() . '":"' . $txt . '"}';
                            }
                            DB::table('permissions')->insert([
                                'name' =>$value->getName(),
                                'label' => $label,
                            ]);
                        }
                    }
                }
            }
        }
        return Command::SUCCESS;
    }
}
