<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	$d = 60*60;
        $t = time() - 1528127692;
        $angle = $t / $d;
        echo (int)((sin($angle) + 1) * 10);
    }
}
