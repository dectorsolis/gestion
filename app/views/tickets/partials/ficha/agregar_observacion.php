        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $data['title']?></h2>
                        <div class="clearfix"></div>                            
                    </div>

                    <div class="x_content">                            
                        <form class="op-form" method="POST" action="<?= $data['action'] ?>">
                            <p>
                                <textarea name="comentario" id="comentario" class="form-control" placeholder="Esribe algún comentario final"></textarea>
                                <input type="hidden" name="id_ticket" value="<?= $data['id_ticket'] ?>">
                            </p>
                            <p>
                                <button type="submit" class="btn btn-submit btn-primary">comentar</button>
                            </p>
                        </form>
                        <script>
                            /*
                            jq(document).ready(function() {
                                jq('#comentario').summernote({
                                    height: 150
                                });
                            });*/
                        </script>                          
                    </div>
                </div>
            </div>
        </div>     