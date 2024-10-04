<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code PDF</title>
</head>
<body>
    <h1>Employee Information</h1>
    <p>Name: {{ $names->name }}</p>
    <p>Employee ID: {{ $names->em_id }}</p>

    <h2>QR Code</h2>
    <img src="data:image/png;base64, {!! $qrcode !!}">

</body>
</html>