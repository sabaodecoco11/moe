
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3>Cadastro de usuário</h3>
                <hr>
                <form class="" action="/register" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Endereço de e-mail</label>
                                <input type="text" class="form-control" name="email" id="email"
                                       value="<?= set_value('email') ?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control" name="password" id="password" value="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="password_confirm">Confirme a senha</label>
                                <input type="password" class="form-control" name="password_confirm"
                                       id="password_confirm" value="">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <select class="form-select" aria-label="Tipo de conta" name="tipoConta" id="contaSelector">
                                <option value=""></option>
                                <option value="ESTAGIARIO">Estagiário</option>
                                <option value="EMPREGADOR">Empregador</option>
                            </select>
                        </div>

                        <div class="form-group col-12 " id="emp1">
                            <label for="nome_contato">Nome do empregador</label>
                            <input type="text" class="form-control" name="nome_contato" id="nome_contato"
                                   value="">
                        </div>

                        <div class="form-group col-12 col-sm-6" id="emp2">
                            <label for="nome_empresa">Nome da empresa</label>
                            <input type="text" class="form-control" name="nome_empresa" id="nome_empresa"
                                   value="">
                        </div>

                        <div class="form-group" class="col-12 col-sm-6" id="emp3">
                            <label for="endereco_empresa">Endereço da empresa</label>
                            <input type="text" class="form-control" name="endereco_empresa" id="endereco_empresa"
                                   value="">
                        </div>

                        <div class="form-group col-12 col-sm-12" id="emp4">
                            <label for="descricao_empresa">Descricao da empresa</label>
                            <input type="text" class="form-control" name="descricao_empresa" id="descricao_empresa"
                                   value="">
                        </div>

                        <div class="form-group col-12 col-sm-12" id="emp5">
                            <label for="descricao_empresa">Descricao produtos</label>
                            <textarea class="form-control" name="descricao_produtos" id="descricao_produtos">
                            </textarea>
                        </div>

                        <div class="form-group col-12 " id="estag1">
                            <label for="nome_estagiario">Nome do estagiário</label>
                            <input type="text" class="form-control" name="nome_estagiario" id="nome_estagiario"
                                   value="">
                        </div>

                        <div class="form-group col-12 col-sm-6" id="estag0">
                            <select class="form-select" aria-label="Curso" name="cursoNome" id="cursoSelector">
                                <option value="">Selecione um curso</option>
                                <?php
                                    if(isset($cursos))
                                        foreach ($cursos as $curso) {
                                            $cursoId = $curso['id'];
                                            $cursoNome = $curso['nome'];

                                            echo "<option value='$cursoId'>$cursoNome</option>";
                                        }
                                ?>
                            </select>
                        </div>

<!--                        <div class="form-group col-12 col-sm-6" id="estag2">-->
<!--                            <label for="curso">Curso</label>-->
<!--                            <input type="text" class="form-control" name="curso" id="curso"-->
<!--                                   value="">-->
<!--                        </div>-->

                        <div class="form-group" class="col-12 col-sm-6" id="estag3">
                            <label for="ano_ingresso">Ano de ingresso</label>
                            <input type="text" class="form-control" name="ano_ingresso" id="ano_ingresso"
                                   value="">
                        </div>

                        <div class="form-group col-12 col-sm-12" id="estag4">
                            <label for="minicurriculo">Minicurrículo</label>
                            <textarea class="form-control" name="minicurriculo" id="minicurriculo">

                            </textarea>

                        </div>

                        <div id="blank">

                        </div>





                        <script type="application/javascript">
                            $(document).ready(function() {
                                $.viewMap = {
                                    'EMPREGADOR' : $('#emp1, #emp2, #emp3, #emp4, #emp5'),
                                    'ESTAGIARIO' : $('#estag1, #estag2, #estag3, #estag4, #estag0'),
                                };

                                // A $( document ).ready() block.
                                $( document ).ready(function() {
                                    $.each($.viewMap, function() { this.hide(); });

                                    // $.viewMap[$('#contaSelector').val()].show();
                                });

                                $('#contaSelector').change(function() {
                                    // hide all
                                    $.each($.viewMap, function() { this.hide(); });
                                    // show current
                                    $.viewMap[$(this).val()].show();
                                });
                            });
                        </script>


                        <?php if (isset($validation)): ?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors() ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-primary">Criar conta</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a href="/">Já tem uma conta? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


