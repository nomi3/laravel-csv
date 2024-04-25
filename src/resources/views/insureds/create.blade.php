<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample CSV アップロード</title>
</head>
<body>
    <h1>CSV ファイルアップロード</h1>
    <form action="{{ route('insureds.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="csv_file">CSV ファイル:</label>
            <input type="file" id="csv_file" name="csv_file" required>
        </div>
        <div>
            <button type="submit">アップロード</button>
        </div>
    </form>
</body>
</html>
