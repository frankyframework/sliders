<?php
use Sliders\model\SlidersitemsModel;
use Sliders\entity\SlidersitemsEntity;
use Franky\Haxor\Tokenizer;
$Tokenizer = new Tokenizer();

if ($MyRequest->isAjax()) {
    $callback	= $MyRequest->getRequest('callback');
    $filters = $MyRequest->getRequest('filters');
    $id_slider = $Tokenizer->decode($MyRequest->getRequest('id_slider'));
    if(empty($id_slider)) {
        $dataRows = ["rows" => [], "total" =>0, "page" => 1,"records" => 0];
        header('Content-Type: application/json; charset=utf-8');
        echo $callback . '(' . json_encode($dataRows). ');';
        die;
    }
    $dataPost = json_decode(stripslashes($filters),true);
    $dataPost = $dataPost['rules'];
    $requestFranky = [];
    $request = [];
    foreach($dataPost as $data) {
            $request[$data['field']] = $MyRequest->Sanitizacion($data['data']);
    }        
    $sortInput  = (!empty($MyRequest->getRequest('sidx',"orden")) ? : "orden");
    
    $SlidersitemsModel = new SlidersitemsModel();
    $SlidersitemsEntity = new SlidersitemsEntity();
    $SlidersitemsEntity->id_slider($Tokenizer->decode($id_slider));
    $SlidersitemsModel->setPage($MyRequest->getRequest('page',1));
    $SlidersitemsModel->setTampag($MyRequest->getRequest('rows',100));
    $SlidersitemsModel->setOrdensql($sortInput." ".$MyRequest->getRequest('sord',"ASC"));

    if(getCoreConfig('sliders/slideritem/showdelete') == 0){
        $SlidersitemsEntity->status(1);
    }

    $result	 = $SlidersitemsModel->getData($SlidersitemsEntity->getArrayCopy());
    $dataRows = ["rows" => [], "total" => ceil($SlidersitemsModel->getTotal() / $MyRequest->getRequest('rows',100)), "page" => (int)$MyRequest->getRequest('page',1),"records" => $SlidersitemsModel->getTotal()];

    if($SlidersitemsModel->getTotal() > 0)
    {


        while($registro = $SlidersitemsModel->getRows())
        {
            $registro = array_filter($registro, function($llave) {
                return !is_numeric($llave);
            }, ARRAY_FILTER_USE_KEY);    
                
                if($registro['tipo'] == 'imagen')
                {
                    if(!empty($registro["file"]) && file_exists($MyConfigure->getServerUploadDir()."/sliders/".$registro['id_slider']."/".$registro["file"]))
                    {
                        $registro['preview'] = makeHTMLImg(imageResize($MyConfigure->getUploadDir()."/sliders/".$registro["id_slider"]."/".$registro["file"],50,50, true),50,50,"");

                    }
                }
                if($registro['tipo'] == 'video')
                {
                   if(!empty($registro["file"]) && file_exists($MyConfigure->getServerUploadDir()."/sliders/".$registro['id_slider']."/".$registro["file"]))
                    {
                        $registro['preview'] = '<video class="w_video" loop="loop" muted="muted" playsinline="playsinline" width="50">
                            <source src="'.$MyConfigure->getUploadDir()."/sliders/".$registro["id_slider"]."/".$registro["file"].'" />
                            </video>';

                    } 
                }
                if($registro['tipo'] == 'video-embebed')
                {
                    $registro['preview'] = "<div style='width:50px;height:50px;'>".$registro['code']."</div>";
                }
                $dataRows['rows'][] = array_merge($registro,array(
                "id" => $Tokenizer->token("item_sliders", $registro["id"]),
                "id_slider" => $Tokenizer->token("item_sliders", $registro["id_slider"]),
                "createdAt" 	=> getFechaUI($registro["createdAt"]),
                "status"  => ($registro["status"] == 1 ?"desactivar" : "activar"),
                ));
        }
    }

    header('Content-Type: application/json; charset=utf-8');
    echo $callback . '(' . json_encode($dataRows). ');';
    die;
} else {
    $MyMetatag->setJs("/public/plugins/jqGrid/js/jquery.jqGrid.js");
    $MyMetatag->setJs("/public/plugins/jqGrid/js/i18n/grid.locale-$lang_root.js");
    $MyMetatag->setCSS("/public/plugins/jqGrid/css/ui.jqgrid.css");
}
