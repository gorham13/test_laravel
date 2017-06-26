<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoryLog;
use App\User;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function getUserHistory()
    {

        $dt = new Carbon('now');

        $user = User::withCount(['historyLog as year' => function($query) use($dt)
        {
            $query->where('created_at', '>',  $dt->copy()->startOfYear());

        }])

            ->withCount(['historyLog as mounth' => function($query) use($dt)
            {
                $query->where('created_at', '>',  $dt->copy()->startOfMonth());
            }])

            ->withCount(['historyLog as day' => function($query) use($dt)
            {

                $query->where('created_at', '>',  $dt->copy()->startOfDay());
            }])
            ->get();

        return response()->json($user, 200);
    }
}
