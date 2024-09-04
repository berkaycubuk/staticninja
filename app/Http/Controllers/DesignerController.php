<?php

namespace App\Http\Controllers;

use App\Jobs\DeploySite;
use App\Models\Site;
use App\Models\SiteComponent;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\RenderService;
use LemonSqueezy\Laravel\Subscription;
use App\Jobs\RefreshNginx;

class DesignerController extends Controller
{
    protected $renderService;

    public function __construct(
        RenderService $renderService,
    )
    {
        $this->renderService = $renderService;
    }

    public function index(Request $request, $locale, $id)
    {
        $site = Site::where('id', $id)->where('user_id', auth()->user()->id)->with('pages.components')->first();
        if (!$site) {
            return redirect('/404');
        }

        return Inertia::render('Designer', [
            'site' => $site,
        ]);
    }

    public function uploadImage(Request $request, $id)
    {
        $site = Site::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if (!$site) {
            return response()->json([
                'success' => false,
                'error' => 'Site not found.',
            ]);
        }

        // TODO: implement file upload from the older version
    }

    public function render(Request $request, $locale, $id) {
        $site = Site::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if (!$site) {
            return response()->json([
                'success' => false,
                'error' => 'Site not found.',
            ]);
        }

        $index_page = $site->pages()->where('slug', 'index')->first();
        $generated = $this->renderService->renderSite($site, $index_page->head, $index_page->getRenderCompatibleComponents(), $index_page->title, $index_page->meta_description, $index_page->meta_robots, false);

        return response()->json([
            'html' => $generated,
        ]);
    }

    public function saveSite(Request $request, $locale, $id) {
        $site = Site::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if (!$site) {
            return response()->json([
                'success' => false,
                'error' => 'Site not found.',
            ]);
        }

        $validated = $request->validate([
            'components' => 'required',
        ]);

        if (count($site->pages) == 0) {
            error_log('index page not found while saving.');
            return response()->json([
                'message' => 'index page not found while saving.',
                'success' => false,
            ]);
        }

        $index_page = $site->pages()->where('slug', 'index')->first();

        $active_component_ids = [];
        $order = 0;
        foreach ($validated['components'] as $component) {
            $componentRow = null;
            if (array_key_exists('rowId', $component)) {
                $componentRow = SiteComponent::where('id', $component['rowId'])->first();
                if (!$componentRow) {
                    $componentRow = new SiteComponent();
                }
            } else {
                $componentRow = new SiteComponent();
            }

            $componentRow->site_page_id = $index_page->id;
            $componentRow->component = $component['component'];
            $componentRow->order = $order;
            $componentRow->data = $component['data'];
            $componentRow->save();

            array_push($active_component_ids, $componentRow->id);

            $order += 1;
        }

        // remove not active components
        $index_page->components()->whereNotIn('id', $active_component_ids)->delete();

        $index_page->save();

        DeploySite::dispatch($site, $this->renderService);

        return response()->json([
            'message' => 'Saved.',
            'success' => true,
        ]);
    }
}
