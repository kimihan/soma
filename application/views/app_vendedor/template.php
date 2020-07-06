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


    <style>
        .jumbotron {
            background-color: #0C238A !important;
            color: white;
        }
        body {
            background-color: #0C238A !important;
            padding-top: 30px;
        }
        #footer {
            background-color: #0C238A !important;
            color: white;
            border-top: #DEDE1F 3px solid;
        }
        .btn:not(#btnCarregando):not(.navbar-toggler):not(.btn-not-default) {
            background-color: #3049FF !important;
            color: white;
            border: #DEDE1F 1px solid;
        }
        .btn:hover:not(#btnCarregando):not(.navbar-toggler):not(.btn-not-default) {
            background-color: #DEDE1F !important;
            color: white;
            border: #3049FF 1px solid;
        }
        .bg-dark {
            background-color: #0C238A !important;
            border-bottom: #DEDE1F 3px solid;
        }
        .navbar-toggler {
            border: #DEDE1F 1px solid !important;
        }
    </style>

    </head>

    <body>
        <div class="fixed-top">
            <div class="collapse" id="navBarLogin">
                <div class="p-4 bg-dark">
                    <a href="<?=base_url()?>app_vendedor/login/logout" class="btn btn-danger btn-block btn-not-default">Sair</a>
                </div>
            </div>
            <nav class="navbar navbar-dark bg-dark">
                <?php 
                    if((count($this->session->userdata("sVendedor")) > 0)) {
                        echo '
                                <a class="navbar-brand" href="#">' . NOME_APP_VENDEDOR . '</a>"
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarLogin" aria-controls="navBarLogin" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>';
                    } else {
                        echo "<a class='navbar-brand col-12 text-center' href='#'>" . NOME_APP_VENDEDOR . "</a>";
                    }
                ?>
            </nav>
        </div>
        <main id="contents">
            <?= $contents ?>

            <?php $this->load->view('errors/modals/erro_modal'); ?>
        </main>
        <footer>
            <nav class="navbar fixed-bottom navbar-light bg-light" id="footer">
                <div class="container">
                    <div class="row w-100">
                        <div class="col-12 text-center ml-3">
                            Soma <?= date('Y'); ?>
                        </div>
                    </div>
                </div>
            </nav>
        </footer>
    </body>

</html>