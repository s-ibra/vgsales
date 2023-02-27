<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Imports\GamesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class GameController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');
        $path = $file->store('import');
        Excel::import(new GamesImport, storage_path('app/' . $path));
        return redirect()->back()->with('success', 'Importation réussie!');
    }

    public function index(Request $request)
    {
        $filePath = storage_path('app/vgsales.csv');
        $file = fopen($filePath, 'r');
        $headers = fgetcsv($file);
        $data = [];

        while ($row = fgetcsv($file)) {
            $data[] = array_combine($headers, $row);
        }

        fclose($file);

        $games = collect($data);

        // Filtrer les données en fonction des cases à cocher
        $filters = $request->only($headers);

        foreach ($filters as $header => $value) {
            if ($value && $value !== 'Tous' && $value !== 'All') {
                $games = $games->where($header, $value);
            }
        }
        return view('games.index', compact('games', 'headers'));
    }   
}
