<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Notifications\DailyReportNotification;

class DailyReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teac:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a report with all products sold this day';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now();

        $articles = Article::
            whereHas('order', function ($query) use ($date) {
                $query->whereDate('date', $date);
            })
            ->with('product')
            ->get()
            ->groupBy('product_id')
            ->map(function ($group) {
                return (object) [
                    'product' => $group->first()->product->name,
                    'total_sold' => $group->sum('quantity'),
                    'total_revenue' => $group->sum(fn($article) => $article->unit_price * $article->quantity),
                ];
            });

        $admin = User::where('is_admin', true)->first();

        if ($admin) {
            $admin->notify(new DailyReportNotification($date, $articles));
        }
    }
}
