
    <?php if( $data['observaciones'] ): ?>        
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
                        <?= $data['observaciones']; ?>
                    </div>

                </div> 

            </div>    
        </div>
    <?php endif; ?> 