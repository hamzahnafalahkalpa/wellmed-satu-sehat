<?php

namespace Projects\WellmedSatuSehat\Commands;

class InstallMakeCommand extends EnvironmentCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wellmed-satu-sehat:install';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used for initial installation of this module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $provider = 'Projects\WellmedSatuSehat\WellmedSatuSehatServiceProvider';

        $this->comment('Installing Module...');
        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'config'
        ]);
        $this->info('✔️  Created config/wellmed-satu-sehat.php');

        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'migrations'
        ]);
        $this->info('✔️  Created migrations');

        $this->call('optimize:clear');
        $this->call('migrate');
        $this->call('db:seed');

        $this->callSilent('wellmed-satu-sehat:seed');

        $this->comment('projects/wellmed-satu-sehat installed successfully.');
    }
}
