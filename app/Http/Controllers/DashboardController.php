<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use DB;
class DashboardController extends Controller
{
    public function dashboard()
{

    $notification['notify'] = DB::select("
    SELECT
        users.id,
        users.name,
        users.lastname,
        users.email,
        COUNT(messages.is_read) AS unread
    FROM
        users
    LEFT JOIN
        messages ON users.id = messages.send_to AND messages.is_read = 0
    WHERE
        users.id = " . Auth::id() . "
    GROUP BY
        users.id, users.name, users.lastname, users.email
");

    $query = Message::getNotify();
        $getNot['getNotify'] = $query->orderBy('id', 'desc')->take(10)->get();
$viewPath = Auth::user()->user_type == 0
        ? 'superadmin.dashboard'
        : (Auth::user()->user_type == 1
            ? 'admin.dashboard'
            : 'employee.dashboard');

    
    return view($viewPath,[
        'notification' => $notification,
        'getNot' => $getNot,
    ]);
}



}
