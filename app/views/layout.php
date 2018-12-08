<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/public/css/bootstrap.css">

    <title><?php echo $title; ?></title>
</head>
<body>

    <header class="navbar navbar-light bg-light">
        <div class="container">
            <div class="row">
                <nav class="col-12">

                </nav>
            </div>
        </div>
    </header>

    <main class="mt-5">
        <div class="container">
            <div class="row">

                <?php echo $content; ?>

            </div>
        </div>
    </main>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>

    
</body>
</html>