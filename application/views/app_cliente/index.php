<!-- CSS -->
<link href="public/css/index.css" rel="stylesheet" type="text/css"/>

<!--JS -->
<script src="public/js/app_cliente/index.js" type="text/javascript"></script>


<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <h1 class="text-center font-italic">
                <?=NOME_APP_CLIENTE?>
                </h1>
            </div>
        </div>

        <form>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" id="id" name="id" value="" required placeholder="Preencher ID">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Preencher dados</button>
                </div>
            </div>
        </form>  
    </div>
</div>