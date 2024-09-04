<?php

namespace App\Jobs;

use App\Mail\NotifyRequestSSL;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RequestSSL implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $domain,
        public $mail,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /*
        $is_dev = env('APP_DEBUG', true);

        if (!$is_dev) {
            // refresh nginx
            exec('sudo /usr/bin/cerbot --nginx -d ' . $this->domain . ' -d www.' . $this->domain . ' --non-interactive --agree-tos -m ' . $this->mail . ' --redirect');

            $domain_record = SiteDomain::where('domain', $this->domain)->first();
            if ($domain_record) {
                $domain_record->is_https = true;
                $domain_record->is_https_requested = false;
                $domain_record->save();
            }

            // send email to notify me so I can issue a certificate :^)
            // Do things that don't scale
            // - Paul Graham
        }
        */

        Mail::to('berkay@berkaycubuk.com')
            ->queue(new NotifyRequestSSL($this->domain));
    }
}
