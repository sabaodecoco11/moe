<div class="container">
  <div class="row">
    <div class="col-12 col-sm8- offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3><?= session()->get('nomeUsuario')?></h3>
        <hr>
        <?php if (session()->get('success')): ?>
          <div class="alert alert-success" role="alert">
            <?= session()->get('success') ?>
          </div>
        <?php elseif (session()->get('error')): ?>
         <div class="alert alert-danger" role="alert">
             <?= session()->get('error') ?>
         </div>

        <?php endif; ?>
        <form class="" action="/profile" method="post">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">

               <label for="nome">Nome</label>
               <input type="text" class="form-control" name="nome" id="nome" value="<?= set_value('nome', isset($user) ? $user['nome'] : '') ?>">
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
               <label for="email">Endereço de e-mail</label>
               <input type="text" class="form-control" readonly id="email" value="<?= session()->get('email') ?>">
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
              <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
            </div>
          </div>
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
              <button type="submit" class="btn btn-primary">Atualizar dados</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
