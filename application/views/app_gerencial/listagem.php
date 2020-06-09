<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Clientes
        </div>
    </div>
    <div class="listagemGeral">
        <div class="controllers row">
            <div class="col-2">
                <div class="col-4"><label class="col-form-label">Id</label></div>
                <div class="col-8">
                    <input class="form-control" type="text" value="" id="example-text-input"/>
                </div>
            </div>
            <div class="col-2">
                <div class="col-4"><label class="col-form-label">Nome</label></div>
                <div class="col-8">
                    <input class="form-control" type="text" value="" id="example-text-input"/>
                </div>
            </div>
            <div class="col-2">
                <div class="col-4"><label class="col-form-label">E-mail</label></div>
                <div class="col-8">
                    <input class="form-control" type="text" value="" id="example-text-input"/>
                </div>
            </div>
            <div class="col-2">
                <div class="col-4"><label class="col-form-label">Telefone</label></div>
                <div class="col-8">
                    <input class="form-control" type="text" value="" id="example-text-input"/>
                </div>
            </div>
            <div class="col-2">
                <div class="col-4"><label class="col-form-label"></label></div>
                <div class="col-8">
                    <button type="button" class="btn btn-success mr-2">Submit</button>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <?php foreach($fields as $key => $value):?>
                    <th scope="col"><?=$value["name"]?></th>
                <?php endforeach;?>
            </tr>
            </thead>
            <tbody>
            <?php foreach($values as $key => $valueRow):?>
                <tr>
                    <?php foreach($fields as $key => $value):?>
                        <td><?=$valueRow[$value["field"]]?></td>
                    <?php endforeach;?>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<!--end::Card-->

<style>
    .listagemGeral
    {
        padding: 0 0 0 25px;
    }
</style>