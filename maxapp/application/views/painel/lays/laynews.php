<?php
	//$this->CI =& get_instance();
	//$nameform	=	"newsletter";
	pre("asdasdas", 1);
?>

<table align="center" width="620" cellpadding="5" style="border: 1px solid #e0e0e0; background: url(http://www.oab-rn.org.br/2012/arearestrita/sisNewsletter/bg.jpg) repeat;">
	<tr>
    	<td colspan="5">&nbsp;</td>
    </tr>
	<tr>
    	<td width="20px">&nbsp;</td>
    	<td width="270px"><img src="http://www.oab-rn.org.br/2012/arearestrita/sisNewsletter/news/logo.png" alt="Logo"/></td>
    	<td width="40px">&nbsp;</td>
    	<td width="270px" align="right" valign="top">
        	<div style="background: url(http://www.oab-rn.org.br/2012/arearestrita/sisNewsletter/news/data.jpg); width: 186px; height: 22px;margin-top: 32px; text-align:center; color: #FFF; padding-top: 4px;">Informativo n&deg; <?=$cls->numero;?>/2013</div>
        </td>
    	<td width="20px">&nbsp;</td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
        <td colspan="3">
        	<p align="center" style=" margin: 20px 0;"><a href="<?=$cls->linkImagem;?>" style="color: #FFF; text-decoration: none" target="_blank"><img src="../../_upimgs/newsletter/<?=$cls->arquivoImagem;?>" width="100%" /></a></p>
            <div style="position:absolute; background: #d20600; color: #fff; margin-top: -95px; margin-left: 25px; width: 500px; padding: 10px;">
            	<p style="margin:0"><?=stripslashes($cls->tnews);?></p>
            </div>
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
        <td style="padding-bottom: 25px; background: url(http://www.oab-rn.org.br/2012/arearestrita/sisNewsletter/news/bg-noticia.jpg) no-repeat">
        	<div style="padding: 24px 10px 0 10px;height: 96px; width:250px; overflow:hidden">
        		<span style="color: #023b5f">[<?=date("d/m/Y", strtotime($cls->data));?>]</span>
            	<p style="margin:0"><a href="<?=$cls->url;?>" style="color: #FFF; text-decoration: none" target="_blank"><?=stripslashes($cls->titulo);?></a></p>
        	</div>
        </td>
        <td>&nbsp;</td>
        <td style="padding-bottom: 25px; background: url(http://www.oab-rn.org.br/2012/arearestrita/sisNewsletter/news/bg-noticia.jpg) no-repeat">
        	<div style="padding: 24px 10px 0 10px;height: 96px; width:250px; overflow:hidden">
        		<span style="color: #023b5f">[<?=date("d/m/Y", strtotime($cls->data2));?>]</span>
            	<p style="margin:0"><a href="<?=$cls->url2;?>" style="color: #FFF; text-decoration: none" target="_blank"><?=stripslashes($cls->titulo2);?></a></p>
        	</div>
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="5">&nbsp;</td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
        <td style="padding-bottom: 25px; background: url(http://www.oab-rn.org.br/2012/arearestrita/sisNewsletter/news/bg-noticia.jpg) no-repeat">
        	<div style="padding: 24px 10px 0 10px;height: 96px; width:250px; overflow:hidden">
        		<span style="color: #023b5f">[<?=date("d/m/Y", strtotime($cls->data3));?>]</span>
            	<p style="margin:0"><a href="<?=$cls->url3;?>" style="color: #FFF; text-decoration: none" target="_blank"><?=stripslashes($cls->titulo3);?></a></p>
        	</div>
        </td>
        <td>&nbsp;</td>
        <td style="padding-bottom: 25px; background: url(http://www.oab-rn.org.br/2012/arearestrita/sisNewsletter/news/bg-noticia.jpg) no-repeat">
        	<div style="padding: 24px 10px 0 10px;height: 96px; width:250px; overflow:hidden">
        		<span style="color: #023b5f">[<?=date("d/m/Y", strtotime($cls->data4));?>]</span>
            	<p style="margin:0"><a href="<?=$cls->url4;?>" style="color: #FFF; text-decoration: none" target="_blank"><?=stripslashes($cls->titulo4);?></a></p>
        	</div>
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="5">&nbsp;</td>
    </tr>
    <? } ?>
    <tr bgcolor="#eaeaea">
    	<td>&nbsp;</td>
    	<td>
        	<p align="center"><a href="www.oab-rn.org.br" target="_blank" style="color: #085c8a; text-decoration:none; font-size: 26px;">www.oab-rn.org.br</a></p>
        </td>
    	<td>&nbsp;</td>
    	<td style="color:#085c8a;">
        	<p style="border-left: 1px solid #588eac; margin-bottom: 9px; padding-left:10px; font-size:14px">
            OAB RN - Av. C&acirc;mara Cascudo, 478
			<br  />Cidade Alta - CEP: 59025-280
			<br  />Telefone (84) 4008-9400
            </p>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>