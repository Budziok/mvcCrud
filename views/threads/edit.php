<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edycja</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="<?php echo ROOT_URL; ?>threads/change/<?=$model['id'];?>">
    	<div class="form-group">
    		<label>Tytuł</label>
    		<input type="text" value="<?=$model['title'];?>" name="title" class="form-control" />
    	</div>
    	<div class="form-group">
    		<label>Treść</label>
    		<textarea name="content" class="form-control" rows="6"><?=$model['content'];?></textarea>
    	</div>
    	<input class="btn btn-primary" name="submit" type="submit" value="Zmień" />
        <a class="btn btn-danger" href="<?php echo ROOT_URL; ?>threads">Anuluj</a>
    </form>
  </div>
</div>