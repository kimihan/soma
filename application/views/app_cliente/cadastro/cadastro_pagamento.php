<!-- CSS -->
<link href="public/img/app_cliente/index.css" rel="stylesheet" type="text/css"/>

<!--JS -->
<script src="public/js/app_cliente/index.js" type="text/javascript"></script>


<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <h1 class="text-center font-italic">
                    APP Cliente
                </h1>
            </div>
        </div>
        <form>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-6 mb-2">
                    <select class="form-control">
                        <option>Escolher forma de pagamento</option>
                    </select>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-6 mb-2">
                    <select class="form-control">
                        <option>Escolher periodicidade de pagamento</option>
                    </select>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-6 mb-2">
                    <input type="text" class="form-control" value="" required placeholder="Nome no cartão">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-6 mb-2">
                    <input type="text" class="form-control" value="" required placeholder="Número do cartão">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-4 mb-2">
                    <input type="text" class="form-control" value="" required placeholder="Vencimento">
                </div>
                <div class="col-2 mb-2">
                    <input type="text" class="form-control" value="" required placeholder="CVV">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Proximo</button>
                </div>
            </div>
        </form>  
    </div>
</div>