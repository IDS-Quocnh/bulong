<?php

namespace App\Http\Controllers\Front;

use App\ReportConfession;
use Illuminate\Http\Request;
use App\Models\ReportedConfession;
use App\Mail\ConfessionGotReported;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ReportConfessionController extends Controller
{
    public function report($confessionId)
    {
        $reportedConfession = ReportedConfession::updateOrCreate(
            ['confession_id' => $confessionId, 'user_id' => auth()->id()],
            ['body' => request('body')]
        );

        if ($reportedConfession->wasRecentlyCreated) {
            Mail::to('support@bulong.net')->send(new ConfessionGotReported($reportedConfession));
        }

        return $reportedConfession;
    }
}
