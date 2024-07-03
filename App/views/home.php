<title><?php echo $title; ?></title>

<ul>
  <?php foreach ($users as $item) { ?>
    <li><?php echo $item['email_usuario']; ?></li>
    <li><?php echo $item['senha_usuario']; ?></li>
  <?php } ?>
</ul>