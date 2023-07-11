<?php

namespace App\Utils;

use App\Models\User;
use App\Models\Node;
use App\Models\Relay;
use App\Services\Config;

class URL
{
    /*
    * 1 SSR can
    * 2 SS can
    * 3 Both can
    */
    public static function CanMethodConnect($method) {
        $ss_aead_method_list = Config::getSupportParam('ss_aead_method');
        if(in_array($method, $ss_aead_method_list)) {
            return 2;
        }
        return 3;
    }

    /*
    * 1 SSR can
    * 2 SS can
    * 3 Both can
    */
    public static function CanProtocolConnect($protocol) {
        if($protocol != 'origin') {
            if(strpos($protocol, '_compatible') === FALSE) {
                return 1;
            }else{
                return 3;
            }
        }

        return 3;
    }

    /*
    * 1 SSR can
    * 2 SS can
    * 3 Both can
    * 4 Both can, But ssr need set obfs to plain
    * 5 Both can, But ss need set obfs to plain
    */
    public static function CanObfsConnect($obfs) {
        if($obfs != 'plain') {
            //SS obfs only
            $ss_obfs = Config::getSupportParam('ss_obfs');
            if(in_array($obfs, $ss_obfs)) {
                if(strpos($obfs, '_compatible') === FALSE) {
                    return 2;
                }else{
                    return 4;//SSR need origin plain
                }
            }else{
                //SSR obfs only
                if(strpos($obfs, '_compatible') === FALSE) {
                    return 1;
                }else{
                    return 5;//SS need plain
                }
            }
        }else{
            return 3;
        }
    }


    public static function SSCanConnect($user, $mu_port = 0) {
        if($mu_port != 0) {
            $mu_user = User::where('port', '=', $mu_port)->where("is_multi_user", "<>", 0)->first();

            if ($mu_user == null) {
                return;
            }

            return URL::SSCanConnect($mu_user);
        }

        if(URL::CanMethodConnect($user->method) >= 2 && URL::CanProtocolConnect($user->protocol) >= 2 && URL::CanObfsConnect($user->obfs) >= 2) {
            return true;
        }else{
            return false;
        }
    }

    public static function SSRCanConnect($user, $mu_port = 0) {
        if($mu_port != 0) {
            $mu_user = User::where('port', '=', $mu_port)->where("is_multi_user", "<>", 0)->first();

            if ($mu_user == null) {
                return;
            }

            return URL::SSRCanConnect($mu_user);
        }

        if(URL::CanMethodConnect($user->method) != 2 && URL::CanProtocolConnect($user->protocol) != 2 && URL::CanObfsConnect($user->obfs) != 2) {
            return true;
        }else{
            return false;
        }
    }

    public static function getSSConnectInfo($user) {
        $new_user = clone $user;
        if(URL::CanObfsConnect($new_user->obfs) == 5) {
            $new_user->obfs = 'plain';
            $new_user->obfs_param = '';
        }

        if(URL::CanProtocolConnect($new_user->protocol) == 3) {
            $new_user->protocol = 'origin';
            $new_user->protocol_param = '';
        }

        $new_user->obfs = str_replace("_compatible", "", $new_user->obfs);
        $new_user->protocol = str_replace("_compatible", "", $new_user->protocol);

        return $new_user;
    }

    public static function getSSRConnectInfo($user) {
        $new_user = clone $user;
        if(URL::CanObfsConnect($new_user->obfs) == 4) {
            $new_user->obfs = 'plain';
            $new_user->obfs_param = '';
        }

        $new_user->obfs = str_replace("_compatible", "", $new_user->obfs);
        $new_user->protocol = str_replace("_compatible", "", $new_user->protocol);

        return $new_user;
    }

    public static function getAllItems($user, $is_mu = 0, $is_ss = 0, $v = 2) {
        return array_merge(URL::getAllSSRItems($user, $is_mu, $is_ss), URL::getAllV2RayItems($user, $v), URL::getAllTrojanItems($user));
    }

