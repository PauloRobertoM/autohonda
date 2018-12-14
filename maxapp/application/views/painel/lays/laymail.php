<html>
   <body>
        Nome: <?php echo $row->nome; ?> <br />
        E-mail: <?php echo $row->email; ?> <br />
        Login: <?php echo $row->username; ?> <br />
        Senha temporária: <?php echo $password; ?> <br />
        Nº de acesso: <?php echo $row->hits; ?> <br />
        Olá <?php echo $row->nome; ?>! <br />
        Direitos Reservados &copy;<?php echo date('Y'); ?><strong> <?php echo $title; ?></strong>
    </body>
</html>