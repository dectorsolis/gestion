        <div class="row">

            <div class="col-md-12 col-xs-12">

                <div class="x_panel">
                    <div class="x_title">
                         <h2><?= $data['title']?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>                          
                        <div class="clearfix"></div>                            
                    </div>

                    <div class="x_content">
                        <?php if( $data['evidencia']  ): ?>
                        <?php $imagenes = unserialize( base64_decode( $data['evidencia'] ) ); ?>
                            <?php foreach( $imagenes as $img): ?>
								<a href="/gestion/app/uploads/evidencia/<?= $img ?>" target="_blank">
									<img width="200" class="img-thumbnail" src="/gestion/app/uploads/evidencia/<?= $img ?>" alt="<?= $img ?>"/>
								</a>
                           <?php endforeach; ?>
                        <?php endif; ?>                         
                    </div>

                </div> 

            </div>               
        </div>