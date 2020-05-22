<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Confession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrendingConfessionController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->subDays(15);

        $confessions = Confession::where('created_at', '>=', $date)
        ->orderBy('like', 'desc')->paginate();

        return $confessions;
    }
}
