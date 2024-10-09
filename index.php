<?php 

const API_URL = "https://whenisthenextmcufilm.com/api";
$ch = curl_init(API_URL);

// Recibir resultado de petición pero sin mostrar en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar petición y guardar resultado
$result = curl_exec($ch);
$data = json_decode($result, true);

curl_close($ch);

// Fecha obtenida del array de la API
$release_date = $data['release_date']; 

// Convertir la fecha usando DateTime
$date = new DateTime($release_date);

// Formatear la fecha a d-m-Y (día-mes-año)
$formatted_date = $date->format('d-m-Y');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Bebas Neue', 'ui-sans-serif', 'system-ui'],
            }
          }
        }
      }
    </script>

    <title>Próxima Película de Marvel</title>

</head>

<body class="font-sans">

    <section class="py-12">

        <div class="container mx-auto px-4 text-center">

            <h1 class="text-4xl md:text-5xl font-semibold text-red-600 pb-6">Próxima película de Marvel</h1>

            <h2 class="text-3xl font-semibold mb-4"><?= $data['title']; ?></h2>

            <h2 class="text-3xl font-semibold mb-4">Se estrena en <span class="text-red-600"><?= $data['days_until']; ?></span>  días.</h2>

            <div class="max-w-md mx-auto overflow-hidden mb-6 px-6">

                <img class="w-full h-auto object-cover" src="<?= $data['poster_url']; ?>" alt="Poster de <?= $data['title']; ?>">

            </div>

            <p class="text-2xl font-semibold mb-2">Fecha de estreno: <span class="text-red-500"><?= $formatted_date ?></span></p>


            <p class="text-2xl font-semibold mb-2">La siguiente película es: <span class="text-red-500"> <?= $data['following_production']['title']; ?></p>

            <p class="text-2xl font-semibold mb-2">Se estrena en <span class="text-red-500"><?= $data['following_production']['days_until']; ?></span> días.</p>

        </div>

    </section>

    

</body>

</html>
