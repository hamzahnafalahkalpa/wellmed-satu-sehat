<?php

namespace Projects\WellmedSatuSehat\Providers;

use Illuminate\Foundation\Http\Kernel;
use Hanafalah\LaravelSupport\{
    Concerns\NowYouSeeMe,
    Supports\PathRegistry
};
use Projects\WellmedSatuSehat\{
    WellmedSatuSehat,
    Contracts,
    Facades
};
use Hanafalah\MicroTenant\Facades\MicroTenant;
use Projects\WellmedSatuSehat\Contracts\Supports\ConnectionManager as ConnectionManager;
use Projects\WellmedSatuSehat\Supports\ConnectionManager as SupportsConnectionManager;

class WellmedSatuSehatServiceProvider extends WellmedSatuSehatEnvironment
{
    use NowYouSeeMe;

    public function register()
    {
        $this->registerMainClass(WellmedSatuSehat::class,false)
             ->registerCommandService(CommandServiceProvider::class)
            ->registers([
                'Services' => function(){
                    $this->binds([
                        ConnectionManager::class => SupportsConnectionManager::class
                    ]);   
                },
                'Config' => function() {
                    $this->__config_wellmed_satu_sehat = config('wellmed-satu-sehat');
                },
                'Provider' => function(){
                    $this->registerOverideConfig('wellmed-satu-sehat',__DIR__.'/../'.$this->__config_wellmed_satu_sehat['libs']['config']);
                }
            ]);
    }

    public function boot(Kernel $kernel){    
        $this->registerModel();
        $this->app->booted(function(){
            try {
                $tenant = $this->TenantModel()->where('flag','APP')->where('props->product_type','WELLMED_SATU_SEHAT')->first();  
                if (isset($tenant)) {
                    config(['database.connections.tenant.search_path' => $tenant->tenancy_db_name]);
                    $cache = app(config('laravel-support.service_cache'))->getConfigCache();
                    $this->registers([
                        '*',
                        'Provider' => function() use ($tenant){
                            $this->bootedRegisters($tenant->packages, 'wellmed-satu-sehat', __DIR__.'/../'.$this->__config_wellmed_satu_sehat['libs']['migration'] ?? 'Migrations');
                            $this->registerOverideConfig('wellmed-satu-sehat',__DIR__.'/../'.$this->__config_wellmed_satu_sehat['libs']['config']);
                        },
                        'Model', 'Database',
                    ]);

                    MicroTenant::impersonate($tenant,false);    

                    ($this->checkCacheConfig('config-cache')) ? $this->multipleBinds(config('app.contracts')) : $this->autoBinds();
                    $this->registerRouteService(RouteServiceProvider::class);
                    
                    $this->app->singleton(PathRegistry::class, function () {
                        $registry = new PathRegistry();
            
                        $config = config("wellmed-satu-sehat");
                        foreach ($config['libs'] as $key => $lib) $registry->set($key, 'projects'.$lib);
                        return $registry;
                    });
                }else{
                    $this->registers([
                        '*',
                        'Model', 'Database',
                        'Provider' => function() use ($tenant){
                            $this->registerOverideConfig('wellmed-satu-sehat',__DIR__.'/../'.$this->__config_wellmed_satu_sehat['libs']['config']);
                        }
                    ]);
                    $this->autoBinds();
                }
            } catch (\Exception $e) {
            }
        });
    }    
}
