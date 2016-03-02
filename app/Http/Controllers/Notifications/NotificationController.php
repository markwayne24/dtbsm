<?php

namespace App\Http\Controllers\Notifications;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.index');
    }
}
