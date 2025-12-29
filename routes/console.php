<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('teac:report')->dailyAt('22:00');
