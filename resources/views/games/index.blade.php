@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Liste des jeux importés</h1>
        <div class="row">
            <div class="col-md-3">
                <form method="GET" action="{{ route('games.index') }}">
                    @foreach($headers as $header)
                        <div class="form-group">
                            <label for="{{ $header }}">{{ $header }}</label>
                            <select name="{{ $header }}" class="form-control">
                                <option value="">Tous</option>
                                @foreach($games->pluck($header)->unique() as $value)
                                    <option value="{{ $value }}" @if(request($header) == $value) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </form>
            </div>
            <div class="col-md-9">
                @if ($games->isNotEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Rank</th>
                                <th style="text-align: center;">Name</th>
                                <th style="text-align: center;">Platform</th>
                                <th style="text-align: center;">Year</th>
                                <th style="text-align: center;">Genre</th>
                                <th style="text-align: center;">Publisher</th>
                                <th style="text-align: center;">NA_Sales</th>
                                <th style="text-align: center;">EU_Sales</th>
                                <th style="text-align: center;">JP_Sales</th>
                                <th style="text-align: center;">Other_Sales</th>
                                <th style="text-align: center;">Global_Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($games as $game)
                                <tr>
                                    <td>{{ $game["Rank"] }}</td>
                                    <td style="text-align: center;">{{ $game["Name"] }}</td>
                                    <td style="text-align: center;">{{ $game["Platform"] }}</td>
                                    <td style="text-align: center;">{{ $game["Year"] }}</td>
                                    <td style="text-align: center;">{{ $game["Genre"] }}</td>
                                    <td style="text-align: center;">{{ $game["Publisher"] }}</td>
                                    <td style="text-align: center;">{{ $game["NA_Sales"] }}</td>
                                    <td style="text-align: center;">{{ $game["EU_Sales"] }}</td>
                                    <td style="text-align: center;">{{ $game["JP_Sales"] }}</td>
                                    <td style="text-align: center;">{{ $game["Other_Sales"] }}</td>
                                    <td style="text-align: center;">{{ $game["Global_Sales"] }}</td>
                                </tr> 
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Aucun jeu trouvé.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
