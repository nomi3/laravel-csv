<!DOCTYPE html>
<html>
<head>
    <title>Sample Blade Page</title>
</head>
<body>
    <h1>Welcome to the Sample Blade Page!</h1>

    <p>This is a sample Blade template.</p>

    <ul>
        @foreach ($insureds as $insured)
            <li>{{ $insured->name }}</li>
        @endforeach
    </ul>
</body>
</html>
