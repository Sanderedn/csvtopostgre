<?php
try{
            $pdo = new PDO("pgsql:host='127.0.0.1' port='5432' dbname='teste' user='postgres' password='postgres'");
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
            return $pdo;
	if (isset($_FILES['arquivo'])){


		if (is_uploaded_file($_FILES['arquivo']['tmp_name'])) {


            echo "<p>" . "arquivo ". $_FILES['arquivo']['tmp_name'] ." upload com sucesso." . "</p>";
            echo "<p>Conteudo:</p>";
           readfile($_FILES['arquivo']['tmp_name']);
        }else{
        	echo "Não Deu";
        }



       // Import uploaded file to Database
        $handle = fopen($_FILES['arquivo']['tmp_name'], "r");
        $import=$db->prepare("INSERT INTO teste (name, email) VALUES (:name, :email)");
        while (($data = fgetcsv($handle)) !== FALSE) {
         	var_dump(($data = fgetcsv($handle)));
         	$import->bindValue(':name', $data[0]);
			$import->bindValue(':email', $data[1]);
            
        }
        fclose($handle);
    }
     } catch(\PDOException $e){
             echo"Nãoo foi possível fazer a conexãoo com o banco de dados. Erro codigo: ".$e -> getCode()." Mesagem: ".$e -> getMessage();
            return false;
        }
?>
