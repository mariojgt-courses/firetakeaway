<?php

namespace Mariojgt\Firetakeaway\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('firetakeaway::content.dashboard.index');
    }
}
