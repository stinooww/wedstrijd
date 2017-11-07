<?php

namespace App\Console\Commands;

use App\Deelnemer;
use App\Winnaar;
use Illuminate\Console\Command;

class SelectWinner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'select-winner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Selecteert een winnende deelnemer';

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
    //selecteert een random deelnemer met het juiste antwoord en slaagt die op in winnaar
    public function handle()
    {
        $date = Carbon::now();
        $randomwinnaar = Deelnemer::where('question', 20)->orderByRaw("RAND()")->get();
        //   $period = Period::where('endDate', '>', $date)->get()->first();
        $winnaarID = $randomwinnaar[0]->id;

        $winnaar = new Winnaar();
        $winnaar->deelnemer_id = $winnaarID;


        $winnaar->save();
//        $this->info($period);
        return app('App\Http\Controllers\ParticipantController')->SendWinningMail($winnaarID);

    }
}
