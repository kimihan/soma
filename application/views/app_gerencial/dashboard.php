<script>
    var idRegistroExcluir = 0;
</script>
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Dashboard</h3>
        </div>
    </div>
    <div class="listagemGeral">
        <div class="controllers row">
            <form id="formBusca" method="get" class="row" action="<?=base_url()."app_gerencial/index"?>" style="width: 100%;">
                <div class="col-4">
                    <div class="col-4"><label class="col-form-label">Data inicial</label></div>
                    <div class="col-8">
                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="data_inicial">
                    </div>
                </div>
                <div class="col-4">
                    <div class="col-4"><label class="col-form-label">Data final</label></div>
                    <div class="col-8">
                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="data_final">
                    </div>
                </div>
                <div class="col-4">
                    <div class="col-4"><label class="col-form-label"> </label></div>
                    <div class="col-8">
                        <button type="submit" class="btn btn-success mr-2">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Mixed Widget 1-->
                <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-8 col-form-label">Numero total de clientes adimplentes</label>
                            <div class="col-4">
                                <label class="col-12 col-form-label"><?=$clientesAdimplementes?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-8 col-form-label">Numero total de clientes inadimplentes</label>
                            <div class="col-4">
                            <label class="col-12 col-form-label"><?=$clientesInadimplentes?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-8 col-form-label">Numero total de clientes</label>
                            <div class="col-4">
                            <label class="col-12 col-form-label"><?=$totalClientes?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Mixed Widget 1-->
            </div>
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Mixed Widget 1-->
                <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-8 col-form-label">Numero total de cobranças pagas</label>
                            <div class="col-4">
                                <label class="col-12 col-form-label"><?=$cobrancasPagas?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-8 col-form-label">Numero total de cobranças a vencer</label>
                            <div class="col-4">
                                <label class="col-12 col-form-label"><?=$cobrancasAVencer?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-8 col-form-label">Numero total de cobranças vencidas</label>
                            <div class="col-4">
                                <label class="col-12 col-form-label"><?=$cobrancasVencidas?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Mixed Widget 1-->
            </div>
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Mixed Widget 1-->
                <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="form-group row">
                        <label class="col-8 col-form-label">Valor em reais recebido</label>
                            <div class="col-4">
                                <label class="col-12 col-form-label">R$ <?=number_format($valorRecebido, 2, ",", ".")?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-8 col-form-label">Valor em reais a vencer</label>
                            <div class="col-4">
                                <label class="col-12 col-form-label">R$ <?=number_format($valorAReceber, 2, ",", ".")?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-8 col-form-label">Valor em reais vencido</label>
                            <div class="col-4">
                                <label class="col-12 col-form-label">R$ <?=number_format($valorVencido, 2, ",", ".")?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-8 col-form-label">Valor total em reais</label>
                            <div class="col-4">
                                <label class="col-12 col-form-label">R$ <?=number_format($valorTotal, 2, ",", ".")?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Mixed Widget 1-->
            </div>
        </div>
    </div>
</div>
<!--end::Card-->


<style>
    .listagemGeral
    {
        padding: 0 0 0 25px;
    }
</style>

