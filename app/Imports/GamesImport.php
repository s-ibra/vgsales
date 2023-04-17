<?php

namespace App\Imports;

use App\Models\Game;
use Maatwebsite\Excel\Concerns\ToModel;

class GamesImport implements ToModel
{
    public function model(array $row)
    {
        return new Game([
            'Name' => $row[0],
            'Platform' => $row[1],
            'Year' => $row[2],
            'Genre' => $row[3],
            'Global_Sales' => $row[4],
        ]);
    }
}
