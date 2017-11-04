<?php

namespace App\Console\Commands;

use App\ContestPeriod;
use App\Http\Controllers\ParticipantController;
use App\Participant;
use App\Period;
use App\Question;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SelectContestWinner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'select-contest-winner';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kiest automatisch een wedstrijd winnaar voor de periode';
    /**
     * @var ContestService
     */
    private $contestService;

    /**
     * Create a new command instance.
     *
     * @param ContestService $contestService
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
        $date = Carbon::now();
        // Haalt random 1 deelnemer met het juiste antwoord op de actieve vraag op
        $question = Question::where('active', 1)->first();
        $winner = Participant::where('answerd', $question->answerd)
            ->where('has_permission', true)
            ->orderByRaw("RAND()")
            ->take(1)
            ->get()
            ->first();
        // Check op actieve periode
        $period = Period::where('endDate', '>', $date)->get()->first();
        // Voeg een winnaar toe aan die periode op basis van degene die een juist antwoord heeft gegeven
        $period['winner'] = $winner['id'];
        $period['winner_name'] = $winner['firstname'];
        $period['winner_email'] = $winner['email'];
        $period->save();
        $this->info($period);
        return app('App\Http\Controllers\ParticipantController')->SendWinningMail();

    }
}
