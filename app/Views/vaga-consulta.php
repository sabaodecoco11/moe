<div class="container pt-3">

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <h2>Vagas</h2>
        </div>
    </div>
    <?php if(isset($vagas)){ ?>
        <?php foreach($vagas as $vaga){ ?>
            <div class="row mt-2 justify-content-center">
                <div class="col-12 col-md-6 py-2" style="background: #f3f3f3; border: 1px #ccc solid; border-radius: 10px;">
                    <h3 class="font-bold"><?php echo $vaga->descricao; ?></h3>

                    Atividades:
                    <p class="text-left"><?php echo $vaga->atividades; ?></p>
                    Habilidades:
                    <p class="text-left"><?php echo $vaga->habilidades; ?></p>

                    <?php if(session()->get('tipoConta') == 'EMPREGADOR') : ?>
                        <div class="btn-toolbar">
                            <form action="<?="/editar-vaga/".$vaga->id ?>" method="get">
                                <button type="submit" class="btn btn-primary mr-1">
                                    Editar oportunidade
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>




                </div>
            </div>
        <?php } ?>
    <?php } ?>

   


</div>

