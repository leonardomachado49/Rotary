<br>
<br>
<br>
<div class="row container">
  <div class="col s12 center">
    <div class="card-panel">
      <h4 class="collorTextBtnMenu"><strong>Alterar Categoria</strong></h4>
      <a href="<?php echo base_url();?>" class="collorTextBtnMenu left btn-flat  colorMenu waves-effect waves-yellow"><strong>Voltar</strong></a>
      <br>
      <br>
      <div class="row">
        <?php foreach ($dados as $dado) {?>
        <div class="col s12 center">
            <img src="<?php echo base_url('imgs')."/".$dado['category_icon_path']; ?>" class="responsive-img" style="width: 150px;">
        </div>
        <form class="col s12" action="<?php echo base_url('alterar-categoria').'/'.$dado['category_id']; ?>" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="Nome" id="name" type="text" class="validate" name="name" required value="<?php echo $dado['category_name']; ?> ">
              <label for="name">Nome</label>
            </div>
            <div class="input-field col s12">
              <input id="desc" type="text" class="validate" name="desc" required="" value="<?php echo $dado['category_description']; ?> ">
              <label for="desc">Descrição</label>
            </div>
            <div class="input-field col s12">
            <input id="file" type="file" class="validate" name="userfile" size="1000000"  style="margin-top: 15px;">
              <label for="file">Alterar Icon da Categoria</label>
            </div>
            <input type="hidden" value="<?php echo $dado['category_icon_path'];?>" name="image" required></input>
          </div>
          <b><input type="submit" class=" right btn-flat  colorMenu  waves-yellow"></input></b>
        </form>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

