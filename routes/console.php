<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('teac:report')->dailyAt(config('teac.daily_report_hour'));
