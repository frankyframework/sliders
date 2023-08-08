<?php
use Base\Form\filtrosForm;
use Sliders\model\SlidersModel;
use Sliders\entity\SlidersEntity;
use Franky\Core\paginacion;
use Franky\Haxor\Tokenizer;

$MyPaginacion = new paginacion();
$Tokenizer = new Tokenizer();


$MyPaginacion->setPage($MyRequest->getRequest('page',1));
$MyPaginacion->setCampoOrden($MyRequest->getRequest('por',"createdAt"));
$MyPaginacion->setOrden($MyRequest->getRequest('order',"ASC"));
$MyPaginacion->setTampageDefault($MyRequest->getRequest('tampag',25));		
$busca_b	= $MyRequest->getRequest('busca_b');	


$SlidersModel = new SlidersModel();
$SlidersEntity = new SlidersEntity();

$SlidersModel->setPage($MyPaginacion->getPage());
$SlidersModel->setTampag($MyPaginacion->getTampageDefault());
$SlidersModel->setOrdensql($MyPaginacion->getCampoOrden()." ".$MyPaginacion->getOrden());

if(getCoreConfig('sliders/slider/showdelete') == 0){
        $SlidersEntity->status(1);
}
$result	 = $SlidersModel->getData($SlidersEntity->getArrayCopy());
$MyPaginacion->setTotal($SlidersModel->getTotal());

$lista_admin_data = array();
if($SlidersModel->getTotal() > 0)
{
	$iRow = 0;	

	while($registro = $SlidersModel->getRows())
	{
		$thisClass  = ((($iRow % 2) == 0) ? "formFieldDk" : "formFieldLt");
                

		$lista_admin_data[] = array_merge($registro,array(
                "id" => $Tokenizer->token("sliders", $registro["id"]),
                "callback" => $Tokenizer->token("sliders", $MyRequest->getURI()),    
                "createdAt" 	=> getFechaUI($registro["createdAt"]),
                "thisClass"     => $thisClass,
                "nuevo_estado"  => ($registro["status"] == 1 ?"desactivar" : "activar"),
                ));
                $iRow++;
        }
}



//$MyFrankyMonster->setPHPFile(getVista("admin/template/grid.phtml"));
$title_grid = _sliders("Sliders");
$class_grid = "cont_sliders";
$error_grid = _sliders("No hay sliders registrados");
$deleteFunction = "DeleteSliders";
$frm_constante_link = FRM_SLIDERS;
$titulo_columnas_grid = array("createdAt" => _sliders("Fecha"),"name" => _sliders("Nombre"),"code" => _sliders("Code"));
$value_columnas_grid = array("createdAt", "name","code" );

$css_columnas_grid = array("createdAt" => "w-xxxx-3" ,"name" => "w-xxxx-3" ,"code" => "w-xxxx-3" );

$permisos_grid = "administrar_sliders";
$MyFiltrosForm = new filtrosForm('paginar');
$MyFiltrosForm->setMobile($Mobile_detect->isMobile());
?>