    public static function getAllSSRItems($user, $is_mu = 0, $is_ss = 0) {
        $return_array = array();
        if ($user->is_admin) {
            $nodes=Node::where(
                function ($query) {
                    $query->where('sort', 0)
                        ->orwhere('sort', 10);
                }
            )->where("type", "1")->orderBy("name")->get();
        } else {
            $nodes=Node::where(
                function ($query) {
                    $query->where('sort', 0)
                        ->orwhere('sort', 10);
                }
            )->where(
                function ($query) use ($user){
                    $query->where("node_group", "=", $user->node_group)
                        ->orWhere("node_group", "=", 0);
                }
            )->where("type", "1")->where("node_class", "<=", $user->class)->orderBy("name")->get();
        }

        if($is_mu) {
            if ($user->is_admin) {
                $mu_nodes = Node::where('sort', 9)->where("type", "1")->get();
            } else {
                $mu_nodes = Node::where('sort', 9)->where('node_class', '<=', $user->class)->where("type", "1")->where(
                    function ($query) use ($user) {
                        $query->where("node_group", "=", $user->node_group)
                            ->orWhere("node_group", "=", 0);
                    }
                )->get();
            }
        }

        $relay_rules = Relay::where('user_id', $user->id)->orwhere('user_id', 0)->orderBy('id', 'asc')->get();

        if (!Tools::is_protocol_relay($user)) {
            $relay_rules = array();
        }

        foreach ($nodes as $node) {
            if ($node->mu_only != 1 && $is_mu == 0) {
                if ($node->sort == 10) {
                    $relay_rule_id = 0;

                    $relay_rule = Tools::pick_out_relay_rule($node->id, $user->port, $relay_rules);

                    if ($relay_rule != null) {
                        if ($relay_rule->dist_node() != null) {
                            $relay_rule_id = $relay_rule->id;
                        }
                    }

                    $item = URL::getItem($user, $node, 0, $relay_rule_id, $is_ss);
                    if($item != null) {
                        array_push($return_array, $item);
                    }
                } else {
                    $item = URL::getItem($user, $node, 0, 0, $is_ss);
                    if($item != null) {
                        array_push($return_array, $item);
                    }
                }
            }


            if ($node->custom_rss == 1 && $node->mu_only != -1 && $is_mu == 1) {
                foreach ($mu_nodes as $mu_node) {
                    if ($node->sort == 10) {
                        $relay_rule_id = 0;

                        $relay_rule = Tools::pick_out_relay_rule($node->id, $mu_node->server, $relay_rules);

                        if ($relay_rule != null) {
                            if ($relay_rule->dist_node() != null) {
                                $relay_rule_id = $relay_rule->id;
                            }
                        }

                        $item = URL::getItem($user, $node, $mu_node->server, $relay_rule_id, $is_ss);
                        if($item != null) {
                            array_push($return_array, $item);
                        }
                    }else{
                        $item = URL::getItem($user, $node, $mu_node->server, 0, $is_ss);
                        if($item != null) {
                            array_push($return_array, $item);
                        }
                    }
                }
            }
        }

        return $return_array;
    }

    public static function getAllV2RayItems($user, $conf_version = 2) {
        $return_array = array();
        if ($user->is_admin) {
            $nodes=Node::where(
                function ($query) {
                    $query->where('sort', 11);
                }
            )->where("type", "1")->orderBy("name")->get();
        } else {
            $nodes=Node::where(
                function ($query) {
                    $query->where('sort', 11);
                }
            )->where(
                function ($query) use ($user){
                    $query->where("node_group", "=", $user->node_group)
                        ->orWhere("node_group", "=", 0);
                }
            )->where("type", "1")->where("node_class", "<=", $user->class)->orderBy("name")->get();
        }

        foreach ($nodes as $node) {
            $inbounds = json_decode($node->v2conf);
            foreach ($inbounds as $inbound) {
                $item = URL::getV2rayItem($user, $node, $inbound, $conf_version);
                if($item != null) {
                    array_push($return_array, $item);
                }
            }
        }

        return $return_array;

    }

