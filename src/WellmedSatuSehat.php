<?php

namespace Projects\WellmedSatuSehat;

use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\{
    Concerns\Support\HasRepository,
    Supports\PackageManagement,
    Events as SupportEvents
};
use Projects\WellmedSatuSehat\Contracts\WellmedSatuSehat as ContractsWellmedSatuSehat;

class WellmedSatuSehat extends PackageManagement implements ContractsWellmedSatuSehat{
    use Supports\LocalPath,HasRepository;

    const LOWER_CLASS_NAME = "wellmed-satu-sehat";
    const SERVICE_TYPE     = "";

    public ?Model $model;

    public function events(){
        return [
            SupportEvents\InitializingEvent::class => [
                
            ],
            SupportEvents\EventInitialized::class  => [],
            SupportEvents\EndingEvent::class       => [],
            SupportEvents\EventEnded::class        => [],
            //ADD MORE EVENTS
        ];
    }

    protected function dir(): string{
        return __DIR__;
    }
}
