<?php  

        // Ruta del archivo JSON local
        const JSON_URL = "https://whenisthenextmcufilm.com/api";

        // Obtener los datos del archivo JSON
        $result = @file_get_contents(JSON_URL);

        // Verificar si hubo un error en la solicitud
        if ($result === false) {
            $error_message = error_get_last()['message'];
            echo "<p>Error al obtener los datos: $error_message</p>";
            exit;
        }

        // Decodificar el JSON
        $data = json_decode($result, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // Manejo de errores de JSON
            $error_message = "Error al decodificar el JSON: " . json_last_error_msg();
            echo "<p>$error_message</p>";
            exit;
        }

       /* // Mostrar los datos (ejemplo simplificado)
        if (!empty($data)) {
            echo "<pre>" . htmlspecialchars(print_r($data, true)) . "</pre>";
        } else {
            echo "<p>No se encontraron datos.</p>";
        }
*/
        ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Próxima Película de Marvel</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
>
    <style>
        :root {
            color-scheme: light dark;  
            background-color: black;       
        }
        body {
            display: grid;
            place-content: center;
            
        }

        section {
            display: flex;
            justify-content: center;
            text-align: center;
        }

        hgroup {
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        h3 {
            color: white;
        }

        p{
            color: #3498db;
        }

        main {
            text-align: center;
        }

        img {
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <main>
        <section> 
            <img src="<?= $data["poster_url"]; ?>" width="300" alt="Poster de <?= $data["title"]; ?>" 
            style="border-radius: 16px"/>
        </section>

        <hgroup>
            <h3><?= $data["title"]; ?> se estrena en <?= $data["days_until"]; ?> días</h3>
            <p>Fecha de estreno: <?= $data["release_date"]; ?></p>
            <p>La siguente película es: <?= $data["following_production"]["title"]; ?></p>
        </hgroup>

        <section>
             <img src="<?= $data["following_production"]["poster_url"]; ?>" width="300" alt="Poster de <?= $data["following_production"]["title"]; ?>"
             style="border-radius: 16px"/>
        </section>

        <hgroup>
            <h3><?= $data["following_production"]["title"]; ?> se estrena en <?= $data["following_production"]["days_until"]; ?> días</h3>
            <p>Fecha de estreno: <?= $data["following_production"]["release_date"]; ?></p>
        </hgroup>

    </main>
</body>
</html>
