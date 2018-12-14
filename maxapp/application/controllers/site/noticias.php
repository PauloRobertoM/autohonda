<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends MY_Controller
{
    protected $_namemodel   =   'noticias';

    public function __construct()
    {
        parent::__construct();
    }


    public function index($pagina = NULL)
    {
        
        $data['album']          =   TRUE;

        // Definindo titulo da pagina
        $data['titulo']     =   "Notícias";
		
		###################     LISTA DOS EVENTOS 		#########################	
		$sql7['where']      =	array("status"  =>  1, "excluido"   =>  0);
		$sql7['order']      =	array("field" => "data", "hang" => "DESC");
		$sql7['limit']	    =   4;

		$data['eventos']   =   $this->get_data('eventos', $pagina, $sql7);
		
		###################     LISTA DOS VÍDEOS 		#########################	
		$sql3['where']      =	array("status"  =>  1, "excluido"   =>  0, "programa" => 1);
		$sql3['order']      =	array("field" => "data", "hang" => "DESC");
		$sql3['limit']	   	=   	3;

		$data['videos1']   =   $this->get_data('videos', $pagina, $sql3);

		###################     LISTA NA MÍDIA 		#########################	
		$sql6['where']      =	array("status"  =>  1, "excluido"   =>  0, "programa" => 2);
		$sql6['order']      =	array("field" => "data", "hang" => "DESC");
		$sql6['limit']	   	=   	3;

		$data['videos2']   =   $this->get_data('videos', $pagina, $sql6);

		################### LISTA DOS ALBUNS ########################
		$sql5['where']		=	array('status'	=>	1, "excluido" => 0);
		$sql5['order']		=	array("field" => "data", "hang" => "DESC");
		$sql5['limit']		=	3;
		$sql5['files']		=	'albuns';
		// core/MY_Controller.php
		$data['albuns']		=	$this->get_data('albuns', $pagina, $sql5);
		

        ###################     LISTA DAS NOTÍCIAS 		#########################	
		$sql4['where']      =   array("status"  =>  1, "excluido"   =>  0, "data_pub <=" => (date("Y-m-d H:i:s")));
        $sql4['order']      =   array("field" => "data_pub", "hang" => "DESC");
		
		$data['listagem']   =   $this->get_data($this->_namemodel, $pagina, $sql4);
        $data['pagination'] =   $this->pagination($this->_namemodel, $sql4, $pagina, NULL);
        $data['modulo']     =   $this->_namemodel;
        
        $this->load->view('site/listagem', $data);
    }

    public function item($id = NULL, $titulo = NULL)
    {
        
        
        if(!is_null($id))
        {
			###################     LISTA DOS EVENTOS 		#########################	
			$sql7['where']      =	array("status"  =>  1, "excluido"   =>  0);
			$sql7['order']      =	array("field" => "data", "hang" => "DESC");
			$sql7['limit']	    =   4;

			$data['eventos']   =   $this->get_data('eventos', $pagina, $sql7);
			
			###################     LISTA DOS VÍDEOS 		#########################	
			$sql3['where']      =	array("status"  =>  1, "excluido"   =>  0, "programa" => 1);
			$sql3['order']      =	array("field" => "data", "hang" => "DESC");
			$sql3['limit']	   	=   	3;

			$data['videos1']   =   $this->get_data('videos', $pagina, $sql3);

			###################     LISTA NA MÍDIA 		#########################	
			$sql6['where']      =	array("status"  =>  1, "excluido"   =>  0, "programa" => 2);
			$sql6['order']      =	array("field" => "data", "hang" => "DESC");
			$sql6['limit']	   	=   	3;

			$data['videos2']   =   $this->get_data('videos', $pagina, $sql6);

			################### LISTA DOS ALBUNS ########################
			$sql5['where']		=	array('status'	=>	1, "excluido" => 0);
			$sql5['order']		=	array("field" => "data", "hang" => "DESC");
			$sql5['limit']		=	3;
			$sql5['files']		=	'albuns';
			// core/MY_Controller.php
			$data['albuns']		=	$this->get_data('albuns', $pagina, $sql5);
			
			###################     LISTA DAS NOTÍCIAS 		#########################	
			$sql4['where']      =   array("status"  =>  1, "excluido"   =>  0, "data_pub <=" => (date("Y-m-d H:i:s")));
			$sql4['order']      =   array("field" => "data_pub", "hang" => "DESC");
			$sql4['limit']		=	3;

			$data['ultimas']   =   $this->get_data($this->_namemodel, $pagina, $sql4);
			
            // Definindo titulo da pagina
            $data['titulo']         =   "Notícias";
            $data['id']             =   TRUE;

            // application/models/model_*.php
            $model                  =   load_model('generico', $this->_namemodel);

            $sql['where']           =   array('status'  =>  1, 'id' => $id);

            // core/MY_Controller.php
            $data['res']            =   $this->get_data($this->_namemodel, NULL, $sql);
            $data['modulo']         =   $this->_namemodel;

            $this->load->view('site/interna', $data);
        }
        else
        {
            show_404("Página não encontrada");
        }
    }
	
	public function busca($pagina = NULL, $busca = NULL)
	{
		if(is_null($pagina) && post("busca") == "")
		{
			redirect(site_url("noticias"));
		}
		
		$data['titulo_principal']		=	"De Fato.com - Notícias";
		$data['titulo']         =   "noticias";
		###################     BANNERS     #########################
		$sql2['where']      =   array("status"  =>  1, "excluido"   =>  0,  "tipo"  =>  4);
		$sql2['order']      =   array("field" => "data", "hang" => "DESC");
		$sql2['limit']      =   1;

		$data['banner'] =   $this->get_data('banners', $pagina, $sql2);
		
		###################     EDIÇÕES     #########################
		$sql3['where']      =   array("status"  =>  1, "excluido"   =>  0);
		$sql3['order']      =   array("field" => "data", "hang" => "DESC");
		$sql3['limit']      =   1;

		$data['edicao'] =   $this->get_data('edicao', $pagina, $sql3);

		$buscando				=	(post("busca")) ? post("busca") : $busca ;
		$data['modulo']			=	$this->_namemodel;

		###################     LISTA DAS NOTÍCIAS - GERAIS     #########################
		$sql4['where']      =   array("status"  =>  1, "excluido"   =>  0, "data_pub <=" => (date("Y-m-d H:i:s")));
		$sql4['order']      =   array("field" => "data_pub", "hang" => "DESC");
		$sql4['limit']      =   4;

		$data['noticias']   =   $this->get_data($this->_namemodel, $pagina, $sql4);


		################### LISTAGEM ########################
		$sql1['where']			=	array(
				'status'		=>	1,
		);
		$sql1['like']			=	array(
			array(
				'field'		=>	'titulo',
				'search'	=>	$buscando,
				'match'		=>	'both'
			)
		);
		//die();

		// core/MY_Controller.php
		$data['listagem']		=	$this->get_data($this->_namemodel, $pagina, $sql1);
		$data['paginacao']		=	$this->pagination($this->_namemodel, $sql1, $pagina, $buscando, 'busca');

		$this->load->view('site/listagem', $data);
	}

}

/* End of file albuns.php */
/* Location: ./application/controllers/site/albuns.php */