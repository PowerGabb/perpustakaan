<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
</head>
<body>
    
    <div>
        <h1>Nama: {{ $account->name }}</h1>
        <p>NISN: {{ $account->nisn}}</p>
        <p>Kelas: {{ $account->class}}</p>
        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($account->id, 'C39') }}" alt="image">
    </div>
</body>
</html>