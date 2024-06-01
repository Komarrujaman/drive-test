<!-- show_data_view.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data View</title>
</head>

<body>
    <h1>Data yang Diterima:</h1>
    <pre>
    {{ print_r($data, true) }}
    </pre>
</body>

</html>