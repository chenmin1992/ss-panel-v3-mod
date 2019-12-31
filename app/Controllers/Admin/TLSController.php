<?php

namespace App\Controllers\Admin;

use App\Models\Cert;
use App\Utils\Radius;
use App\Utils\Telegram;
use App\Utils\Tools;
use App\Controllers\AdminController;

use Ozdemir\Datatables\Datatables;
use App\Utils\DatatablesHelper;

class TLSController extends AdminController
{
    public function index($request, $response, $args)
    {
        $table_config['total_column'] = Array("op" => "操作", "id" => "ID", "name" => "名称");
        $table_config['default_show_column'] = Array("op", "id", "name");
        $table_config['ajax_url'] = 'cert/ajax';

        return $this->view()->assign('table_config', $table_config)->display('admin/cert/index.tpl');
    }

    public function create($request, $response, $args)
    {
        return $this->view()->display('admin/cert/create.tpl');
    }

    public function add($request, $response, $args)
    {
        $cert = new Cert();
        $cert->name = $request->getParam('name');
        $cert->cert = $request->getParam('cert');
        $cert->key = $request->getParam('key');

        $cert_attr = false;
        try {
            if(strlen($cert->cert) <= 1000) {
                $cert_attr = openssl_x509_parse(file_get_contents($cert->cert));
            }
            if($cert_attr) {
                $key = file_get_contents($cert->key);
                if(!$key) {
                    $rs['ret'] = 0;
                    $rs['msg'] = "私钥无法获取";
                    return $response->getBody()->write(json_encode($rs));
                }
                $cert->type = 1;
            } else {
                $cert_attr = openssl_x509_parse($cert->cert);
                $cert->type = 0;
            }
            if(!$cert_attr) {
                $rs['ret'] = 0;
                $rs['msg'] = "证书无法解析";
                return $response->getBody()->write(json_encode($rs));
            }
        } catch (Exception $e) {
            $rs['ret'] = 0;
            $rs['msg'] = "获取证书失败";
            return $response->getBody()->write(json_encode($rs));
        }
        if(empty($cert->name)) {
            $cert->name = $cert_attr['subject']['CN'];
        }

        if (!$cert->save()) {
            $rs['ret'] = 0;
            $rs['msg'] = "添加失败";
            return $response->getBody()->write(json_encode($rs));
        }

        $rs['ret'] = 1;
        $rs['msg'] = "证书添加成功";
        return $response->getBody()->write(json_encode($rs));
    }

    public function edit($request, $response, $args)
    {
        $id = $args['id'];
        $cert = Cert::find($id);
        return $this->view()->assign('cert', $cert)->display('admin/cert/edit.tpl');
    }

    public function update($request, $response, $args)
    {
        $id = $args['id'];
        $cert = Cert::find($id);
        $cert->name = $request->getParam('name');
        $cert->cert = $request->getParam('cert');
        $cert->key = $request->getParam('key');

        $cert_attr = false;
        try {
            if(strlen($cert->cert) <= 1000) {
                $cert_attr = openssl_x509_parse(file_get_contents($cert->cert));
            }
            if($cert_attr) {
                $key = file_get_contents($cert->key);
                if(!$key) {
                    $rs['ret'] = 0;
                    $rs['msg'] = "私钥无法获取";
                    return $response->getBody()->write(json_encode($rs));
                }
                $cert->type = 1;
            } else {
                $cert_attr = openssl_x509_parse($cert->cert);
                $cert->type = 0;
            }
            if(!$cert_attr) {
                $rs['ret'] = 0;
                $rs['msg'] = "证书无法解析";
                return $response->getBody()->write(json_encode($rs));
            }
        } catch (Exception $e) {
            $rs['ret'] = 0;
            $rs['msg'] = "获取证书失败";
            return $response->getBody()->write(json_encode($rs));
        }
        if(empty($cert->name)) {
            $cert->name = $cert_attr['subject']['CN'];
        }

        if (!$cert->save()) {
            $rs['ret'] = 0;
            $rs['msg'] = "修改失败";
            return $response->getBody()->write(json_encode($rs));
        }

        $rs['ret'] = 1;
        $rs['msg'] = "修改成功";
        return $response->getBody()->write(json_encode($rs));
    }


    public function delete($request, $response, $args)
    {
        $id = $request->getParam('id');
        $cert = Cert::find($id);

        if (!$cert->delete()) {
            $rs['ret'] = 0;
            $rs['msg'] = "删除失败";
            return $response->getBody()->write(json_encode($rs));
        }

        $rs['ret'] = 1;
        $rs['msg'] = "删除成功";
        return $response->getBody()->write(json_encode($rs));
    }

    public function ajax($request, $response, $args)
    {
        $datatables = new Datatables(new DatatablesHelper());


        $total_column = Array("op" => "操作", "id" => "ID", "name" => "证书名称");
        $key_str = '';
        foreach($total_column as $single_key => $single_value) {
            if($single_key == 'op') {
                $key_str .= 'id as op';
                continue;
            }

            $key_str .= ','.$single_key;
        }
        $datatables->query('Select '.$key_str.' from cert');

        $datatables->edit('op', function ($data) {
            return '<a class="btn btn-brand" href="/admin/cert/'.$data['id'].'/edit">编辑</a>
                    <a class="btn btn-brand-accent" id="delete" value="'.$data['id'].'" href="javascript:void(0);" onClick="delete_modal_show(\''.$data['id'].'\')">删除</a>';
        });

        $datatables->edit('DT_RowId', function ($data) {
            return 'row_1_'.$data['id'];
        });

        $body = $response->getBody();
        $body->write($datatables->generate());
    }
}
