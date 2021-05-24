<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Export Data <?php echo @$judul; ?></h3>

  <form method="POST" action="<?php echo base_url('Kedeputian5/export'); ?>" enctype="multipart/form-data">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="fa fa-calendar fa-fw"></i>
      </span>
      <input type="month" class="form-control"  id="vtanggal" name="vtanggal" aria-describedby="sizing-addon2">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-floppy-save"></i> Export Data</button>
      </div>
    </div>
  </form>
</div>
