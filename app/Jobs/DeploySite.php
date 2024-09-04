<?php

namespace App\Jobs;

use App\Models\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\RenderService;
use Illuminate\Support\Facades\Storage;

class DeploySite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Site $site,
        protected RenderService $renderService,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $index_page = $this->site->pages()->where('slug', 'index')->first();
        $generated = $this->renderService->renderSite($this->site, $index_page->head, $index_page->getRenderCompatibleComponents(), $index_page->title, $index_page->meta_description, $index_page->meta_robots, true);

        $is_dev = env('APP_DEBUG', true);
        $site_path = "site-" . $this->site->id;
        if ($is_dev) {
            $site_path = "testing/site-" . $this->site->id;
        }

        Storage::disk('linode')->put($site_path . '/index.html', $generated['html']);
        Storage::disk('linode')->put($site_path . '/app.css', $generated['css']);
    }
}
