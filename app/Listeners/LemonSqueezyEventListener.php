<?php

namespace App\Listeners;

use App\Jobs\SqueezyNewSubscriptionCancelled;
use App\Jobs\SqueezyNewSubscriptionCreated;
use App\Models\Site;
use App\Models\SitePlan;
use App\Models\User;
use App\Models\UserCredits;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use LemonSqueezy\Laravel\Events\WebhookHandled;
use LemonSqueezy\Laravel\Order;
use LemonSqueezy\Laravel\Subscription;
use App\Jobs\RefreshNginx;

class LemonSqueezyEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookHandled $event): void
    {
        // https://docs.lemonsqueezy.com/guides/developer-guide/webhooks
        if ($event->payload['meta']['event_name'] === 'subscription_created') {
            //SqueezyNewSubscriptionCreated::dispatch($event->payload['data']['id'])->delay(5);
            if ($event->payload['data']['attributes']['status'] == 'active') {
                $order = Subscription::where('lemon_squeezy_id', $event->payload['data']['id'])->first();
                if (!$order) {
                    // notify admin
                    error_log('no order found!');
                    return;
                }

                $user = User::where('id', $order->billable_id)->first();
                if (!$user) {
                    // notify admin
                    error_log('no user found!');
                    return;
                }

                $site = Site::where('user_id', $user->id)->first();
                if (!$site) {
                    error_log('no site found!');
                    return;
                }

                $site_plan = SitePlan::where('site_id', $site->id)->first();
                if (!$site_plan) {
                    error_log('no site plan found!');
                    return;
                }

                // TODO: update started_at as well
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
            }
        } else if ($event->payload['meta']['event_name'] === 'subscription_updated') {
            if ($event->payload['data']['attributes']['cancelled'] != true) {
                //SqueezyNewSubscriptionCreated::dispatch($event->payload['data']['id'])->delay(5);
            }
        } else if ($event->payload['meta']['event_name'] === 'subscription_cancelled') {
            //SqueezyNewSubscriptionCancelled::dispatch($event->payload['data']['id']);
        } else if ($event->payload['meta']['event_name'] === 'subscription_expired') {
            //SqueezyNewSubscriptionCancelled::dispatch($event->payload['data']['id']);
        } else if ($event->payload['meta']['event_name'] === 'order_created') {
            /*
            if ($event->payload['data']['attributes']['first_order_item']['variant_id'] == env('CREDITS_VARIANT_ID','464379')) {
                if ($event->payload['data']['attributes']['status'] == 'paid') {
                    // add credits to user
                    $order = Order::where('lemon_squeezy_id', $event->payload['data']['id'])->first();
                    if (!$order) {
                        // notify admin
                        error_log('no order found!');
                        return;
                    }

                    $user = User::where('id', $order->billable_id)->first();
                    if (!$user) {
                        // notify admin
                        error_log('no user found!');
                        return;
                    }

                    $credits = UserCredits::where('user_id', $user->id)->first();
                    if (!$credits) {
                        $credits = new UserCredits();
                        $credits->user_id = $user->id;
                        $credits->credits = 250;
                        $credits->save();
                    }

                    $credits->credits = $credits->credits + 10000;
                    $credits->save();
                }
            }
            */
        }
    }
}
