@extends('layouts.app')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    <canvas id="myChart"></canvas>
    <script>
		// Les données du jeu
		var gameData = {
			"Rank": 1,
			"Name": "Wii Sports",
			"Platform": "Wii",
			"Year": 2006,
			"Genre": "Sports",
			"Publisher": "Nintendo",
			"NA_Sales": 41.49,
			"EU_Sales": 29.02,
			"JP_Sales": 3.77,
			"Other_Sales": 8.46,
			"Global_Sales": 82.74
		};

		// Récupération des données du jeu
		var gameName = gameData.Name;
		var naSales = gameData.NA_Sales;
		var euSales = gameData.EU_Sales;
		var jpSales = gameData.JP_Sales;
		var otherSales = gameData.Other_Sales;
		var globalSales = gameData.Global_Sales;

		// Création du graphique
		var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ['NA', 'EU', 'JP', 'Other', 'Global'],
				datasets: [{
					label: 'Ventes de ' + gameName,
					data: [naSales, euSales, jpSales, otherSales, globalSales],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)'
					],
					borderColor: [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
@endsection
