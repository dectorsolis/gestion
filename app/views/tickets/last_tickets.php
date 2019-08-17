<?php if( $data ): ?>
    <?php foreach( $data as $item ):?>
        <li>
            <a href="<?= PATH . 'tickets/ficha/' . $item['id_ticket'] ?>">
                <span class="image"><img src="<?= gravatar( $item['email_empresa'] , 40); ?>" alt="Profile Image"></span>            
                <span>
                    <span><?= $item['emisor'] ?></span>
                    <span> [ #<?= $item['id_ticket'] ?> ] </span>
                    <span class="time"><?= $item['fecha_creacion']?></span>
                </span>
                <span class="message">
                    <?= $item['asunto'] ?>
                </span>
                <span>
                    <strong><?=  $item['cliente'] ?></strong>
                </span>                    
            </a>
        </li>
    <?php endforeach;?>
<?php else: ?>
    <li><strong>No hay tickets recientes</strong></li>
<?php endif; ?>