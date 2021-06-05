<div class="container pt-3">

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <h2>Vagas</h2>
        </div>
    </div>
    <?php if(isset($vagas)){ ?>
        <?php foreach($vagas as $row){ ?>
            <div class="row mt-2 justify-content-center">
                <div class="col-12 col-md-6 py-2" style="background: #f3f3f3; border: 1px #ccc solid; border-radius: 10px;">
                    <h3 class="font-bold"><?php echo $row->descricao; ?></h3>

                    Atividades:
                    <p class="text-left"><?php echo $row->atividades; ?></p>
                    Habilidades:
                    <p class="text-left"><?php echo $row->habilidades; ?></p>

                </div>
            </div>
        <?php } ?>
    <?php } ?>

   


</div>

