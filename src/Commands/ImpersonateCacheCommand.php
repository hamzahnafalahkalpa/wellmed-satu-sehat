<?php

namespace Projects\WellmedSatuSehat\Commands;

use Hanafalah\MicroTenant\Commands\Impersonate\ImpersonateCacheCommand as ImpersonateImpersonateCacheCommand;

class ImpersonateCacheCommand extends ImpersonateImpersonateCacheCommand
{
    protected $signature = 'wellmed-satu-sehat:impersonate-cache 
                                {--forget : Forgets the current cache}
                                {--app_id= : The id of the application}
                                {--group_id= : The id of the group}
                                {--tenant_id= : The id of the tenant}
                            ';
}