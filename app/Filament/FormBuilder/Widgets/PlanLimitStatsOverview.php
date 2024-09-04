<?php

namespace App\Filament\FormBuilder\Widgets;

use App\Models\Form;
use App\Models\FormSubmission;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class PlanLimitStatsOverview extends BaseWidget
{
    private function getSubmissionCount()
    {
        $current_date = Carbon::now();

        $my_forms = Form::where('user_id', auth()->user()->id)->pluck('id');
        if (!$my_forms) {
            return 0;
        }

        $submission_count = FormSubmission::whereIn('form_id', $my_forms)
            ->whereMonth('created_at', $current_date->month)
            ->whereYear('created_at', $current_date->year)
            ->count();

        return $submission_count;
    }

    private function getRemainingSubmissionCount()
    {
        // get limit count
        $count = auth()->user()->plans[0]->plan->features()->where('name', 'submissions_limit')->first()->value;

        return $count - $this->getSubmissionCount();
    }

    private function getCurrentPlan()
    {
        return auth()->user()->plans[0]->plan->name;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Current plan', $this->getCurrentPlan()),
            Stat::make('This months submission usage', $this->getSubmissionCount())
                ->description('Remaning submissions: ' . $this->getRemainingSubmissionCount()),
        ];
    }
}
