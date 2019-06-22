
<?php
    
    function stvoriXML(){
		if(!file_exists('registracija.xml')){
			if(isset($_POST['rjesenje']) && isset($_POST['slazem'])) {
				$ime = $_POST['ime'];
				$prezime = $_POST['prezime'];
				$korisnicko = $_POST['korisnicko'];
				$password = $_POST['password'];
				$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);

				$array = array('ime' => $ime,'prezime' => $prezime, 'korisnickoime' => $korisnicko, 'lozinka' => $password);

				$xmlica = '<Korisnici>';

					$xmlica .= '<Korisnik>';

			
						$xmlica .= '<Ime>' . $ime . '</Ime>';
						$xmlica .= '<Prezime>' . $prezime . '</Prezime>';
						$xmlica .= '<Korisnicko_ime>' . $korisnicko . '</Korisnicko_ime>';
						/*$xmlica .= '//lozinka je kriptirana';*/
						$xmlica .= '<Lozinka>' . $pass_hash . '</Lozinka>';
					
					$xmlica .= '</Korisnik>';

				$xmlica .= '</Korisnici>';

				
				file_put_contents('registracija.xml', $xmlica);
				include('druga.php'); die();
			}
		}
		else{
			if(isset($_POST['rjesenje']) && isset($_POST['slazem'])) {
			
				$ime = $_POST['ime'];
				$prezime = $_POST['prezime'];
				$korisnicko = $_POST['korisnicko'];
				$password = $_POST['password'];
				$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
			
				$xml=simplexml_load_file("registracija.xml");
				
				$xmlica = '<Korisnici>';
				
				foreach ($xml->Korisnik as $usr) {
					$usrn = $usr->Korisnicko_ime;
					$usrp = $usr->Lozinka;
					$usrime=$usr->Ime;
					$usrprezime=$usr->Prezime;
					
					if($usrn==$korisnicko){
						include('prva.php'); die();
					}
					
					$xmlica .= '<Korisnik>';
			
						$xmlica .= '<Ime>' . $usrime . '</Ime>';
						$xmlica .= '<Prezime>' . $usrprezime . '</Prezime>';
						$xmlica .= '<Korisnicko_ime>' . $usrn . '</Korisnicko_ime>';
						/*$xmlica .= '//lozinka je kriptirana';*/
						$xmlica .= '<Lozinka>' . $usrp . '</Lozinka>';
					
					$xmlica .= '</Korisnik>';
				}

				$array = array('ime' => $ime,'prezime' => $prezime, 'korisnickoime' => $korisnicko, 'lozinka' => $password);
				
				$xmlica .= '<Korisnik>';

			
					$xmlica .= '<Ime>' . $ime . '</Ime>';
					$xmlica .= '<Prezime>' . $prezime . '</Prezime>';
					$xmlica .= '<Korisnicko_ime>' . $korisnicko . '</Korisnicko_ime>';
					/*$xmlica .= '//lozinka je kriptirana';*/
					$xmlica .= '<Lozinka>' . $pass_hash . '</Lozinka>';
					
				$xmlica .= '</Korisnik>';
				
				$xmlica .= '</Korisnici>';
				
				file_put_contents('registracija.xml', $xmlica);
				include('druga.php'); die();
			}
		}
}
stvoriXML();
?>

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
                <form action="registracija.php" method="POST">
                    <div class="form-group">
                        <label> Ime: </label>
                        <input type="text" name="ime" pattern=".{3,21}" title="Mora biti u rasponu od 3 do 21 slova" placeholder="npr. Damir">
                    </div>
                    <div class="form-group">
                        <label>Prezime:</label>
                        <input type="text" name="prezime" pattern=".{3,21}" title="Mora biti u rasponu od 3 do 21 slova" placeholder="npr. Koštić"> 
                    </div>
                    <div class="form-group">
                        <label>Korisničko ime:</label>
                        <input type="text" name="korisnicko" pattern=".{6,}" title="Mora sadržavati 6 ili više znakova." placeholder="npr. dkostic">
                    </div>
                    <div class="form-group">
                        <label>Lozinka:</label>
                        <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Mora sadržavati barem jedno veliko i malo slovo i broj, te biti dugačak minimalno 8 znakova" placeholder="Unesite lozinku">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="slazem" required><label>Slažem se sa uvjetima registracije</label>
                    </div>

                    <a href="prijava.php" class="btn btn-primary">Prijava</a> <input type="submit" value="Generiraj" name="rjesenje" class="btn btn-primary">
                 </form>

            </div>
        </div>
    </div>
</body>
</html>

