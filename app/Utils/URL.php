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

    public static function getAllItems($user, $is_mu = 0, $is_ss = 0) {
        $return_array = array();
        if ($user->is_admin) {
            $nodes=Node::where(
                function ($query) {
                    $query->where('sort', 0)
                        ->orwhere('sort', 10)
                        ->orwhere('sort', 11);
                }
            )->where("type", "1")->orderBy("name")->get();
        } else {
            $nodes=Node::where(
                function ($query) {
                    $query->where('sort', 0)
                        ->orwhere('sort', 10)
                        ->orwhere('sort', 11);
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
                } elseif ($node->sort == 11) {
                    $inbounds = json_decode($node->v2conf);
                    foreach ($inbounds as $inbound) {
                        $item = URL::getV2rayItem($user, $node, $inbound, $is_ss);
                        if($item != null) {
                            array_push($return_array, $item);
                        }
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

    public static function getAllUrl($user, $is_mu, $is_ss = 0, $enter = 0) {
        $items = URL::getAllItems($user, $is_mu, $is_ss);
        $return_url = '';
        foreach($items as $item) {
            $return_url .= URL::getItemUrl($item, $is_ss).($enter == 0 ? ' ' : "\n");
        }
        return $return_url;
    }

    public static function getItemUrl($item, $is_ss) {
        $ss_obfs_list = Config::getSupportParam('ss_obfs');

        if(!$is_ss) {
            $ssurl = $item['address'].":".$item['port'].":".$item['protocol'].":".$item['method'].":".$item['obfs'].":".Tools::base64_url_encode($item['passwd'])."/?obfsparam=".Tools::base64_url_encode($item['obfs_param'])."&protoparam=".Tools::base64_url_encode($item['protocol_param'])."&remarks=".Tools::base64_url_encode($item['remark'])."&group=".Tools::base64_url_encode($item['group']);
            return "ssr://".Tools::base64_url_encode($ssurl);
        } else {
            if($is_ss == 2) {
                $personal_info = $item['method'].':'.$item['passwd']."@".$item['address'].":".$item['port'];
                $ssurl = "ss://".Tools::base64_url_encode($personal_info);

                $ssurl .= "#".rawurlencode($item['remark']);
            } elseif ($is_ss == 3) {
                $ssurl = "vmess://".Tools::base64_url_encode(json_encode($item));
            } else {
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
        if($is_ss == 3) {
            return;
        }
        
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
    */
    public static function getV2rayItem($user, $node, $inbound, $is_ss) {
        if($is_ss != 3) {
            return;
        }
        $return_array['v'] = '2';
        $return_array['ps'] = '';
        $return_array['add'] = $node->server;
        $return_array['port'] = $inbound->port;
        $return_array['id'] = $user->get_v2ray_uuid();
        $return_array['aid'] = $inbound->alterid;
        $return_array['net'] = $inbound->network;
        $return_array['type'] = $inbound->obfs;
        $return_array['host'] = '';
        $return_array['path'] = $inbound->path;
        $return_array['tls'] = $inbound->security;
        if($inbound->network == 'ws') {
            if(!empty($inbound->headers->Host)) {
                $return_array['host'] = $inbound->headers->Host;
            }
        } elseif($inbound->network == 'h2') {
            $return_array['host'] = $inbound->host;
        } elseif($inbound->network == 'quic') {
            $return_array['host'] = $inbound->encryption;
            $return_array['path'] = $inbound->quickey;
        }
        if($inbound->network == 'ws' or $inbound->network == 'h2') {
            if(!empty($inbound->proxyaddr) and !empty($inbound->proxyport)) {
                $return_array['add'] = $inbound->proxyaddr;
                $return_array['port'] = $inbound->proxyport;
                if($inbound->security == 'none' and $inbound->proxysecurity == 'tls') {
                    $return_array['tls'] = 'tls';
                }
            }
        }
        $return_array['ps'] = explode(" - ", $node->name)[0].'-'.$return_array['net'].'-'.$return_array['add'];
        return $return_array;
    }

    public static function genV2rayClientItem($item) {
        $root_conf = array(
            "log" => array(
                "loglevel" => "warning"
            ),
            "inbounds" => array(
            array(
                "listen" => "127.0.0.1",
                "protocol" => "socks",
                "port" => "1079",
                "settings" => array(
                    "udp" => true
                )
            ),
            array(
                "listen" => "127.0.0.1",
                "protocol" => "http",
                "port" => "1080"
            )
            ),
            "outbounds" => array(),
            "dns" => array(
                "servers" => array(
                    "8.8.8.8",
                    "8.8.4.4"
                )
            ),
            "routing" => array(
                "domainStrategy" => "IPIfNonMatch",
                "rules" => array(
                    array(
                        "type" => "field",
                        "domain" => array(
                            "geosite:cn",
                            "geosite:speedtest"
                        ),
                        "outboundTag" => "direct"
                    ),
                    array(
                        "type" => "field",
                        "ip" => array(
                            "geoip:private",
                            "geoip:cn"
                        ),
                        "outboundTag" => "direct"
                    ),
                    array(
                        "type" => "field",
                        "domain" => array(
                            "geosite:category-ads"
                        ),
                        "outboundTag" => "blocked"
                    )
                )
            )
        );

        $out = array(
          "protocol" => "vmess",
          "settings" => array(
            "vnext" => array(
              array(
                "address" => $item['add'],
                "port" => $item['port'],
                "users" => array(
                  array(
                    "id" => $item['id'],
                    "alterId" => $item['aid'],
                    "security" => "auto"
                  )
                )
              )
            )
          ),
          "streamSettings" => array(
            "network" => $item['net']
          ),
          "tag" => "proxy"
        );
        switch ($item['net']) {
            case 'ws':
                $wss = array(
                  "path" => $item['path']
                );
                if($item['host'] != '') {
                    $wss['headers'] = array(
                        "Host" => $item['host']
                    );
                }
                $out['streamSettings']['wsSettings'] = $wss;
                break;

            case 'kcp':
                $out['streamSettings']['kcpSettings'] = array(
                  "mtu" => 1350,
                  "tti" => 20,
                  "uplinkCapacity" => 5,
                  "downlinkCapacity" => 20,
                  "congestion" => false,
                  "readBufferSize" => 1,
                  "writeBufferSize" => 1,
                  "header" => array(
                    "type" => $item['type']
                  )
                );
                break;

            case 'h2':
                $h2s = array(
                  "path" => $item['path']
                );
                if($item['host'] != '') {
                    $h2s['host'] = array();
                    foreach (explode(',', $item['host']) as $h) {
                        array_push($h2s['host'], $h);
                    }
                }
                $out['streamSettings']['httpSettings'] = $h2s;
                break;

            case 'quic':
                $quics = array(
                    "security" => $item['host'],
                    "key" => $item['path'],
                    "header" => array(
                        "type" => $item['type']
                    )
                );
                $out['streamSettings']['quicSettings'] = $quics;
                break;
            
            default:
                break;
        }
        $out['streamSettings']['security'] = $item['tls'];
        if($item['tls'] == 'tls') {
            $out['streamSettings']['tlsSettings'] = array(
              "allowInsecure" => true
            );
        }
        array_push($root_conf['outbounds'], $out);
        array_push($root_conf['outbounds'], array(
                    "protocol" => "freedom",
                    "tag" => "direct"
                ));
        array_push($root_conf['outbounds'], array(
                    "protocol" => "blackhole",
                    "tag" => "blocked"
                ));
        return $root_conf;
    }

    public static function cloneUser($user) {
        $new_user = clone $user;
        return $new_user;
    }
}