    public static function getAllTrojanItems($user) {
        $return_array = array();
        if ($user->is_admin) {
            $nodes=Node::where(
                function ($query) {
                    $query->where('sort', 12)
                        ->orwhere('sort', 13);
                }
            )->where("type", "1")->orderBy("name")->get();
        } else {
            $nodes=Node::where(
                function ($query) {
                    $query->where('sort', 12)
                        ->orwhere('sort', 13);
                }
            )->where(
                function ($query) use ($user){
                    $query->where("node_group", "=", $user->node_group)
                        ->orWhere("node_group", "=", 0);
                }
            )->where("type", "1")->where("node_class", "<=", $user->class)->orderBy("name")->get();
        }

        foreach ($nodes as $node) {
            $conf = json_decode($node->trojan_conf);
            $item = URL::getTrojanItem($user, $node, $conf);
            if($item != null) {
                if ($node->sort == 13) {
                    $relay_rule = Relay::where('source_node_id', $node->id)->where(
                        function ($query) use ($user) {
                            $query->Where("user_id", "=", $user->id)
                                ->orWhere("user_id", "=", 0);
                        }
                    )->orderBy("priority", "DESC")->first();
                    $item['sni'] = $relay_rule->dist_node()->server;
                    $item['port'] = $relay_rule->port;
                    $item['remark'] = explode(" - ", $node->name)[0] .  " - " . $relay_rule->dist_node()->name;
                }
                array_push($return_array, $item);
            }
        }

        return $return_array;
    }

    public static function getAllUrl($user, $is_mu, $is_ss = 0, $v = 2, $enter = 0) {
        return URL::getAllSSRUrl($user, $is_mu, $is_ss, $enter).URL::getAllV2RayUrl($user, $v, $enter).URL::getAllTrojanUrl($user, $enter);
    }

    public static function getAllSSRUrl($user, $is_mu, $is_ss = 0, $enter = 0) {
        $return_url = '';
        $items = URL::getAllSSRItems($user, $is_mu, $is_ss);
        foreach($items as $item) {
            $return_url .= URL::getItemUrl($item, $is_ss).($enter == 0 ? ' ' : "\n");
        }
        return $return_url;
    }

    public static function getAllV2RayUrl($user, $v = 2, $enter = 0) {
        $return_url = '';
        $items = URL::getAllV2RayItems($user, $v);
        foreach($items as $item) {
            $return_url .= URL::getV2RayItemUrl($item, $v).($enter == 0 ? ' ' : "\n");
        }
        return $return_url;
    }

    public static function getAllTrojanUrl($user, $enter = 0) {
        $return_url = '';
        $items = URL::getAllTrojanItems($user);
        foreach($items as $item) {
            $return_url .= URL::getTrojanItemUrl($item).($enter == 0 ? ' ' : "\n");
        }
        return $return_url;
    }

    public static function getItemUrl($item, $is_ss) {
        $ss_obfs_list = Config::getSupportParam('ss_obfs');

        if(!$is_ss) { // ssr
            $ssurl = $item['address'].":".$item['port'].":".$item['protocol'].":".$item['method'].":".$item['obfs'].":".Tools::base64_url_encode($item['passwd'])."/?obfsparam=".Tools::base64_url_encode($item['obfs_param'])."&protoparam=".Tools::base64_url_encode($item['protocol_param'])."&remarks=".Tools::base64_url_encode($item['remark'])."&group=".Tools::base64_url_encode($item['group']);
            return "ssr://".Tools::base64_url_encode($ssurl);
        } else {
            if($is_ss == 2) { // ss windows
                $personal_info = $item['method'].':'.$item['passwd']."@".$item['address'].":".$item['port'];
                $ssurl = "ss://".Tools::base64_url_encode($personal_info);

                $ssurl .= "#".rawurlencode($item['remark']);
            } else { // ss other
                $personal_info = $item['method'].':'.$item['passwd'];
                $ssurl = "ss://".Tools::base64_url_encode($personal_info)."@".$item['address'].":".$item['port'];

                $plugin = '';
                if(in_array($item['obfs'], $ss_obfs_list)) {
                    if(strpos($item['obfs'], 'http') !== FALSE) {
                        $plugin .= "obfs-local;obfs=http";
                    } else {
                        $plugin .= "obfs-local;obfs=tls";
                    }

                    if($item['obfs_param'] != '') {
                        $plugin .= ";obfs-host=".$item['obfs_param'];
                    }

                    $ssurl .= "?plugin=".rawurlencode($plugin);
                }

                $ssurl .= "#".rawurlencode($item['remark']);
            }
            return $ssurl;
        }
    }

