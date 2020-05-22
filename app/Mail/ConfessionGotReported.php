<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\ReportedConfession;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfessionGotReported extends Mailable
{
    use Queueable, SerializesModels;

    public $reportedConfession;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ReportedConfession $reportedConfession)
    {
        $this->reportedConfession = $reportedConfession;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.confession_got_reported')
            ->with('reportedConfession', $this->reportedConfession);
    }
}
