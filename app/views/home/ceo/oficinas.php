    
    <?php if( isset($data["oficinas"]) ): ?>
    <div class="x_panel">
      <div class="x_title">
        <h2> <?= $data['title'] ?></h2>
        <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li>
              </ul> 
        <div class="clearfix"></div>              
      </div>
      <div class="x_content">
        <div class="row">

          <?php foreach( $data["oficinas"] as $i => $item ): ?>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-group"></i></div>
                <span class="count"> <?= $item["total"] ?> </span><span>Integrantes</span>
                <h3><a href="<?= PATH . 'empleados/equipos/' . $item['id_region'] ?>"><?= $item["nombre"] ?></a></h3>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>