<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Jobs\RefreshNginx;
use LemonSqueezy\Laravel\Subscription;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $sites = Site::where('user_id', auth()->user()->id)->with('domains')->get();

        return Inertia::render('Dashboard', [
            'sites' => $sites,
            'user_id' => auth()->user()->id,
        ]);
    }

    public function settingsStore(Request $request, $locale, $id)
    {
        $site = Site::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if (!$site) {
            return redirect('/404');
        }

        $validated = $request->validate([
            'name' => 'required|max:100|min:3',
        ]);

        $site->name = $validated['name'];
        $site->save();
    }

    public function deleteSite(Request $request, $locale, $id)
    {
        $site = Site::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if (!$site) {
            return response()->json([
                'success' => false,
                'error' => 'Site not found.',
            ]);
        }

        $site->delete();

        return response()->json([
            'success' => true,
            'message' => 'Site deleted.',
        ]);
    }

    public function account(Request $request)
    {
        return Inertia::render('Account');
    }

    public function tools(Request $request, $locale, $id)
    {
        $site = Site::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if (!$site) {
            return redirect('/404');
        }

        return Inertia::render('Tools', [
            'site' => $site,
        ]);
    }

    public function settings(Request $request, $locale, $id)
    {
        $site = Site::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if (!$site) {
            return redirect('/404');
        }

        return Inertia::render('Settings/Index', [
            'site' => $site,
        ]);
    }

    public function sitePayment(Request $request, $locale, $id)
    {
        $site = Site::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if (!$site) {
            return redirect('/404');
        }

        $site_plan = $site->plan;

        if ($site_plan->is_active) {
            return redirect('/dashboard/site/' . $site->id . '/designer');
        }

        // check is it paid
        $subscription = Subscription::where('billable_id', auth()->user()->id)->first();
        if ($subscription) {
            // we have a subscription!!!
            $site_plan->is_active = true;
            $site_plan->save();

            // create the nginx configuration
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

            return redirect('/dashboard/site/' . $site->id . '/designer');
        }

        return Inertia::render('SitePayment', [
            'id' => $id,
        ]);
    }

    public function sitePaymentSuccess(Request $request, $locale, $id)
    {
        $site = Site::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if (!$site) {
            return redirect('/404');
        }

        $site_plan = $site->plan;

        if ($site_plan->is_active) {
            return redirect('/dashboard/site/' . $site->id . '/designer');
        }


        return redirect('/dashboard/site/' . $site->id . '/designer');
    }
}
