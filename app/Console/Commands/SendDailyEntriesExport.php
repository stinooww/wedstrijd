<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendDailyEntriesExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stuurt elke dag een deelnemerslijst naar de wedstrijdverantwoorelijke';

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
        //
        return app('App\Http\Controllers\ParticipantController')->SendAutoMail();
    }
}
