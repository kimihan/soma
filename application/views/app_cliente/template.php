<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Bem-vindo ao Soma</title>

        <!-- CSS -->
        <link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <!-- JS -->
        <script src="public/js/jquery-3.4.1.min.js" type="text/javascript"></script>
        <script src="public/js/popper.min.js" type="text/javascript"></script>
        <script src="public/js/bootstrap.min.js" type="text/javascript"></script>


    </head>

    <body>
        <main id="contents">
            <?= $contents ?>
        </main>
        <footer>
            <nav class="navbar fixed-bottom navbar-light bg-light">
                <div class="container">
                    <div class="row justify-content-center w-100">
                        <div class="col-12 text-center">
                            <span>APP Soma <?= date('Y'); ?></span>
                        </div>
                    </div>
                </div>
            </nav>
        </footer>
    </body>

</html>