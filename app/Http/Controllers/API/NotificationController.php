<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function update(Request $request, Notification $notification)
    {
        $notification->viewed = $request->viewed;
        $notification->save();

        return response()->json();
    }
}
