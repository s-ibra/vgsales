<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GamesImport;
use App\Models\Game;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class GameModel
{
    public static function import(Request $request)
    {
        $filePath = storage_path('app/vgsales.csv');

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Le fichier CSV n\'existe pas!');
        }

        $file = fopen($filePath, 'r');
        $headers = fgetcsv($file);
        $data = [];

        while ($row = fgetcsv($file)) {
            // Choix des colonnes à récupérer : 'Name', 'Platform', 'Year', 'Genre', 'Global_Sales'
            $row = array_intersect_key($row, array_flip(['1', '2', '3', '4', '10']));
            if (count($row) === 5) {
                $data[] = array_combine(['Name', 'Platform', 'Year', 'Genre', 'Global_Sales'], $row);
            }
        }
        fclose($file);

        $games = collect($data);
        foreach ($games as $game) {
            Game::updateOrCreate($game);
        }

        return redirect()->back()->with('success', 'Importation réussie!');
    }

    public static function index(Request $request)
    {
        $headers = [
            'Name',
            'Platform',
            'Year',
            'Genre',
            'Global_Sales'
        ];
        $filePath = storage_path('app/vgsales.csv');
        $file = fopen($filePath, 'r');
        $data = [];
        while ($row = fgetcsv($file)) {
            // Choix des colonnes à récupérer : 'Name', 'Platform', 'Year', 'Genre', 'Global_Sales'
            $row = array_intersect_key($row, array_flip(['1', '2', '3', '4', '10']));
            if (count($row) === 5) {
                $data[] = array_combine(['Name', 'Platform', 'Year', 'Genre', 'Global_Sales'], $row);
            }
        }
        fclose($file);
        $games = collect($data);

        // Filtrer les données en fonction des cases à cocher
        $filters = array_filter($request->only($headers));

        foreach ($filters as $header => $value) {
            if ($value && $value !== 'Tous' && $value !== 'All') {
                $games = $games->where($header, $value);
            }
        }
        return view('games.index', compact('games', 'headers'));
    }
}
