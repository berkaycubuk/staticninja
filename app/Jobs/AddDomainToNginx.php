<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddDomainToNginx implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $site_id,
        public $domain,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $is_dev = env('APP_DEBUG', true);
        $config_folder_path = '/etc/nginx/sites-enabled/';
        if ($is_dev) {
            $config_folder_path = '../staticninja-4-output/nginx-configurations/';
        }

        $config_path = $config_folder_path . 'site-' . $this->site_id;

        $file = file($config_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($file == false) {
            error_log('unable to open nginx configuration.');
        }

        if (count($file) < 3) {
            error_log('this configuration is wrong.');
        }

        $file[2] = substr($file[2], 0, -1) . ' www.' . $this->domain . ' ' . $this->domain . ';';
        if (file_put_contents($config_path, implode(PHP_EOL, $file)) == false) {
            error_log('unable to update nginx configuration.');
        }

        RequestSSL::dispatch($this->domain, 'contact@bizmovo.com');
    }
}
