<?php

namespace App\Http\Controllers;

use App\Mail\NewFormSubmission;
use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\FormSubmissionField;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserCredits;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class FormSubmissionController extends Controller
{
    private function getSubmissionCount($form_id)
    {
        $current_date = Carbon::now();

        $user_id = Form::firstWhere('id', $form_id)->user_id;

        $my_forms = Form::where('user_id', $user_id)->pluck('id');
        if (!$my_forms) {
            return 0;
        }

        /*
        $credits = UserCredits::where('user_id', $user_id)->first();
        if (!$credits) {
            return 0;
        }

        return $credits->credits;
        */

        $submission_count = FormSubmission::whereIn('form_id', $my_forms)
            ->whereMonth('created_at', $current_date->month)
            ->whereYear('created_at', $current_date->year)
            ->count();

        return $submission_count;
    }

    private function getRemainingSubmissionCount($form_id)
    {
        $user_id = Form::firstWhere('id', $form_id)->user_id;

        $credits = UserCredits::where('user_id', $user_id)->first();
        if (!$credits) {
            return 0;
        }

        return $credits->credits;
        /*

        $user = User::where('id', $user_id)->first();

        $form_plans = Plan::where('related_product', 'forms')->pluck('id')->all();
        $user_form_plan = UserPlan::where('user_id', $user_id)->whereIn('plan_id', $form_plans)->first();
        $limit = $user_form_plan->plan->features()->where('name', 'submissions_limit')->first()->value;

        return $limit - $this->getSubmissionCount($form_id);
        */
    }

    public function submit(Request $request, string $key)
    {
        $redirect_url = $request->header('referer');

        if (!$key) {
            return response()->view('form-not-found', [
                'redirect_url' => $redirect_url,
            ]);
        }

        $form = Form::where('key', '=', $key)->first();

        if (!$form) {
            return response()->view('form-not-found', [
                'redirect_url' => $redirect_url,
            ]);
        }

        if ($form->is_active == '0') {
            return response()->view('form-not-found', [
                'redirect_url' => $redirect_url,
            ]);
        }

        // check limits
        if ($this->getRemainingSubmissionCount($form->id) <= 0) {
            return response()->view('form-limit-exceeded', [
                'redirect_url' => $redirect_url,
            ]);
        }

        // check captcha if enabled
        if ($form->preferences->is_g_captcha_enabled) {

            if (!$request->input('g-recaptcha-response')) {
                return response()->view('form-submission-error', [
                    'error' => 'Captcha is not valid!',
                    'redirect_url' => $redirect_url,
                ]);
            }

            $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret='. $form->preferences->g_captcha_secret .'&response=' . $request->input('g-recaptcha-response'));

            $response_json = $response->json();

            if (!$response_json['success']) {
                return response()->view('form-submission-error', [
                    'error' => 'Captcha is not valid!',
                    'redirect_url' => $redirect_url,
                ]);
            }
        }

        $fields = [];

        foreach ($request->all() as $key => $value) {
            if ($key == 'g-recaptcha-response') {
                // this is not needed
                continue;
            }

            array_push($fields, new FormSubmissionField([
                'name' => $key,
                'value' => $value,
            ]));
        }

        // save the submission
        $submission = new FormSubmission([
            'ip_address' => $request->ip(),
            'is_spam' => false,
        ]);

        $form->submissions()->save($submission);

        $submission->fields()->saveMany($fields);

        if ($form->preferences->redirect_url) {
            $redirect_url = $form->preferences->redirect_url;
        }

        $user = User::where('id', $form->user_id)->first();

        // remove one credit
        $credits = UserCredits::where('user_id', $user->id)->first();
        if ($credits) {
            $credits->credits = $credits->credits - 1;
            $credits->save();
        }

        Mail::to($user)->queue(new NewFormSubmission($submission));

        return response()->view('form-submitted', [
            'redirect_url' => $redirect_url,
        ]);
    }
}
