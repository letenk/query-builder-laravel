<?php

namespace App\Console\Commands;

use App\QueryBuilder\QueryBuilder;
use Illuminate\Console\Command;

class RunBuilder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run-builder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'See query builder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = new QueryBuilder("users");
        $query->select("nama, kelas, username")
            ->where("id", '=', "username")
            ->where('name', '!=', 'letenk')
            ->orderBy('name', 'desc')
            ->offset(1)
            ->limit(10);
        $this->info($query->get());

        Command::SUCCESS;
    }
}