    public static function getV2RayItemUrl($item, $conf_version = 2) {
        switch ($conf_version) {
            case 1:
                $parameters = '';
                $ignore_items = ['security', 'uuid', 'host', 'port', 'id', 'node_class'];
                foreach ($item as $key => $value) {
                    if(in_array($key, $ignore_items)) {
                        continue;
                    }
                    $parameters .= $key.'='.rawurlencode($value).'&';
                }
                $url = 'vmess://'.Tools::base64_url_encode($item['security'].':'.$item['uuid'].'@'.$item['host'].':'.$item['port']).'?'.substr($parameters, 0, -1);
                break;

            case 2:
                $url = 'vmess://'.Tools::base64_url_encode(json_encode($item));
                break;
            
            default:
                break;
        }
        return $url;
    }

    public static function getTrojanItemUrl($item) {
        return 'trojan://'.$item['passwd'].'@'.$item['address'].':'.$item['port'].'?allowInsecure=0&peer='.$item['sni'].'&tfo='.$item['fast_open'].'&mux=0&alpn=h2#'.rawurlencode($item['remark']);
    }

    public static function getJsonObfs($item) {
        $ss_obfs_list = Config::getSupportParam('ss_obfs');
        $plugin = "";
        if(in_array($item['obfs'], $ss_obfs_list)) {
            if(strpos($item['obfs'], 'http') !== FALSE) {
                $plugin .= "obfs-local --obfs http";
            } else {
                $plugin .= "obfs-local --obfs tls";
            }

            if($item['obfs_param'] != '') {
                $plugin .= "--obfs-host ".$item['obfs_param'];
            }
        }

        return $plugin;
    }

    public static function getSurgeObfs($item) {
        $ss_obfs_list = Config::getSupportParam('ss_obfs');
        $plugin = "";
        if(in_array($item['obfs'], $ss_obfs_list)) {
            if(strpos($item['obfs'], 'http') !== FALSE) {
                $plugin .= ",obfs=http";
            } else {
                $plugin .= ",obfs=tls";
            }

            if($item['obfs_param'] != '') {
                $plugin .= ",obfs-host=".$item['obfs_param'];
            }
        }

        return $plugin;
    }

    /*
    * Conn info
    * address
    * port
    * passwd
    * method
    * remark
    * protocol
    * protocol_param
    * obfs
    * obfs_param
    * group
    */

    public static function getItem($user, $node, $mu_port = 0, $relay_rule_id = 0, $is_ss = 0) {

        $relay_rule = Relay::where('id', $relay_rule_id)->where(
            function ($query) use ($user) {
                $query->Where("user_id", "=", $user->id)
                    ->orWhere("user_id", "=", 0);
            }
        )->first();

        $node_name = $node->name;

        if ($relay_rule != null) {
            $node_name .= " - ".$relay_rule->dist_node()->name;
        }

        if($mu_port != 0) {
            $mu_user = User::where('port', '=', $mu_port)->where("is_multi_user", "<>", 0)->first();

            if ($mu_user == null) {
                return;
            }

            $mu_user->obfs_param = $user->getMuMd5();
            $mu_user->protocol_param = $user->id.":".$user->passwd;

            $user = $mu_user;

            $node_name .= " - ".$mu_port." 端口单端口多用户";
        }

        if($is_ss) {
            if(!URL::SSCanConnect($user)) {
                return;
            }
            $user = URL::getSSConnectInfo($user);
        }else{
            if(!URL::SSRCanConnect($user)) {
                return;
            }
            $user = URL::getSSRConnectInfo($user);
        }

        $return_array['id'] = $node->id;
        $return_array['node_class'] = $node->node_class;
        $return_array['address'] = $node->server;
        $return_array['port'] = $user->port;
        $return_array['passwd'] = $user->passwd;
        $return_array['method'] = $user->method;
        $return_array['remark'] = $node_name;
        $return_array['protocol'] = $user->protocol;
        $return_array['protocol_param'] = $user->protocol_param;
        $return_array['obfs'] = $user->obfs;
        $return_array['obfs_param'] = $user->obfs_param;
        $return_array['group'] = Config::get('appName');
        if($mu_port != 0) {
            $return_array['group'] .= ' - 单端口多用户';
        }
        return $return_array;
    }

