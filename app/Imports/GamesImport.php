<?php

namespace App\Imports;

use App\Models\Game;
use Maatwebsite\Excel\Concerns\ToModel;

class GamesImport implements ToModel
{
    public function model(array $row)
    {
        return new Game([
            'Rank' => $row[0],
            'Name' => $row[1],
            'Platform' => $row[2],
            'Year' => $row[3],
            'Genre' => $row[4],
            'Publisher' => $row[5],
            'NA_Sales' => $row[6],
            'EU_Sales' => $row[7],
            'JP_Sales' => $row[8],
            'Other_Sales' => $row[9],
            'Global_Sales' => $row[10],
        ]);
    }
}
