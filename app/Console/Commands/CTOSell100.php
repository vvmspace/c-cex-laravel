<?php

namespace App\Console\Commands;

use App\Cto;
use Illuminate\Console\Command;

class CTOSell100 extends Command
{
    protected $cto;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cto:sell100';

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
        $this->cto = new Cto();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Cto::Sell100();
    }
}
