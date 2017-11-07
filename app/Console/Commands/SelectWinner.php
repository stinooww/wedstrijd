<?php

namespace App\Console\Commands;

use App\Deelnemer;
use App\Wedstrijd;
use App\Winnaar;
use Carbon\Carbon;
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

        $activeGame = Wedstrijd::where('is_active', 1)->get()->first();
        $activeGame = $activeGame->id;
        $randomwinnaar = Deelnemer::where([
            ['question', 20],
            ['wedstrijd_id', $activeGame],
        ])->orderByRaw("RAND()")->get()->first();

        $winnaarID = $randomwinnaar->id;
        //  dd($winnaarID);

        $winnaar = new Winnaar();
        $winnaar->deelnemer_id = $winnaarID;
        $winnaar->save();
        $this->info($winnaar);
        return app('App\Http\Controllers\ParticipantController')->SendWinningMail();

    }
}
