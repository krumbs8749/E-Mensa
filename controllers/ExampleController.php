<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');

class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd) {
        /*
           Wenn Sie hier landen:
           bearbeiten Sie diese Action,
           so dass Sie die Aufgabe löst
        */

        return view('notimplemented', [
            'request'=>$rd,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }
    public function m4_7a_queryparameter(RequestData $rd) {
        if($rd->query['name'] ?? false == "1" ) echo "hahah";
        return view('examples.m4_7a_queryparameter', [
            'data'=>$rd->query['name']?? "name",
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }
    public function m4_7b_kategorie(RequestData $rd) {

        $data = db_kategorie_select_name_ASC();

        return view('examples.m4_7b_kategorie', [
            'data'=>$data,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }

    public function m4_7c_gerichte(RequestData $rd) {

        $data = db_gericht_select_name_DSC_filter_preis_intern();

        return view('examples.m4_7c_gerichte', [
            'data'=>$data,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }
    public function m4_7d_layout(RequestData $rd) {
        $requestData = $rd->getData();
        if(!isset($requestData['no']))
            $requestData['no'] = '1';
        $viewname = $requestData['no'] == '1' ? 'examples.pages.m4_7d_page_1': 'examples.pages.m4_7d_page_2';
        $data = $requestData['no'] == '1' ? db_gericht_select_all() : db_kategorie_select_all();
        return view($viewname, [
            'request'=>$requestData,
            'titel' => $requestData['titel'] ?? 'Titel',
            'data' => $data,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }

    public function test(RequestData $rd){
        $no = ['no' => $rd->query['no'] ?? '1'];
        if(isset($rd->query['no'])){
            if($rd->query['no']  == '1'){
                return view('.examples.test1',  $no);
            }
            if($rd->query['no'] == '2' ){
                return view('.examples.test2',$no);
            }
        }

        return view('.examples.test1', $no);
    }

}