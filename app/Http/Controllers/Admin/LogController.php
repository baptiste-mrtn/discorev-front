<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DiscorevApiService;
use App\Models\Api\User;
use App\Models\Api\History;
use Illuminate\Support\Facades\Session;

class LogController extends Controller
{
    private DiscorevApiService $api;

    public function __construct(DiscorevApiService $api)
    {
        $this->api = $api;
    }

    public function index()
    {
        $user = Session::get('user');
        $usersApi = $this->api->get('users');
        $users = User::fromApiCollection($usersApi);

        $historiesApi = $this->api->get('histories');
        $histories = History::fromApiCollection($historiesApi);

        $histories->transform(function ($history) use ($users) {
            $history->user = $users->firstWhere('id', $history->userId);
            return $history;
        });

        $histories = $histories->sortByDesc('createdAt');

        //dd($history);
        return view('admin.logs.index ', compact('user', 'histories'));
    }
}
