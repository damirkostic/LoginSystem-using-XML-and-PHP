<?php

$username="";
$password="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$ans=$_POST;

	if (empty($ans["korisnicko"]))  {
        	echo "Korisnicki račun nije unesen.";
		
    		}
	else if (empty($ans["password"]))  {
        	echo "Lozinka nije unesena.";
		
    		}
	else {
		$username= $ans["korisnicko"];
		$password= $ans["password"];
    
        provjera($username,$password);
        is_session_started();
	}
}
function provjera($username, $password) {
	

	$xml=simplexml_load_file("registracija.xml");
	
	
	foreach ($xml->Korisnik as $usr) {
  	 	$usrn = $usr->Korisnicko_ime;
		$usrp = $usr->Lozinka;
		$usrime=$usr->Ime;
		$usrprezime=$usr->Prezime;
		if($usrn==$username){
			if(password_verify($_POST['password'], $usrp)){
               $nameCookie = $username; 
               $valueCookie = 100;
               $timeCookie = time() + (60*4);
               setcookie($nameCookie, $valueCookie, $timeCookie);
               session_start();
               $_SESSION['pozdrav'] = "Prijavljeni ste kao $usrime $usrprezime";
               include('session2.php'); die();
               return;
				}
			
			}
		}		
	echo "Korisnik ne postoji.";
	return;
}
function is_session_started(){
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prijava</title>
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
            padding: 20px;
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
                <form action="prijava.php" method="POST">
                    <p>Dobrodošli!</p>
                    <div class="form-group">
                        <label>Korisničko ime:</label>
                        <input type="text" name="korisnicko" pattern=".{3,}" title="Mora sadržavati 3 ili više znakova." placeholder="npr. dkostic">
                    </div>
                    <div class="form-group">
                        <label>Lozinka:</label>
                        <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Mora sadržavati barem jedno veliko i malo slovo i broj, te biti dugačak minimalno 8 znakova" placeholder="Unesite lozinku">
                    </div>
                    <input type="submit" value="Prijava" name="prijava" class="btn btn-primary">
                    <br><br>
                    <p>Nemate korisničko ime? Registriraj se <a href="registracija.php">ovdje</a>!</p>
                 </form>
            </div>
        </div>
    </div>
</body>
</html>