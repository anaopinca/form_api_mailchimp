<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esercizio API Mailchimp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
    <div class="container text-center">
        <h1>Esercizio form invio a API MailChimp</h1><br>
        <h2>Form di registrazione newsletter</h2>
        <div class="row bg-dark bg-opacity-25 py-3">
            <div class="col-md-6 offset-md-3"> 
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">      
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Cognome</label>
                    <input type="text" class="form-control" id="surname" name="surname" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Inserisci la tua email</label>
                    <input type="email" class="form-control" id="email" name="email" required>    
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="check" name="ceck" required>
                    <label class="form-check-label" for="check">Autorizzo al trattamento dei dati personali.</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>

   <?php
    if (!empty($_GET)) {
        //visuoalizzo un messagio al cliente
    echo '<div class="alert alert-success mt-3 mt-md-5 " role="alert">
            Grazie per esserti registratto alla nostra newsletter!
        </div>';
        // API to mailchimp 
        // ** change $list_id and $authTocket with your data here **
        $list_id = '1234567890';
        $authToken = '1234567890-us9';
        // **********************************************************
        $postData = array(
            "email_address" => $_GET['email'],
            "status" => "subscribed",
            "merge_fields" => array(
            "FNAME"=> $_GET['name'],
            "LNAME"=> $_GET['surname']),
        );

            // Setup cURL
        $ch = curl_init('https://us9.api.mailchimp.com/3.0/lists/'.$list_id.'/members/');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: apikey '.$authToken,
                'Content-Type: application/json'
                ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));
            // Send the request
        $response = curl_exec($ch);
        }
    ?>
        </div>
    </div>
</body>
</html>