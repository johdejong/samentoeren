<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class CloseRiddenRides extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ride:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sluiten van de ritten waarvan de begin datum en tijd zijn gepaseerd';

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
     * @return int
     */
    public function handle()
    {
        DB::table('rides')
            ->where('start_date', '=', Carbon::today()->toDateString())
            ->where('start_time', '<=', Carbon::now()->format('H:i:m'))
            ->update(['status_id' => 2]);
    }
}
