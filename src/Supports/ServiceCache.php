<?php

namespace Projects\WellmedSatuSehat\Supports;

use Hanafalah\LaravelSupport\Concerns\Support\HasCache;
use Projects\WellmedSatuSehat\Contracts\Supports\ServiceCache as SupportsServiceCache;
use Illuminate\Support\Str;

class ServiceCache implements SupportsServiceCache{
    use HasCache;

    protected $__cache_data = [
        'wellmed-satu-sehat' => [
            'name'    => 'app-wellmed-satu-sehat',
            'tags'    => ['wellmed-satu-sehat','app-wellmed-satu-sehat'],
            'forever' => true
        ]
    ];

    public function handle(?array $cache_data = null): void{
        $cache_data ??= $this->__cache_data['wellmed-satu-sehat'];
        $this->setCache($cache_data, function(){
            $cache = [
                'app.cached_lists' => [
                    'app.contracts',
                    'database.models',
                    'wellmed-satu-sehat.packages',
                    'config-cache'
                ],
                'app.contracts'         => config('app.contracts'),
                'database.models'       => config('database.models'),
                'wellmed-satu-sehat.packages'           => config('wellmed-satu-sehat.packages'),
                'configs' => []
            ];            

            foreach (config('wellmed-satu-sehat.packages') as $key => $value){
                $key = Str::kebab(Str::after($key, '/'));
                $cache['configs'][$key] = config($key);
            }

            config([
                'app.cached_lists' => $cache['app.cached_lists'] ?? [],
                'app.contracts'    => $cache['app.contracts'] ?? [],
                'database.models'  => $cache['database.models'] ?? [],
                'wellmed-satu-sehat.packages'     => $cache['wellmed-satu-sehat.packages'] ?? [],
                'configs' => $cache['configs'] ?? []
            ]);
            return $cache;
        }, false);
    }   

    public function getConfigCache(): ?array{
        $cache_data = $this->__cache_data['wellmed-satu-sehat'];
        $cache = $this->getCache($cache_data['name'],$cache_data['tags']);
        if (isset($cache)){
            config([
                'app.cached_lists' => $cache['app.cached_lists'] ?? [],
                'app.contracts'    => $cache['app.contracts'] ?? [],
                'database.models'  => $cache['database.models'] ?? [],
                'wellmed-satu-sehat.packages'      => $cache['wellmed-satu-sehat.packages'] ?? [],
                'configs'          => $cache['configs'] ?? []
            ]);
            foreach ($cache['configs'] as $key => $config) {
                config([$key => $config]);
            }
        }
        return $cache;
    }
}