    /*
    json数据如下
    {
    "v": "2",
    "ps": "备注别名",
    "add": "111.111.111.111",
    "port": "32000",
    "id": "1386f85e-657b-4d6e-9d56-78badb75e1fd",
    "aid": "100",
    "net": "tcp",
    "type": "none",
    "host": "www.bbb.com",
    "path": "/",
    "tls": "tls"
    }

    v:配置文件版本号,主要用来识别当前配置
    net ：传输协议（tcp\kcp\ws\h2\quic)
    type:伪装类型（none\http\srtp\utp\wechat-video） *tcp or kcp or QUIC
    host：伪装的域名
    1)http host中间逗号(,)隔开
    2)ws host
    3)h2 host
    4)QUIC securty
    path:path
    1)ws path
    2)h2 path
    3)QUIC key
    3)mKCP key
    tls：底层传输安全（tls)


    vmess://base64(security:uuid@host:port)?[urlencode(parameters)]
    其中 base64、urlencode 为函数，security 为加密方式，parameters 是以 & 为分隔符的参数列表，例如：network=kcp&aid=32&remark=服务器1 经过 urlencode 后为 network=kcp&aid=32&remark=%E6%9C%8D%E5%8A%A1%E5%99%A81
    可选参数（参数名称不区分大小写）：
    network - 可选的值为 "tcp"、 "kcp"、"ws"、"h2" 等
    wsPath - WebSocket 的协议路径
    wsHost - WebSocket HTTP 头里面的 Host 字段值
    kcpHeader - kcp 的伪装类型
    uplinkCapacity - kcp 的上行容量
    downlinkCapacity - kcp 的下行容量
    h2Path - h2 的路径
    h2Host - h2 的域名
    quicSecurity - quic 加密算法
    quitKey - quic 加密用的密码
    quicHeader - quic 的伪装类型
    aid - AlterId
    tls - 是否启用 TLS，为 0 或 1
    allowInsecure - TLS 的 AllowInsecure，为 0 或 1
    tlsServer - TLS 的服务器端证书的域名
    mux - 是否启用 mux，为 0 或 1
    muxConcurrency - mux 的 最大并发连接数
    remark - 备注名称
    导入配置时，不在列表中的参数一般会按照 Core 的默认值处理。
    */
    public static function getV2rayItem($user, $node, $inbound, $conf_version) {
        $uuid = $user->get_v2ray_uuid();
        $return_array = Array();
        $return_array['id'] = $node->id;
        $return_array['node_class'] = $node->node_class;
        switch ($conf_version) {
            case 1:
                // $return_array["v"] = 1;
                $return_array["security"] = "auto";
                $return_array["uuid"] = $uuid;
                $return_array["host"] = $node->server;
                $return_array["port"] = $inbound->port;
                $return_array["protocol"] = $inbound->protocol;
                $return_array["network"] = $inbound->network;
                switch ($inbound->protocol) {
                    case 'vmess':
                        $return_array["aid"] = $inbound->alterid;
                        break;
                    case 'vless':
                        break;
                    case 'trojan':
                        break;
                    default:
                        break;
                }
                $return_array["tls"] = $inbound->security == "tls" ? 1 : 0;
                $return_array["allowInsecure"] = 0;
                $return_array["tlsServer"] = $node->server;
                $return_array["mux"] = 1;
                $return_array["muxConcurrency"] = 8;
                if($inbound->network == "ws" or $inbound->network == "h2") {
                    if(!empty($inbound->proxyaddr) and !empty($inbound->proxyport)) {
                        $return_array["host"] = $inbound->proxyaddr;
                        $return_array["port"] = $inbound->proxyport;
                        if($inbound->security == "none" and $inbound->proxysecurity == "tls") {
                            $return_array["tls"] = 1;
                            $return_array["tlsServer"] = $return_array["host"];
                        }
                    }
                }
                switch ($inbound->network) {
                    case "tcp":
                        break;
                    case "kcp":
                        $return_array["kcpHeader"] = $inbound->obfs;
                        $return_array["uplinkCapacity"] = $inbound->uplinkcapacity;
                        $return_array["downlinkCapacity"] = $inbound->downlinkcapacity;
                        $return_array["kcpSeed"] = $inbound->seed;
                        break;
                    case "ws":
                        $return_array["wsPath"] = $inbound->path;
                        if(!empty($inbound->headers->Host)) {
                            $return_array["wsHost"] = $inbound->headers->Host;
                            if($return_array["tls"] == 1) {
                                $return_array["tlsServer"] = $inbound->headers->Host;
                            }
                        } else {
                            $return_array["wsHost"] = $return_array["host"];
                        }
                        break;
                    case "h2":
                        if(!empty($inbound->host)) {
                            $return_array["h2Host"] = $inbound->host;
                        } else {
                            $return_array["h2Host"] = $return_array["host"];
                        }
                        $return_array["h2Path"] = $inbound->path;
                        break;
                    case "quic":
                        $return_array["quicSecurity"] = $inbound->encryption;
                        $return_array["quitKey"] = $inbound->quickey;
                        $return_array["quicHeader"] = $inbound->obfs;
                        break;
                    default:
                        break;
                }
                $return_array["flow"] = $inbound->flow;
                $return_array["remark"] = str_replace(' ', '', explode(" - ", $node->name)[0])."-".$return_array["network"];
                // for shadowrocket only
                $return_array["remarks"] = $return_array["remark"];
                switch ($inbound->network) {
                    case "tcp":
                        break;
                    case "kcp":
                        // $return_array["obfsParam"] = json_encode([ "uplinkCapacity" => $inbound->uplinkcapacity, "downlinkCapacity" => $inbound->downlinkcapacity, "tti" => $inbound->tti, "header" => $inbound->obfs, "mtu" => $inbound->mtu ]);
                        $return_array["obfsParam"] = json_encode([ "seed" => $inbound->seed, "header" => $inbound->obfs ]);
                        break;
                    case "ws":
                        $return_array["obfsParam"] = $return_array["wsHost"];
                        $return_array["peer"] = $return_array["tlsServer"];
                        break;
                    case "h2":
                        $return_array["obfsParam"] = $return_array["h2Host"];
                        $return_array["peer"] = $return_array["tlsServer"];
                        break;
                    case "quic":
                        break;
                    default:
                        break;
                }
                $return_array["path"] = $inbound->path;                
                switch ($inbound->network) {
                    case "kcp":
                        $return_array["obfs"] = "mkcp";
                        break;
                    case "ws":
                        $return_array["obfs"] = "websocket";
                        break;                    
                    default:
                        $return_array["obfs"] = $inbound->network;
                        break;
                }
                if($inbound->tcpfastopen == "true") {
                    $return_array["tfo"] = 1;
                } else {
                    $return_array["tfo"] = 0;
                }
                break;
            case 2:
                $return_array["v"] = 2;
                $return_array["ps"] = "";
                $return_array["add"] = $node->server;
                $return_array["port"] = $inbound->port;
                $return_array["id"] = $uuid;
                switch ($inbound->protocol) {
                    case 'vmess':
                        $return_array["aid"] = $inbound->alterid;
                        break;
                    case 'vless':
                        break;
                    case 'trojan':
                        break;
                    default:
                        break;
                }
                $return_array["net"] = $inbound->network;
                $return_array["type"] = "";
                $return_array["host"] = "";
                $return_array["path"] = "";
                $return_array["tls"] = $inbound->security;
                if($inbound->network == "ws" or $inbound->network == "h2") {
                    if(!empty($inbound->proxyaddr) and !empty($inbound->proxyport)) {
                        $return_array["add"] = $inbound->proxyaddr;
                        $return_array["port"] = $inbound->proxyport;
                        if($inbound->security == "none" and $inbound->proxysecurity == "tls") {
                            $return_array["tls"] = "tls";
                        }
                    }
                }
                switch ($inbound->network) {
                    case "tcp":
                        $return_array["type"] = $inbound->obfs;
                        break;
                    case "kcp":
                        $return_array["type"] = $inbound->obfs;
                        $return_array["path"] = $inbound->seed;
                        break;
                    case "ws":
                        $return_array["path"] = $inbound->path;
                        if(!empty($inbound->headers->Host)) {
                            $return_array["host"] = $inbound->headers->Host;
                        } else {
                            $return_array["host"] = $return_array["add"];
                        }
                        break;
                    case "h2":
                        $return_array["path"] = $inbound->path;
                        if(!empty($inbound->host)) {
                            $return_array["host"] = $inbound->host;
                        } else {
                            $return_array["host"] = $return_array["add"];
                        }
                        break;
                    case "quic":
                        $return_array["type"] = $inbound->obfs;
                        $return_array["host"] = $inbound->encryption;
                        if($inbound->encryption != "none") {
                            $return_array["path"] = $inbound->quickey;
                        }
                        break;
                    default:
                        break;
                }
                $return_array["flow"] = $inbound->flow;
                $return_array["ps"] = str_replace(' ', '', explode(" - ", $node->name)[0])."-".$return_array["net"];
                break;
            default:
                break;
        }
        return $return_array;
    }

