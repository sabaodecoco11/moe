<div class="container">
  <div class="row">
    <div class="col-12">
      <h1>Hello, <?= session()->get('nomeUsuario') ?></h1>
    </div>
      <?php if(isset($algo)) : ?>
            <?= $algo ?>
      <?php endif; ?>
  </div>

  <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <h2>Empresas</h2>
        </div>
    </div>
    <?php if(isset($empresas)){ ?>
        <?php foreach($empresas as $empresa){ ?>
            <div class="row mt-2 justify-content-center">
                <div class="col-12 col-md-6 py-2" style="background: #f3f3f3; border: 1px #ccc solid; border-radius: 10px;">
                    <h3 class="font-bold"><?php echo $empresa->nome; ?></h3>

                    Endereco da empresa:
                    <p class="text-left"><?php echo $empresa->endereco; ?></p>

                    Descrição da empresa:
                    <p class="text-left"><?php echo $empresa->descricao; ?></p>

                    <?php if(session()->get('tipoConta') == 'ESTAGIARIO'){ ?>
                        <form action="/interesse-empresa" method="post">
                            <input type="hidden" name="empresa" value="<?php echo $empresa->id; ?>" />
                            <button type="submit" class="btn btn-success">Cadastrar interesse</button>
                        </form>
                    <?php } ?>

                </div>
            </div>
        <?php } ?>
    <?php } ?>

</div>
