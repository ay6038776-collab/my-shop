<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\StressTest\RouteScanner;
use App\Services\StressTest\HttpTester;
use App\Services\StressTest\DatabaseTester;
use App\Services\StressTest\CrudTester;
use App\Services\StressTest\ReportGenerator;

class SiteStressTest extends Command
{
    protected $signature = 'site:stresstest
                            {--requests=100}
                            {--concurrent=10}
                            {--database}
                            {--crud}
                            {--full}';

    protected $description = 'Complete Website Stress Test';

    public function handle()
    {
        $this->newLine();

        $this->info("=========================================");
        $this->info(" Laravel Website Stress Tester");
        $this->info("=========================================");

        $requests = (int)$this->option('requests');
        $concurrent = (int)$this->option('concurrent');

        $scanner = new RouteScanner();

        $routes = $scanner->getRoutes();

        $httpTester = new HttpTester(
            $this,
            $requests,
            $concurrent
        );

        $databaseTester = new DatabaseTester($this);

        $crudTester = new CrudTester($this);

        $report = [];

        foreach ($routes as $route)
        {
            $report[] = $httpTester->test($route);
        }

        if($this->option('database') || $this->option('full'))
        {
            $databaseTester->run();
        }

        if($this->option('crud') || $this->option('full'))
        {
            $crudTester->run();
        }

        ReportGenerator::generate($report);

        $this->newLine();

        $this->info("Finished Successfully.");
    }
}