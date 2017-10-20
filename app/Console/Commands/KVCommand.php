<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\KV;

class KVCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'k:v {getset} {key} {value?}';

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
        $getset = $this->argument('getset');
        if($getset){
            switch ($getset){
                case 'get':
                    $v = KV::get($this->argument('key'));
                    if(empty($v)){
                        $v = $this->argument('valuedefault');
                    }
                    echo "$v\r\n";
                    break;
                case 'set':
                    KV::set($this->argument('key'), $this->argument('value'));
                    break;
            }
        }
    }
}
