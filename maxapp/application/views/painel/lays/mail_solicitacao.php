<html>
   <body>
		Olá <?php echo $row['nome']; ?> (<?php echo $row['email']; ?>),<br />
       	Sua solicitação foi respondida em <?php echo show_data_site($row['data_resposta'], "%d de %B de %Y às %H:%M"); ?>.<br />
       	Para ver a resposta, acesse o nosso site!<br /><br />

       	Confira abaixo algumas facilidades para o acesso.<br />
       	<ul>
       		<li>[1] - Link direto. <a href="<?php echo site_url("solicitacoes/login"); ?>">Clique aqui para acessar</a></li>
       		<li>[2] - Copie e cole. Copie o endereço a seguir e cole nos seu navegador preferido. (<?php echo site_url("solicitacoes/login"); ?>)</li>
       	</ul>
       	<br />
		<br />
       	Esta é um mensagem automática. <b>Não é necessário responder</b>
       	<br /><br />

       	Direitos Reservados &copy;<?php echo date('Y'); ?><strong> <?php echo config('titulo_site'); ?></strong>
    </body>
</html>