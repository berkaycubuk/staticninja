<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Jobs\RefreshNginx;
use App\Models\Plan;
use App\Models\SitePlan;
use App\Models\UserPlan;

class NewSiteController extends Controller
{
    public function index()
    {
        return Inertia::render('NewSite');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
            'domain' => 'nullable|min:5|max:37|doesnt_start_with:-|doesnt_end_with:-|lowercase|regex:/^[a-z0-9-]+$/|unique:sites,slug',
        ]);

        if (in_array($validated['domain'], [
            'sensei',
            'berkay',
            'bizmovo',
            'staticninja',
            'static',
            'ninja',
            'google',
            'youtube',
            'github',
            'gmail',
            'outlook',
            'microsoft',
            'berkaycubuk',
        ])) {
            return redirect()->back()->withErrors([
                'domain' => 'This domain is in use.',
            ]);
        }

        $site_limit = 1;

        $current_site_count = Site::where('user_id', auth()->user()->id)->get()->count();

        if ($current_site_count >= $site_limit) {
            return redirect()->back()->withErrors([
                'name' => 'You have reached your site limit, please get in touch with support.',
            ]);
        }

        $site = new Site();
        $site->name = $validated['name'];

        if ($validated['domain']) {
            $site->slug = $validated['domain'];
        }

        $site->is_builder_enabled = true;
        $site->user_id = auth()->user()->id;
        $site->is_active = true;
        $site->save();

        $site_plan = new SitePlan();
        $site_plan->site_id = $site->id;
        $site_plan->name = 'starter';
        $site_plan->is_active = false;
        $site_plan->save();

        // error handling required
        //$this->generateNginxConfig($site);

        return redirect('/dashboard/site/' . $site->id . '/designer');
    }

    public function generateNginxConfig(Site $site)
    {
        $is_dev = env('APP_DEBUG', true);

        $nginx_configurations_folder_path = '/etc/nginx/sites-enabled/';
        if ($is_dev) {
            $nginx_configurations_folder_path = '../../staticninja-4-output/nginx-configurations/';
        }

        $config_file_path = $nginx_configurations_folder_path . 'site-' . $site->id;

        /* server */
        $nginx_configuration = "server {\n";

        $nginx_configuration .= "\tlisten 80;\n";
        $nginx_configuration .= "\tserver_name " . $site->slug . ".staticninja.site;\n";
        $nginx_configuration .= "\terror_page 404 = @fallback-2;\n\n";

        /* location */
        $nginx_configuration .= "\tlocation / {\n";

        $nginx_configuration .= "\t\trewrite /[^/]*\.\w+$  \"/site-" . $site->id . "\${uri}?\" break;\n";

        $nginx_configuration .= "\t\trewrite /\w+$      \"/site-" . $site->id . "\${uri}/index.html?\" break;\n";

        $nginx_configuration .= "\t\trewrite /$         \"/site-" . $site->id . "\${uri}index.html?\" break;\n";

        $nginx_configuration .= "\t\trewrite ^          \"/site-" . $site->id . "\${uri}?\" break;\n";

        $nginx_configuration .= "\t\tproxy_pass https://sensei.staticninja.site.website-eu-central-1.linodeobjects.com;\n";
        $nginx_configuration .= "\t\tproxy_intercept_errors on;\n";
        $nginx_configuration .= "\t\tindex index.html;\n";
        $nginx_configuration .= "\t\tproxy_set_header Host sensei.staticninja.site.website-eu-central-1.linodeobjects.com;\n";
        $nginx_configuration .= "\t\tproxy_set_header X-Real-IP \$remote_addr;\n";
        $nginx_configuration .= "\t\tproxy_set_header X-Forwarded-For \$proxy_add_x_forwarded_for;\n";
        $nginx_configuration .= "\t\tproxy_set_header X-Forwarded-Proto \$scheme;\n";

        $nginx_configuration .= "\t}\n\n";
        /* location end */

        /* location */
        $nginx_configuration .= "\tlocation @fallback-2 {\n";

        $nginx_configuration .= "\t\terror_page 404 /404;\n";

        $nginx_configuration .= "\t\trewrite ^/site-" . $site->id . "/(.*)/index.html\$  \"/site-" . $site->id . "/\$1.html\" break;\n";

        $nginx_configuration .= "\t\tproxy_intercept_errors on;\n";

        $nginx_configuration .= "\t\tproxy_pass https://sensei.staticninja.site.website-eu-central-1.linodeobjects.com;\n";

        $nginx_configuration .= "\t}\n\n";
        /* location end */

        /* location */
        $nginx_configuration .= "\tlocation =/404 {\n";

        $nginx_configuration .= "\t\tproxy_pass https://sensei.staticninja.site.website-eu-central-1.linodeobjects.com/404.html;\n";

        $nginx_configuration .= "\t\tproxy_set_header Host sensei.staticninja.site.eu-central-1.linodeobjects.com;\n";

        $nginx_configuration .= "\t\tproxy_set_header X-Real-IP \$remote_addr;\n";

        $nginx_configuration .= "\t\tproxy_set_header X-Forwarded-For \$proxy_add_x_forwarded_for;\n";

        $nginx_configuration .= "\t\tproxy_set_header X-Forwarded-Proto \$scheme;\n";

        $nginx_configuration .= "\t}\n\n";
        /* location end */

        $nginx_configuration .= "}\n";
        /* server end */

        $config_file = fopen($config_file_path, 'w');
        fwrite($config_file, $nginx_configuration);
        fclose($config_file);

        RefreshNginx::dispatch();
    }

    public function checkDomain(Request $request, $locale, $domain)
    {
        if (!$domain) {
            return response()->json([
                'error' => 'No domain given.',
            ]);
        }

        if ($domain == "" || $domain == null) {
            return response()->json([
                'error' => 'No domain given.',
            ]);
        }

        $regex = '/^[a-z0-9-]+$/';
        if (!preg_match($regex, $domain)) {
            return response()->json([
                'error' => 'Domain is not valid.',
            ]);
        }

        if (strlen($domain) <= 5) {
            return response()->json([
                'error' => 'This domain is in use.',
            ]);
        }

        if (in_array($domain, [
            'sensei',
            'berkay',
            'bizmovo',
            'staticninja',
            'static',
            'ninja',
            'google',
            'youtube',
            'github',
            'gmail',
            'outlook',
            'microsoft',
            'berkaycubuk',
        ])) {
            return response()->json([
                'error' => 'This domain is in use.',
            ]);
        }

        $site = Site::where('slug', $domain)->first();
        if ($site) {
            return response()->json([
                'error' => 'This domain is in use.',
            ]);
        }

        if (str_starts_with($domain, '-')) {
            return response()->json([
                'error' => 'This domain is in use.',
            ]);
        }

        if (str_ends_with($domain, '-')) {
            return response()->json([
                'error' => 'This domain is in use.',
            ]);
        }

        return response()->json([
            'message' => 'This domain is available.',
        ]);
    }
}
