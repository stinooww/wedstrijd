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
    protected $description = 'Selecteert een winnende deelnemer en start volgende spel';

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

    //update het huidige spel en stelt een nieuwe in
    public function handle()
    {
        $date = Carbon::now();

        $activeGame = Wedstrijd::where('is_active', 1)->get()->first();
        $activeGame = $activeGame->id;
        $this->info($activeGame);

        if ($activeGame->end_date == $date) {
            $randomwinnaar = Deelnemer::where([
                ['question', 20],
                ['wedstrijd_id', $activeGame],
            ])->orderByRaw("RAND()")->get()->first();

            $winnaarID = $randomwinnaar->id;
            $this->info("de winnaar met id " . $winnaarID);

            $winnaar = new Winnaar();
            $winnaar->deelnemer_id = $winnaarID;
            $winnaar->save();
            $this->info($winnaar);
            $this->nextGame();
            return app('App\Http\Controllers\ParticipantController')->SendWinningMail();
        } else {
            $this->info('eind datum van actieve wedstrijd is nog niet vandaag');
        }


    }




    //checkt eerst of er een actieve wedstrijd is, selecteert een random deelnemer met het juiste antwoord,
    // stelt een nieuw spel in  en slaagt die vervolgens op in winnaar + stuurt een mail


    public function nextGame()
    {
        $date = Carbon::now();
        Wedstrijd::where('end_date', $date)->update(['is_active' => 0]);
        Wedstrijd::where('start_date', $date)->update(['is_active' => 1]);
        $activeGame = Wedstrijd::where('is_active', 1)->get()->first();
        $activeGame = $activeGame->id;
        $this->info($activeGame);
    }

}
