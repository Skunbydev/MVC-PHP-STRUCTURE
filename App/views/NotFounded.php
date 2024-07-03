<?php

$tituloPagina = 'Não encontrado!';
ob_start();
?>


<div class="row align-items-center">
  <div class="col mx-auto text-center">
    <img class="img-fluid" src="../Mvc/App/includes/imgs/not-founded-image.png" alt="" width="550px">
  </div>




</div>







<?php
$conteudo = ob_get_clean();
include __DIR__ . '/../includes/bootstrap.php';
?>