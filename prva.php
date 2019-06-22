<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registracija</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        * {
            margin:0;
            padding: 0;
        }
        .sve {
            background-color: #cecece;
            width: 100%;
            margin: auto;
            margin-top: 20px;
            padding: 150px 50px 150px 50px;
            border: 1px solid black;
            border-radius: 20%;
            font-weight: bold;
            box-shadow: 3px 14px 54px #000000;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="sve col-xl-5 col-lg-5 col-md-8 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-2 text-center">
                <p>Neuspjela registracija! Korisnik već postoji!</p> <br>
                <p>Pokušajte ponovno <a href="registracija.php">ovdje</a></p>
            </div>
        </div>
    </div>
</body>
</html>