    public static function getTrojanItem($user, $node, $conf) {
        // 'trojan://'.$item['passwd'].'@'.$item['address'].':'.$item['port'].'?allowInsecure=0&tfo='.$item['fast_open'].'#'.rawurlencode($item['remark']);
        $return_array = Array();
        $return_array['id'] = $node->id;
        $return_array['node_class'] = $node->node_class;
        $return_array['passwd'] = $user->passwd;
        $return_array['address'] = $node->server;
        $return_array['port'] = $conf->local_port;
        $return_array['sni'] = $node->server;
        $return_array['fast_open'] = $conf->fast_open;
        $return_array['remark'] = str_replace(' ', '', explode(" - ", $node->name)[0]);
        $return_array['reuse_session'] = $conf->reuse_session;
        $return_array['session_ticket'] = $conf->session_ticket;
        $return_array['no_delay'] = $conf->no_delay;
        $return_array['keep_alive'] = $conf->keep_alive;
        $return_array['reuse_port'] = $conf->reuse_port;
        $return_array['fast_open'] = $conf->fast_open;
        $return_array['fast_open_qlen'] = $conf->fast_open_qlen;
        return $return_array;
    }

    // use subscribe rule v1 to generate a clien json configuration
    public static function generateV2rayClientJson($item) {
        $root_conf = [
            "log" => [
                "loglevel" => "warning"
            ],
            "dns" => [
                "servers" => [
                    [
                        "address" => "182.254.116.116",
                        "domains" => [
                            "geosite:cn"
                        ],
                        "expectIPs" => [
                            "geoip:cn"
                        ]
                    ],
                    [
                        "address" => "1.0.0.1",
                        "domains" => [
                            "geosite:geolocation-!cn",
                            "geosite:speedtest",
                        ]
                    ],
                    "182.254.116.116",
                    "223.6.6.6",
                    "localhost"
                ]
            ],
            "inbounds" => [
                [
                    "listen" => "127.0.0.1",
                    "protocol" => "socks",
                    "port" => "1079",
                    "settings" => [
                        "udp" => true
                    ]
                ],
                [
                    "listen" => "127.0.0.1",
                    "protocol" => "http",
                    "port" => "1080"
                ]
            ],
            "outbounds" => [],
            "routing" => [
                "domainStrategy" => "IPIfNonMatch",
                "rules" => [
                    [
                        "type" => "field",
                        "domain" => [
                            "geosite:cn"
                        ],
                        "outboundTag" => "direct"
                    ],
                    [
                        "type" => "field",
                        "ip" => [
                            "geoip:cn"
                        ],
                        "outboundTag" => "direct"
                    ],
                    [
                        "type" => "field",
                        "ip" => [
                            "geoip:private"
                        ],
                        "outboundTag" => "direct"
                    ],
                    [
                        "type" => "field",
                        "domain" => [
                            "geosite:speedtest"
                        ],
                        "outboundTag" => "direct"
                    ],
                    [
                        "type" => "field",
                        "domain" => [
                            "geosite:category-ads"
                        ],
                        "outboundTag" => "blocked"
                    ]
                ]
            ]
        ];
        // out bound
        $out = [
            "protocol" => "vmess",
            "settings" => [
                    "vnext" => [
                    [
                        "address" => $item['host'],
                        "port" => $item['port'],
                        "users" => [
                            [
                                "id" => $item['uuid'],
                                "alterId" => $item['aid'],
                                "security" => "auto"
                            ]
                        ]
                    ]
                ]
            ],
            "streamSettings" => [
                "network" => $item['network']
            ]
        ];
        // network
        switch ($item['network']) {
            case "tcp":
                break;
            case "ws":
                $wss = [
                    "path" => $item['wsPath']
                ];
                if(!empty($item['wsHost'])) {
                    $wss["headers"] = [
                        "Host" => $item['wsHost']
                    ];
                }
                $out['streamSettings']['wsSettings'] = $wss;
                break;
            case "kcp":
                $kcps = [
                        "mtu" => 1350,
                        "tti" => 20,
                        "uplinkCapacity" => $item['uplinkCapacity'],
                        "downlinkCapacity" => $item['downlinkCapacity'],
                        "congestion" => false,
                        "readBufferSize" => 1,
                        "writeBufferSize" => 1,
                        "header" => [
                            "type" => $item['kcpHeader']
                        ]
                ];
                if(!empty($item['kcpSeed'])) {
                    $kcps['seed'] = $item['kcpSeed'];
                }
                $out['streamSettings']['kcpSettings'] = $kcps;
                break;
            case "h2":
                $h2s = [
                    "path" => $item['h2Path']
                ];
                if(preg_replace("/\s+/m", "", $item['h2Host']) != "") {
                    $h2s["host"] = explode(",", preg_replace("/\s+/m", "", $item['h2Host']));
                }
                $out['streamSettings']['httpSettings'] = $h2s;
                break;
            case "quic":
                $quics = [
                    "security" => $item['quicSecurity'],
                    "header" => [
                        "type" => $item['quicHeader']
                    ]
                ];
                if($item['quicSecurity'] != "none") {
                    $quics["key"] = $item['quitKey'];
                }
                $out['streamSettings']['quicSettings'] = $quics;
                break;
            default:
                break;
        }
        // tls
        $out['streamSettings']['security'] = $item['tls'] == 1 ? "tls" : "none";
        if($item['tls'] == 1) {
            $out['streamSettings']['tlsSettings'] = [
                "allowInsecure" => $item['allowInsecure'] == 1 ? true : false
            ];
        }
        // tcp fast open
        if($item['tfo'] == 1) {
            $out['streamSettings']['sockopt'] = [
                "tcpFastOpen" => true
            ];
        }
        // mux
        if($item['mux'] == 1) {
            $out['mux'] = [
                "enabled" => true,
                "concurrency" => $item['muxConcurrency']
            ];
        }
        $out['tag'] = 'proxy';
        array_push($root_conf["outbounds"], $out);
        array_push($root_conf["outbounds"], ["protocol" => "freedom", "tag" => "direct"]);
        array_push($root_conf["outbounds"], ["protocol" => "blackhole", "tag" => "blocked"]);
        return $root_conf;
    }

    public static function cloneUser($user) {
        $new_user = clone $user;
        return $new_user;
    }
}
