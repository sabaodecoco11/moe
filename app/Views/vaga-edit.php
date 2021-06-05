<div class="container">


    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <h2>Edição de vaga</h2>
            <hr>

            <form method="post">
                <!-- Descrição larga-->
                <div class="col-sm">
                    <div class="form-group">
                        <label for="email">Descrição da vaga</label>
                        <input type="text" class="form-control" maxlength="999" style="" name="descricao" id="descricao"
                               value="<?= isset($vaga) ? $vaga['descricao'] : "" ?>"
                        >
                    </div>
                </div>

                <div class="col-sm">
                    <div class="form-group">
                        <label for="atividades">Lista de atividades</label>
                        <textarea class="form-control" id="atividades" name="atividades">
                            <?= isset($vaga) ? ''.$vaga['atividades'] : "" ?>
                        </textarea>
                    </div>
                </div>

                <div class="col-sm">
                    <div class="form-group">
                        <label for="habilidades">Lista de habilidades</label>
                        <textarea class="form-control" id="habilidades" name="habilidades">
                            <?= isset($vaga) ? ''.$vaga['habilidades'] : "" ?>
                        </textarea>
                    </div>
                </div>

                <div  class="col-12 col-sm-6">
                    Carga horária
                    <br>
                    <select aria-label="aff" class="form-select"  name="cargaHoraria" id="contaSelector">
                        <option value="20" name="cargaHoraria">20 horas</option>
                        <option value="30" name="cargaHoraria">30 horas</option>
                    </select>
                </div>

                <div class="row" style="padding-top: 8px">
                    <div class="col-sm">
                        <div class="col-sm">
                            <div class="form=group">
                                <label for="semestre">Semestre</label>
                                <input type="text" class="form-control"
                                       name="semestre"
                                       id="semestre"
                                       value=<?= isset($vaga) ? $vaga['semestre'] : "" ?>
                                >
                            </div>
                        </div>

                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="remuneracao">Remuneração</label>
                                <input type="number" class="form-control"
                                       name="remuneracao"
                                       id="remuneracao"
                                       value=<?= isset($vaga) ? $vaga['remuneracao'] : "" ?>
                                >
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <button type="submit" class="btn btn-primary">Editar vaga</button>
                </div>



                <script type="application/javascript">
                    $(document).ready(function () {
                        $('#atividades').focusout(function () {
                            var text = $('#text').val();
                            text = text.replace(/(?:(?:\r\n|\r|\n)\s*){2}/gm, "");
                            $(this).val(text);
                        });
                    });
                </script>


            </form>
        </div>
    </div>
</div>