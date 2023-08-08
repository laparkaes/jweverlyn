<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div><?= $msg ?></div>
<div>-----------------------------</div>
<?php if ($account){ ?>
<div>Usuario: <?= $account["username"] ?></div>
<div>Contraseña: <?= $account["password"] ?></div>
<div>Nombre: <?= $account["name"] ?></div>
<div>-----------------------------</div>
<?php } ?>
<div><a href='<?= base_url() ?>'>Ingrsar a intranet</a></div>