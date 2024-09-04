<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class RenderService
{
    public function render_icon($icon)
    {
        $html = '';

        if ($icon == 'zap') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-zap " + classes}><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>';
        } else if ($icon == 'user') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-user " + classes}><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>';
        } else if ($icon == 'apple') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-apple " + classes}><path d="M12 20.94c1.5 0 2.75 1.06 4 1.06 3 0 6-8 6-12.22A4.91 4.91 0 0 0 17 5c-2.22 0-4 1.44-5 2-1-.56-2.78-2-5-2a4.9 4.9 0 0 0-5 4.78C2 14 5 22 8 22c1.25 0 2.5-1.06 4-1.06Z"/><path d="M10 2c1 .5 2 2 2 5"/></svg>';
        } else if ($icon == 'activity') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-activity " + classes}><path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"/></svg>';
        } else if ($icon == 'shopping-cart') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-shopping-cart " + classes}><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>';
        } else if ($icon == 'check') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-check " + classes}><path d="M20 6 9 17l-5-5"/></svg>';
        } else if ($icon == 'x') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-x " + classes}><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>';
        } else if ($icon == 'lock') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-lock " + classes}><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>';
        } else if ($icon == 'github') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-github " + classes}><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>';
        } else if ($icon == 'facebook') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-facebook " + classes}><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>';
        } else if ($icon == 'youtube') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-youtube " + classes}><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg>';
        } else if ($icon == 'linkedin') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-linkedin " + classes}><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>';
        } else if ($icon == 'mail') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-mail " + classes}><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>';
        } else if ($icon == 'qr-code') {
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class={"lucide lucide-qr-code " + classes}><rect width="5" height="5" x="3" y="3" rx="1"/><rect width="5" height="5" x="16" y="3" rx="1"/><rect width="5" height="5" x="3" y="16" rx="1"/><path d="M21 16h-3a2 2 0 0 0-2 2v3"/><path d="M21 21v.01"/><path d="M12 7v3a2 2 0 0 1-2 2H7"/><path d="M3 12h.01"/><path d="M12 3h.01"/><path d="M12 16v.01"/><path d="M16 12h1"/><path d="M21 12v.01"/><path d="M12 21v-1"/></svg>';
        }

        return $html;
    }

    private function render_component_iframe($component, $design = 'basic')
    {
        if (!array_key_exists('data', $component)) {
            return;
        }

        $component_data = $component['data'];

        $html = '';

        if ($design == 'basic') {
            if (array_key_exists('style', $component_data)) {
                $html .= '<section style="';
                $html .= 'background-color:' . $component_data['style']['backgroundColor'] . ';';
                $html .= 'color:' . $component_data['style']['textColor'] . ';';
                $html .= '">' . "\n";
            } else {
                $html .= '<section style="background-color:#fff;color:#000;">' . "\n";
            }

            $html .= '<div class="container mx-auto flex flex-col gap-6 items-center justify-center px-6 py-20">';

            if (array_key_exists('section', $component_data)) {
                if (array_key_exists('title', $component_data['section'])) {
                    $html .= '<h2 class="text-3xl font-bold">';
                    $html .= $component_data['section']['title'];
                    $html .= '</h2>';
                }

                if (array_key_exists('description', $component_data['section'])) {
                    $html .= '<p class="text-xl font-light">';
                    $html .= $component_data['section']['description'];
                    $html .= '</p>';
                }
            }

            if (array_key_exists('iframe', $component_data)) {
                $html .= '<div class="mt-10 flex justify-center w-full">';
                $html .= '<div class="w-full aspect-video">';
                $html .= '<iframe class="w-full h-full" src="' . $component_data['iframe']['src'] . '" frameborder="0" allowfullscreen></iframe>';
                $html .= '</div>';
                $html .= '</div>';
            }

            $html .= '</div>';

            $html .= '</section>';
        }

        return $html;
    }

    private function render_component_hero($component, $design = 'basic')
    {
        if (!array_key_exists('data', $component)) {
            return '';
        }

        $component_data = $component['data'];

        $html = '';

        if ($design == 'basic') {
            if (array_key_exists('style', $component_data)) {
                $html .= '<section style="';
                /*
                $html .= 'padding-bottom:' . $component['style']['paddingBottom'] . 'px;';
                $html .= 'padding-top:' . $component['style']['paddingTop'] . 'px;';
                */
                $html .= 'background-color:' . $component_data['style']['backgroundColor'] . ';';
                $html .= 'color:' . $component_data['style']['textColor'] . ';';
                $html .= '">' . "\n";
            } else {
                $html .= '<section style="background-color:#fff;color:#000;">' . "\n";
            }

            $html .= '<div class="container mx-auto flex flex-col gap-8 items-center justify-center px-6 py-20">' . "\n";

            if (array_key_exists('section', $component_data)) {
                if (array_key_exists('title', $component_data['section'])) {
                    $html .= '<h1 class="text-5xl font-bold">';
                    $html .= $component_data['section']['title'];
                    $html .= '</h1>';
                }

                if (array_key_exists('description', $component_data['section'])) {
                    $html .= '<p class="text-xl font-light">';
                    $html .= $component_data['section']['description'];
                    $html .= '</p>';
                }
            }

            if (array_key_exists('buttons', $component_data)) {
                $html .= '<div class="flex items-center gap-2">';

                foreach ($component_data['buttons'] as $button) {
                    $html .= '<a href="' . $button['href'] . '" class="px-8 py-4 text-lg font-medium rounded-lg shadow-md" style="';
                    if (array_key_exists('style', $component_data)) {
                        if (array_key_exists('primaryButtonBackgroundColor', $component_data['style'])) {
                            $html .= 'background-color:' . $component_data['style']['primaryButtonBackgroundColor'] . ';';
                        }
                        if (array_key_exists('primaryButtonTextColor', $component_data['style'])) {
                            $html .= 'color:' . $component_data['style']['primaryButtonTextColor'] . ';';
                        }
                    } else {
                        $html .= 'background-color: #000000;';
                        $html .= 'color: #ffffff;';
                    }
                    $html .= '">';
                    $html .= $button['text'];
                    $html .= '</a>';
                }

                $html .= '</div>';
            }

            $html .= '</div>';

            $html .= '</section>';
        }

        return $html;
    }

    private function render_component_footer($component, $design = 'basic')
    {
        if (!array_key_exists('data', $component)) {
            return '';
        }

        $component_data = $component['data'];

        $html = '';

        if ($design == 'basic') {
            if (array_key_exists('style', $component_data)) {
                $html .= '<footer style="';
                /*
                $html .= 'padding-bottom:' . $component['style']['paddingBottom'] . 'px;';
                $html .= 'padding-top:' . $component['style']['paddingTop'] . 'px;';
                */
                $html .= 'background-color:' . $component_data['style']['backgroundColor'] . ';';
                $html .= 'color:' . $component_data['style']['textColor'] . ';';
                $html .= '">' . "\n";
            } else {
                $html .= '<footer style="background-color:#fff;color:#000;">' . "\n";
            }

            $html .= '<div class="container mx-auto flex flex-col gap-6 items-center justify-center px-6 py-6">';

            if (array_key_exists('section', $component_data)) {
                if (array_key_exists('copyright', $component_data['section'])) {
                    $html .= '<p>' . $component_data['section']['copyright'] . '</p>';
                }
            }

            $html .= '</div>';

            $html .= '</footer>';
        }


        return $html;
    }

    private function render_component_pricing($component, $design = 'basic')
    {
        if (!array_key_exists('data', $component)) {
            return '';
        }

        $component_data = $component['data'];

        $html = '';

        if ($design == 'basic') {
            if (array_key_exists('style', $component_data)) {
                $html .= '<section style="';
                $html .= 'background-color:' . $component_data['style']['backgroundColor'] . ';';
                $html .= 'color:' . $component_data['style']['textColor'] . ';';
                $html .= '">' . "\n";
            } else {
                $html .= '<section style="background-color:#fff;color:#000;">' . "\n";
            }

            $html .= '<div class="container mx-auto flex flex-col gap-6 items-center justify-center px-6 py-20">';

            if (array_key_exists('section', $component_data)) {
                if (array_key_exists('title', $component_data['section'])) {
                    $html .= '<h2 class="text-3xl font-bold">';
                    $html .= $component_data['section']['title'];
                    $html .= '</h2>';
                }

                if (array_key_exists('description', $component_data['section'])) {
                    $html .= '<p class="text-xl font-light>"';
                    $html .= $component_data['section']['description'];
                    $html .= '</p>';
                }
            }

            if (array_key_exists('plans', $component_data)) {
                $html .= '<div class="grid grid-cols-' . count($component_data['plans']) . ' w-full gap-6 mt-6">';

                foreach ($component_data['plans'] as $plan) {
                    $html .= '<div class="shadow-md p-6 rounded-lg bg-white/10 h-fit">';

                    if (array_key_exists('name', $plan)) {
                        $html .= '<h3>' . $plan['name'] . '</h3>';
                    }

                    $html .= '<div class="flex items-end gap-2 my-6">';
                    if (array_key_exists('price', $plan)) {
                        $html .= '<span class="text-5xl font-semibold">';
                        $html .= $plan['price'];
                        $html .= '</span>';
                    }
                    if (array_key_exists('duration', $plan)) {
                        $html .= '<span class="text-3xl">/';
                        $html .= $plan['duration'];
                        $html .= '</span>';
                    }
                    $html .= '</div>';

                    if (array_key_exists('features', $plan)) {
                        $html .= '<ul class="flex flex-col gap-2">';

                        foreach ($plan['features'] as $feature) {
                            $html .= '<li class="flex items-start">';

                            if (array_key_exists('text', $feature)) {
                                $html .= '<p>' . $feature['text'] . '</p>';
                            }

                            $html .= '</li>';
                        }

                        $html .= '</ul>';
                    }

                    if (array_key_exists('button', $plan)) {
                        $button = $plan['button'];
                        $html .= '<a href="' . $button['href'] . '" class="block mt-2 text-center px-8 py-4 text-lg font-medium rounded-lg shadow-md" style="';
                        if (array_key_exists('style', $component_data)) {
                            if (array_key_exists('primaryButtonBackgroundColor', $component_data['style'])) {
                                $html .= 'background-color:' . $component_data['style']['primaryButtonBackgroundColor'] . ';';
                            }
                            if (array_key_exists('primaryButtonTextColor', $component_data['style'])) {
                                $html .= 'color:' . $component_data['style']['primaryButtonTextColor'] . ';';
                            }
                        } else {
                            $html .= 'background-color: #000000;';
                            $html .= 'color: #ffffff;';
                        }
                        $html .= '">';
                        $html .= $button['text'];
                        $html .= '</a>';
                    }

                    // plan
                    $html .= '</div>';
                }

                // plan grid
                $html .= '</div>';
            }

            // container
            $html .= '</div>';

            $html .= '</section>';
        }

        return $html;
    }

    private function render_component_features($component, $design = 'basic')
    {
        if (!array_key_exists('data', $component)) {
            return '';
        }

        $component_data = $component['data'];

        $html = '';

        if ($design == 'basic') {
            if (array_key_exists('style', $component_data)) {
                $html .= '<section style="';
                $html .= 'background-color:' . $component_data['style']['backgroundColor'] . ';';
                $html .= 'color:' . $component_data['style']['textColor'] . ';';
                $html .= '">' . "\n";
            } else {
                $html .= '<section style="padding-top:40px;padding-bottom:40px;background-color:#fff;color:#000;">' . "\n";
            }

            $html .= '<div class="container mx-auto flex flex-col gap-6 items-center justify-center px-6 py-20">';

            if (array_key_exists('section', $component_data)) {
                if (array_key_exists('title', $component_data['section'])) {
                    $html .= '<h2 class="text-3xl font-bold">';
                    $html .= $component_data['section']['title'];
                    $html .= '</h2>';
                }

                if (array_key_exists('description', $component_data['section'])) {
                    $html .= '<p class="text-xl font-light">';
                    $html .= $component_data['section']['description'];
                    $html .= '</p>';
                }
            }

            if (array_key_exists('features', $component_data)) {
                $html .= '<div class="grid grid-cols-3 gap-6 w-full">';

                foreach ($component_data['features'] as $feature) {
                    $html .= '<article class="repeater-item flex flex-col gap-2 p-6 bg-white/10 rounded-xl shadow-md">';

                    $html .= '<div class="flex items-center gap-2">';
                    if (array_key_exists('title', $feature)) {
                        $html .= '<div>';
                        $html .= $feature['title'];
                        $html .= '</div>';
                    }
                    $html .= '</div>';

                    if (array_key_exists('text', $feature)) {
                        $html .= '<div>';
                        $html .= $feature['text'];
                        $html .= '</div>';
                    }

                    $html .= '</article>';
                }

                $html .= '</div>';
            }

            $html .= '</div>';

            $html .= '</section>';
        }

        return $html;
    }

    private function render_component_form($component, $design = 'basic')
    {
        if (!array_key_exists('data', $component)) {
            return;
        }

        $component_data = $component['data'];

        $html = '';

        if ($design == 'basic') {
            if (array_key_exists('style', $component_data)) {
                $html .= '<section class="px-4 sm:px-6 lg:px-8" style="';
                $html .= 'background-color:' . $component_data['style']['backgroundColor'] . ';';
                $html .= 'color:' . $component_data['style']['textColor'] . ';';
                $html .= '">' . "\n";
            } else {
                $html .= '<section class="px-4 sm:px-6 lg:px-8" style="background-color:#fff;color:#000;">' . "\n";
            }

            $html .= '<div class="container mx-auto flex flex-col gap-6 items-center justify-center px-6 py-20">';

            if (array_key_exists('section', $component_data)) {
                if (array_key_exists('title', $component_data['section'])) {
                    $html .= '<h2 class="text-3xl font-bold">';
                    $html .= $component_data['section']['title'];
                    $html .= '</h2>';
                }

                if (array_key_exists('description', $component_data['section'])) {
                    $html .= '<p class="text-xl font-light">';
                    $html .= $component_data['section']['description'];
                    $html .= '</p>';
                }
            }

            if (array_key_exists('form', $component_data)) {
                $html .= '<form class="w-full grid grid-cols-2 mt-12 gap-6" method="' . $component_data['form']['method'] . '" action="' . $component_data['form']['action'] . '">';

                foreach ($component_data['form']['fields'] as $field) {
                    $html .= '<div class="">';

                    $html .= '<label class="block text-sm font-medium">' . $field['label'] . '</label>';

                    if ($field['type'] != 'textarea') {
                        $html .= '<input type="' . $field['type'] . '" name="' . $field['name'] . '" class="mt-1 block w-full rounded-md px-3 py-2 shadow-md bg-white/10" placeholder="' . $field['placeholder'] . '">';
                    } else {
                        $html .= '<textarea name="' . $field['name'] . '" class="mt-1 block w-full rounded-md bg-white/10 shadow-md px-3 py-2" placeholder="' . $field['placeholder'] . '"></textarea>';
                    }

                    $html .= '</div>';
                }

                $html .= '<div class="col-span-2"><button class="w-fit mt-2 text-center px-8 py-4 text-lg font-medium rounded-lg shadow-md" style="';
                if (array_key_exists('style', $component_data)) {
                    if (array_key_exists('primaryButtonBackgroundColor', $component_data['style'])) {
                        $html .= 'background-color:' . $component_data['style']['primaryButtonBackgroundColor'] . ';';
                    }
                    if (array_key_exists('primaryButtonTextColor', $component_data['style'])) {
                        $html .= 'color:' . $component_data['style']['primaryButtonTextColor'] . ';';
                    }
                } else {
                    $html .= 'background-color: #000000;';
                    $html .= 'color: #ffffff;';
                }
                $html .= '">';
                if (array_key_exists('button', $component_data)) {
                    $html .= $component_data['button']['text'];
                } else {
                    $html .= 'Submit';
                }
                $html .= '</button></div>';

                $html .= '</form>';
            }

            $html .= '</div>';

            $html .= '</section>';
        }

        return $html;
    }

    private function component_renderer($site, $components)
    {
        $html = '';

        foreach ($components as $component) {
            switch($component['component']) {
                case 'hero':
                    $html .= $this->render_component_hero($component);
                    break;
                case 'features':
                    $html .= $this->render_component_features($component);
                    break;
                case 'form':
                    $html .= $this->render_component_form($component);
                    break;
                case 'pricing':
                    $html .= $this->render_component_pricing($component);
                    break;
                case 'iframe':
                    $html .= $this->render_component_iframe($component);
                    break;
                case 'footer':
                    $html .= $this->render_component_footer($component);
                    break;
            }
        }

        return $html;
    }

    public function renderSite($site, $head, $components, $title, $description, $robots, $generateCSS = false)
    {
        $html = "<!DOCTYPE html>\n";
        $html .= "<html>\n";
        $html .= "<head>\n";
        $html .= '<meta charset="UTF-8">' . "\n";
        $html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
        $html .= "<title>" . $title . "</title>\n";
        if ($description != null || $description != '') {
            $html .= '<meta name="description" content="' . $description . '">' . "\n";
        }

        if ($description != null || $description != '') {
            $html .= '<meta name="robots" content="' . $robots . '">' . "\n";
        }

        // insert head
        if ($head != null) {
            $html .= $head;
            $html .= "\n";
        }

        if ($generateCSS) {
            if ($site) {
                if (env('APP_DEBUG', true)) {
                    $html .= '<link rel="stylesheet" href="https://sensei.staticninja.site/testing/site-' . $site->id . '/app.css" />' . "\n";
                } else {
                    $html .= '<link rel="stylesheet" href="https://sensei.staticninja.site/site-' . $site->id . '/app.css" />' . "\n";
                }
            } else {
                $html .= '<link rel="stylesheet" href="/app.css" />' . "\n";
            }
        } else {
            $html .= '<script src="https://cdn.tailwindcss.com"></script>' . "\n";
        }

        $html .= "</head>\n";
        $html .= "<body>\n";
        $html .= $this->component_renderer($site, $components);

        $html .= '<a style="position: fixed; padding: 4px 6px; border-radius: 6px; border: 1px solid #e5e5e5; bottom: 20px; right: 20px;background-color:#fff;color:#000;font-size:12px;" target="_blank" href="https://staticninja.com">Made in Static Ninja</a>' . "\n";

        $html .= "</body>\n";
        $html .= "</html>";

        if ($generateCSS) {
            $css = $this->generateCSS($html);

            return [
                'html' => $html,
                'css' => $css
            ];
        }

        return $html;
    }

    public function generateCSS($html)
    {
        // folder
        $temp_path = 'temp/' . uniqid();

        Storage::disk('local')->makeDirectory($temp_path);

        $storage_path = storage_path('app/' . $temp_path);

        // html
        $html_path = $storage_path . '/index.html';
        $html_file = fopen($html_path, 'w');
        fwrite($html_file, $html);
        fclose($html_file);

        // css
        $css_path = $storage_path . '/input.css';
        $css_file = fopen($css_path, 'w');
        fwrite($css_file, '@tailwind base;@tailwind components;@tailwind utilities;');
        fclose($css_file);

        // tailwind
        $tailwind_path = $storage_path . '/tailwind.config.js';
        $tailwind_file = fopen($tailwind_path, 'w');
        fwrite($tailwind_file, '/** @type {import("tailwindcss").Config} */module.exports = {content: ["' . $html_path . '"],theme: {extend: {},},plugins: [],}');
        fclose($tailwind_file);

        // compile css
        if (env('APP_DEBUG', true)) {
            exec('npx tailwindcss -c ' . $tailwind_path . ' -i ' . $css_path . ' -o ' . $storage_path . '/app.css');
        } else {
            exec('./var/www/staticninja/tailwindcss-linux-x64 -c ' . $tailwind_path . ' -i ' . $css_path . ' -o ' . $storage_path . '/app.css');
        }

        //$css = file_get_contents($storage_path . '/app.css');
        $css = Storage::disk('local')->get($temp_path . '/app.css');

        // delete temp folder
        Storage::disk('local')->deleteDirectory($temp_path);

        return $css;
    }
}
