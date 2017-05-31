<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Model\species;
use DB;
use Log;
use App\AutoUnshelveGroupbuy\AutoUnshelveGroupbuy;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->call(function(){
        //     $test = 'test';
        //     Log::info($test);
        // });
        $schedule->call(function(){
            AutoUnshelveGroupbuy::unshelveGroupbuy();
        });
        // $test = date('Y-m-d H:i:s');
        // $schedule->call(function() use ($test) {
        //     $data = species::where('speciseID', '33')->first();
        //     $data->speciseName = $test;
        //     $data->save();
        //     // DB::table('species')->where('speciseID','33')->update([
        //     //     'speciesName' => null
        //     // ]);
        // })->everyMinute();
        
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
