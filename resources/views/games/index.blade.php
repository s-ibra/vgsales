@extends('layouts.app')
@section('content')
<head>
	<title>Exemple de DataTable</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
</head>
<body>
    <h1>Liste des jeux importés</h1>
    <form method="GET" action="{{ route('games.index') }}">
        @foreach($headers as $header)
            <div>
                <label for="{{ $header }}">{{ $header }}</label>
                <select name="{{ $header }}">
                    <option value="">Tous</option>
                    @foreach($games->pluck($header)->unique() as $value)
                        <option value="{{ $value }}" @if(request($header) == $value) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Filtrer</button>
    </form>
    @if ($games->isNotEmpty())
        <table id="example" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Platform</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Global_Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                <tr>
                    <td>{{ $game["Name"] }}</td>
                    <td>{{ $game["Platform"] }}</td>
                    <td>{{ $game["Year"] }}</td>
                    <td>{{ $game["Genre"] }}</td>
                    <td>{{ $game["Global_Sales"] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun jeu trouvé.</p>
    @endif
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable();
		});
	</script>

</body>
@endsection

