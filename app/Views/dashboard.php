<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Hello, <?= session()->get('nomeUsuario') ?></h1>
        </div>
        <?php if (isset($algo)) : ?>
            <?= $algo ?>
        <?php endif; ?>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <h2>Empresas</h2>
        </div>
    </div>
    <?php if (isset($empresas)) { ?>
        <?php foreach ($empresas as $empresa) { ?>
            <div class="row mt-2 justify-content-center">
                <div class="col-12 col-md-6 py-2"
                     style="background: #f3f3f3; border: 1px #ccc solid; border-radius: 10px;">
                    <h3 class="font-bold"><?php echo $empresa->nome; ?></h3>

                    Endereco da empresa:
                    <p class="text-left"><?php echo $empresa->endereco; ?></p>

                    Descrição da empresa:
                    <p class="text-left"><?php echo $empresa->descricao; ?></p>

                    <?php if (session()->get('tipoConta') == 'ESTAGIARIO') { ?>
                        <form action="/interesse-empresa" method="post">
                            <input type="hidden" name="empresa" value="<?php echo $empresa->id; ?>"/>
                            <button type="submit" class="btn btn-success">Cadastrar interesse</button>
                        </form>
                    <?php } ?>

                    <?php if (session()->get('tipoConta') == 'EMPREGADOR') { ?>
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header" style="padding:35px 50px;">
                                        <h3>Estagiários inscritos na empresa <?= $empresa->nome ?></h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- mostra os interessados -->
                                    <div class="modal-body" style="padding:40px 50px;">
                                        <?php
                                        if (isset($interessados_vagas)) {
                                            foreach ($interessados_vagas as $interessado) {

                                                if ($interessado->empresa_id == $empresa->id)
                                                    echo "<p>$interessado->nome</p>";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>

                            </div>
                        </div>

                        <button type="submit" id="btn-verificar" class="btn btn-primary">
                            Verificar estagiários inscritos
                        </button>
                    <?php } ?>

                </div>
            </div>


        <?php } ?>
    <?php } ?>
    <script type="application/javascript">
        $(window).ready(function () {
            $('#btn-verificar').click(function () {
                $('#myModal').modal('show');
            });
        });
    </script>
</div>
