<?php

namespace App\Http\Controllers;

use App\Models\GameModel;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function import(Request $request)
    {
        return GameModel::import($request);
    }

    public function index(Request $request)
    {
        return GameModel::index($request);
    }
}
