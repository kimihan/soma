<html lang="pt">
    <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bem-vindo ao Soma</title>

        <!-- CSS -->
        <link href="<?=base_url()?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <!-- JS -->
        <script src="<?=base_url()?>public/js/jquery-3.4.1.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>public/js/popper.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>public/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>public/js/cookie.js" type="text/javascript"></script>
        <script src="<?=base_url()?>public/js/jquery.mask.js" type="text/javascript"></script>
        <script src="<?=base_url()?>public/js/crypto-js.min.js" type="text/javascript"></script>

        <script>
            var baseUrl = <?=base_url()?>;
        </script>


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
                            <span>Soma <?= date('Y'); ?></span>
                        </div>
                    </div>
                </div>
            </nav>
        </footer>
    </body>

    <?php $this->load->view('errors/modals/erro_modal'); ?>

</html>