
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $data['title']?></h2>
                        <div class="clearfix"></div>                            
                    </div>

                    <div class="x_content">
                        <p>Delega el ticket al departamento correcto</p>
                        <form  class="op-form action-form" method="POST"  action="<?= PATH . 'tickets/ficha/' . $data['id_ticket'] ; ?>" data-submit-form = "¿Estás seguro?" >
                            <select name="empleado" id="empleado" class="form-control">
                                <option disabled selected>Elige un miembro del equipo</option>
                                <?php foreach( $data['integrantes_proyecto'] as $item): ?>
                                    <optgroup label="<?= $item['departamento'] ?>">
                                        <option value="<?= $item['id_empleado']; ?>"> 
                                            <?= $item['nombre']; ?> 
                                        </option>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="type" value="delegar">
                            <br>
                            <button type="submit" class="btn btn-success">Delegar</button>  
                        </form>
                    </div>
                </div>            
            </div>
        </div>