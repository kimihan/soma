<script>
    var idRegistroExcluir = 0;
</script>
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label"><?=$listName?>
        </div>
    </div>
    <div class="listagemGeral">
        <div class="controllers row">
            <form id="formBusca" method="get" class="row" action="<?=base_url()."app_gerencial/".$searchMethod?>" style="width: 100%;">
                <?php foreach($fields as $key => $value):?>
                    <div class="col-2">
                        <div class="col-4"><label class="col-form-label"><?=$value["name"]?></label></div>
                        <div class="col-8">
                            <input class="form-control" type="text" value="<?=!empty($value["search"])?$value["search"]:NULL?>" name="<?=$value["field"]?>" id="<?=$value["field"]?>"/>
                        </div>
                    </div>
                <?php endforeach;?>
                <div class="col-2">
                    <div class="col-4"><label class="col-form-label"></label></div>
                    <div class="col-8">
                        <button type="submit" class="btn btn-success mr-2">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table">
            <thead>
            <tr>
                <?php foreach($fields as $key => $value):?>
                    <th scope="col"><?=$value["name"]?></th>
                <?php endforeach;?>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($values as $key => $valueRow):?>
                <tr>
                    <?php foreach($fields as $key => $value):?>
                        <td><?=$valueRow[$value["field"]]?></td>
                    <?php endforeach;?>
                    <td>
                        <a href="<?=base_url()?>app_gerencial/clientes/ver/<?=$valueRow[$fields[0]["field"]]?>"><button type="button" class="btn btn-primary" style="margin: 0 5px;">Ver</button></a>
                        <a href="<?=base_url()?>app_gerencial/clientes/editar/<?=$valueRow[$fields[0]["field"]]?>"><button type="button" class="btn btn-info" style="margin: 0 5px;">Editar</button></a>
                        <button type="button" class="btn btn-danger btnExcluir" style="margin: 0 5px;" data-toggle="modal" data-target="#modalConfirmacaoExclusao" data-id="<?=$valueRow[$fields[0]["field"]]?>">Excluir</button>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<!--end::Card-->


<!-- Modal-->
<div class="modal fade" id="modalConfirmacaoExclusao" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Exclusão de registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir esse registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-danger btnExecutaExclusao" data-dismiss="modal">Sim</button>
            </div>
        </div>
    </div>
</div>

<style>
    .listagemGeral
    {
        padding: 0 0 0 25px;
    }
</style>


<script>
    function excluiRegistro(){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial/<?=$deleteMethod?>",
            data: {idRegistro: idRegistroExcluir},
            success : function(text){
                location.reload();
            }
        });
    }
    jQuery(function() {
        $(".btnExcluir").click(function(event){
            idRegistroExcluir = $(this).attr("data-id");
        });

        $(".btnExecutaExclusao").on("click", function(event){
            excluiRegistro(idRegistroExcluir);
        });
    });
</script>