<form method="POST" action="{{ route('games.import') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="file">Fichier CSV:</label>
        <input type="file" name="file" class="form-control-file">
    </div>

    <button type="submit" class="btn btn-primary">Importer</button>
</form>
