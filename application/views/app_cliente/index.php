<!-- CSS -->
<link href="<?=base_url()?>public/css/index.css" rel="stylesheet" type="text/css"/>

<!--JS -->
<script src="<?=base_url()?>public/js/app_cliente/index.js" type="text/javascript"></script>


<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <form action="<?=base_url()?>app_cliente/login/logar" method="POST" id="fmrIdCliente">
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="number" class="form-control" id="id" name="id" value="" required placeholder="Preencher ID">
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