<?php


namespace App\Controllers\Mod_Mu;

use App\Controllers\BaseController;
use App\Models\NodeOnlineLog;
use App\Models\NodeInfoLog;
use App\Models\Node;
use App\Models\Cert;

class NodeController extends BaseController
{
    public function info($request, $response, $args)
    {
        $node_id = $args['id'];
        $load = $request->getParam('load');
        $uptime = $request->getParam('uptime');
        $log = new NodeInfoLog();
        $log->node_id = $node_id;
        $log->load = $load;
        $log->uptime = $uptime;
        $log->log_time = time();
        if (!$log->save()) {
            $res = [
                "ret" => 0,
                "data" => "update failed",
            ];
            return $this->echoJson($response, $res);
        }
        $res = [
            "ret" => 1,
            "data" => "ok",
        ];
        return $this->echoJson($response, $res);
    }

    public function get_info($request, $response, $args)
    {
        $node_id = $args['id'];
        $node = Node::find($node_id);
        if ($node == null) {
            $res = [
                "ret" => 0
            ];
            return $this->echoJson($response, $res);
        }
        $res = [
            "ret" => 1,
            "data" => [
                "node_group" => $node->node_group,
                "node_class" => $node->node_class,
                "node_speedlimit" => $node->node_speedlimit,
                "traffic_rate" => $node->traffic_rate,
                "mu_only" => $node->mu_only,
                "sort" => $node->sort
            ],
        ];
        if ($node->sort == 11) {
            $res["data"]["v2conf"] = json_decode($node->v2conf);
        }
        return $this->echoJson($response, $res);
    }

    public function get_all_info($request, $response, $args)
    {
        $nodes = Node::where('node_ip', '<>', null)->where(
            function ($query) {
                $query->where("sort", "=", 0)
                    ->orWhere("sort", "=", 10);
            }
        )->get();
        $res = [
            "ret" => 1,
            "data" => $nodes
        ];
        return $this->echoJson($response, $res);
    }

    public function get_cert($request, $response, $args)
    {
        $cert_id = $args['id'];
        $cert = Cert::find($cert_id);
        if ($cert == null) {
            $res = [
                "ret" => 0
            ];
            return $this->echoJson($response, $res);
        }
        if ($cert->type == 1) {
            $cert->cert = file_get_contents($cert->cert);
            $cert->key = file_get_contents($cert->key);
        }
        $res = [
            "ret" => 1,
            "data" => [
                "cert" => $cert->cert,
                "key" => $cert->key
            ],
        ];
        return $this->echoJson($response, $res);
    }
}
