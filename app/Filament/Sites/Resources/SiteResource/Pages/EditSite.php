<?php

namespace App\Filament\Sites\Resources\SiteResource\Pages;

use App\Filament\Sites\Resources\SiteResource;
use App\Jobs\AddDomainToNginx;
use App\Jobs\RequestSSL;
use App\Models\Plan;
use App\Models\SiteDomain;
use App\Models\UserPlan;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSite extends EditRecord
{
    protected static string $resource = SiteResource::class;

    protected static string $view = 'edit-site-settings';

    public $show_custom_domain = false;
    public $domains;
    public $domain;
    public $domain_record;
    public $ssl_active = false;
    public $ssl_loading = false;
    public $custom_domain = '';

    public function mount(int|string $record): void
    {
        parent::mount($record);

        $domains = SiteDomain::where('site_id', $record)->get();
        $this->domains = $domains;

        $this->domain_record = $domains[0];

        if (count($domains) > 1) {
            $this->custom_domain = $domains[1]->domain;
        }

        $this->domain = $this->domain_record->domain;
        $this->ssl_active = $this->domain_record->is_https;
        $this->ssl_loading = $this->domain_record->is_https_requested;

        $site_plan = UserPlan::where('user_id', auth()->user()->id)->whereIn('plan_id', Plan::where('related_product', 'sites')->pluck('id')->all())->first();
        if ($site_plan){
            if ($site_plan->plan->features()->where('name', 'custom_domain')->first()->value == 'true') {
                $this->show_custom_domain = true;
            }
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function add_custom_domain()
    {
        if ($this->custom_domain == '' || $this->custom_domain == null) {
            $this->custom_domain = '';
            return;
        }

        $regex = '/^((?!-))(xn--)?[a-z0-9]+(-[a-z0-9]+)*\.[a-z]{2,}(\.[a-z]{2,})?$/i';
        if (!preg_match($regex, $this->custom_domain)) {
            $this->custom_domain = '';
            return;
        }

        if (count($this->domains) > 1) {
            return;
        }

        $newDomain = new SiteDomain();
        $newDomain->site_id = $this->domains[0]->site_id;
        $newDomain->domain = $this->custom_domain;
        $newDomain->is_https = false;
        $newDomain->is_https_requested = false;
        $newDomain->save();

        AddDomainToNginx::dispatch($newDomain->site_id, $newDomain->domain);
    }

    public function initiate_ssl()
    {
        $this->ssl_loading = true;

        $this->domain_record->is_https_requested = true;
        $this->domain_record->save();

        RequestSSL::dispatch($this->domain, 'contact@bizmovo.com');
    }
}
