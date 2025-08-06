<?php

use App\Livewire\DashboardOverview;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardOverview::class)->name('dashboard');