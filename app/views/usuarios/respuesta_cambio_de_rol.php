<?php if( isset( $data['href']) ): ?>
	<script>window.location.href = "<?= $data['href'] ?>"; </script>
	<strong><?= $data['msg']?> </strong>
<?php endif; ?>
