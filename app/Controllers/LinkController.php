<?php

//Thanks to http://blog.csdn.net/jollyjumper/article/details/9823047

namespace App\Controllers;

use App\Models\Link;
use App\Models\User;
use App\Models\Node;
use App\Models\Relay;
use App\Models\Smartline;
use App\Utils\Tools;
use App\Utils\URL;
use App\Services\Config;

/**
 *  HomeController
 */
class LinkController extends BaseController
{
    public function __construct()
    {
    }

    public static function GenerateRandomLink()
    {
        $i =0;
        for ($i = 0; $i < 10; $i++) {
            $token = Tools::genRandomChar(16);
            $Elink = Link::where("token", "=", $token)->first();
            if ($Elink == null) {
                return $token;
            }
        }

        return "couldn't alloc token";
    }

    public static function GenerateCode($type, $address, $port, $ios, $userid)
    {
        $Elink = Link::where("type", "=", $type)->where("address", "=", $address)->where("port", "=", $port)->where("ios", "=", $ios)->where("userid", "=", $userid)->first();
        if ($Elink != null) {
            return $Elink->token;
        }
        $NLink = new Link();
        $NLink->type = $type;
        $NLink->address = $address;
        $NLink->port = $port;
        $NLink->ios = $ios;
        $NLink->userid = $userid;
        $NLink->token = LinkController::GenerateRandomLink();
        $NLink->save();

        return $NLink->token;
    }





    public static function GenerateApnCode($isp, $address, $port, $userid)
    {
        $Elink = Link::where("type", "=", 6)->where("address", "=", $address)->where("port", "=", $port)->where("userid", "=", $userid)->where("isp", "=", $isp)->first();
        if ($Elink != null) {
            return $Elink->token;
        }
        $NLink = new Link();
        $NLink->type = 6;
        $NLink->address = $address;
        $NLink->port = $port;
        $NLink->ios = 1;
        $NLink->isp = $isp;
        $NLink->userid = $userid;
        $NLink->token = LinkController::GenerateRandomLink();
        $NLink->save();

        return $NLink->token;
    }


    public static function GenerateSurgeCode($address, $port, $userid, $geo, $method)
    {
        $Elink = Link::where("type", "=", 0)->where("address", "=", $address)->where("port", "=", $port)->where("userid", "=", $userid)->where("geo", "=", $geo)->where("method", "=", $method)->first();
        if ($Elink != null) {
            return $Elink->token;
        }
        $NLink = new Link();
        $NLink->type = 0;
        $NLink->address = $address;
        $NLink->port = $port;
        $NLink->ios = 1;
        $NLink->geo = $geo;
        $NLink->method = $method;
        $NLink->userid = $userid;
        $NLink->token = LinkController::GenerateRandomLink();
        $NLink->save();

        return $NLink->token;
    }

    public static function GenerateIosCode($address, $port, $userid, $geo, $method)
    {
        $Elink = Link::where("type", "=", -1)->where("address", "=", $address)->where("port", "=", $port)->where("userid", "=", $userid)->where("geo", "=", $geo)->where("method", "=", $method)->first();
        if ($Elink != null) {
            return $Elink->token;
        }
        $NLink = new Link();
        $NLink->type = -1;
        $NLink->address = $address;
        $NLink->port = $port;
        $NLink->ios = 1;
        $NLink->geo = $geo;
        $NLink->method = $method;
        $NLink->userid = $userid;
        $NLink->token = LinkController::GenerateRandomLink();
        $NLink->save();

        return $NLink->token;
    }

    public static function GenerateAclCode($address, $port, $userid, $geo, $method)
    {
        $Elink = Link::where("type", "=", 9)->where("address", "=", $address)->where("port", "=", $port)->where("userid", "=", $userid)->where("geo", "=", $geo)->where("method", "=", $method)->first();
        if ($Elink != null) {
            return $Elink->token;
        }
        $NLink = new Link();
        $NLink->type = 9;
        $NLink->address = $address;
        $NLink->port = $port;
        $NLink->ios = 0;
        $NLink->geo = $geo;
        $NLink->method = $method;
        $NLink->userid = $userid;
        $NLink->token = LinkController::GenerateRandomLink();
        $NLink->save();

        return $NLink->token;
    }

    public static function GenerateRouterCode($userid, $without_mu)
    {
        $Elink = Link::where("type", "=", 10)->where("userid", "=", $userid)->where("geo", $without_mu)->first();
        if ($Elink != null) {
            return $Elink->token;
        }
        $NLink = new Link();
        $NLink->type = 10;
        $NLink->address = "";
        $NLink->port = 0;
        $NLink->ios = 0;
        $NLink->geo = $without_mu;
        $NLink->method = "";
        $NLink->userid = $userid;
        $NLink->token = LinkController::GenerateRandomLink();
        $NLink->save();

        return $NLink->token;
    }

    public static function GenerateSSRSubCode($userid, $without_mu)
    {
        $Elink = Link::where("type", "=", 11)->where("userid", "=", $userid)->where("geo", $without_mu)->first();
        if ($Elink != null) {
            return $Elink->token;
        }
        $NLink = new Link();
        $NLink->type = 11;
        $NLink->address = "";
        $NLink->port = 0;
        $NLink->ios = 0;
        $NLink->geo = $without_mu;
        $NLink->method = "";
        $NLink->userid = $userid;
        $NLink->token = LinkController::GenerateRandomLink();
        $NLink->save();

        return $NLink->token;
    }

    public static function GenerateClashSubCode($userid)
    {
        $Elink = Link::where("type", "=", 12)->where("userid", "=", $userid)->first();
        if ($Elink != null) {
            return $Elink->token;
        }
        $NLink = new Link();
        $NLink->type = 12;
        $NLink->address = "";
        $NLink->port = 0;
        $NLink->ios = 0;
        $NLink->geo = 0;
        $NLink->method = "";
        $NLink->userid = $userid;
        $NLink->token = LinkController::GenerateRandomLink();
        $NLink->save();

        return $NLink->token;
    }

    public static function GenerateV2RaySubCode($userid)
    {
        $Elink = Link::where("type", "=", 13)->where("userid", "=", $userid)->first();
        if ($Elink != null) {
            return $Elink->token;
        }
        $NLink = new Link();
        $NLink->type = 13;
        $NLink->address = "";
        $NLink->port = 0;
        $NLink->ios = 0;
        $NLink->geo = 0;
        $NLink->method = "";
        $NLink->userid = $userid;
        $NLink->token = LinkController::GenerateRandomLink();
        $NLink->save();

        return $NLink->token;
    }

    public static function GenerateTrojanSubCode($userid)
    {
        $Elink = Link::where("type", "=", 14)->where("userid", "=", $userid)->first();
        if ($Elink != null) {
            return $Elink->token;
        }
        $NLink = new Link();
        $NLink->type = 14;
        $NLink->address = "";
        $NLink->port = 0;
        $NLink->ios = 0;
        $NLink->geo = 0;
        $NLink->method = "";
        $NLink->userid = $userid;
        $NLink->token = LinkController::GenerateRandomLink();
        $NLink->save();

        return $NLink->token;
    }

    public static function GetContent($request, $response, $args)
    {
        $token = $args['token'];

        //$builder->getPhrase();
        $Elink = Link::where("token", "=", $token)->first();
        if ($Elink == null) {
            return null;
        }

        $domainname = preg_replace('|https?:\/\/|', '', Config::get('baseUrl'));
        switch ($Elink->type) {
            case -1:
                $user=User::where("id", $Elink->userid)->first();
                if ($user == null) {
                    return null;
                }

                $is_ss = 1;
                if (isset($request->getQueryParams()["is_ss"])) {
                    $is_ss = $request->getQueryParams()["is_ss"];
                }

                $is_mu = 0;
                if (isset($request->getQueryParams()["is_mu"])) {
                    $is_mu = $request->getQueryParams()["is_mu"];
                }

                $newResponse = $response->withHeader('Content-type', ' application/octet-stream; charset=utf-8')->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate')->withHeader('Content-Disposition', ' attachment; filename=allinone.conf');//->getBody()->write($builder->output());
                $newResponse->getBody()->write(LinkController::GetIosConf($user, $is_mu, $is_ss));
                return $newResponse;
            case 3:
                $type = "PROXY";
                break;
            case 7:
                $type = "PROXY";
                break;
            case 6:
                $newResponse = $response->withHeader('Content-type', ' application/octet-stream; charset=utf-8')->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate')->withHeader('Content-Disposition', ' attachment; filename='.$token.'.mobileconfig');//->getBody()->write($builder->output());
                $newResponse->getBody()->write(LinkController::GetApn($Elink->isp, $Elink->address, $Elink->port, User::where("id", "=", $Elink->userid)->first()->pac));
                return $newResponse;
            case 0:
                if ($Elink->geo==0) {
                    $newResponse = $response->withHeader('Content-type', ' application/octet-stream; charset=utf-8')->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate')->withHeader('Content-Disposition', ' attachment; filename='.$token.'.conf');//->getBody()->write($builder->output());
                    $newResponse->getBody()->write(LinkController::GetSurge(User::where("id", "=", $Elink->userid)->first()->passwd, $Elink->method, $Elink->address, $Elink->port, User::where("id", "=", $Elink->userid)->first()->pac));
                    return $newResponse;
                } else {
                    $newResponse = $response->withHeader('Content-type', ' application/octet-stream; charset=utf-8')->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate')->withHeader('Content-Disposition', ' attachment; filename='.$token.'.conf');//->getBody()->write($builder->output());
                    $newResponse->getBody()->write(LinkController::GetSurgeGeo(User::where("id", "=", $Elink->userid)->first()->passwd, $Elink->method, $Elink->address, $Elink->port));
                    return $newResponse;
                }
            case 8:
                if ($Elink->ios==0) {
                    $type = "SOCKS5";
                } else {
                    $type = "SOCKS";
                }
                break;
            case 9:
                $newResponse = $response->withHeader('Content-type', ' application/octet-stream; charset=utf-8')->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate')->withHeader('Content-Disposition', ' attachment; filename='.$token.'.acl');//->getBody()->write($builder->output());
                $newResponse->getBody()->write(LinkController::GetAcl(User::where("id", "=", $Elink->userid)->first()));
                return $newResponse;
            case 10:
                $user=User::where("id", $Elink->userid)->first();
                if ($user == null) {
                    return null;
                }

                $is_ss = 0;
                if (isset($request->getQueryParams()["is_ss"])) {
                    $is_ss = $request->getQueryParams()["is_ss"];
                }

                $newResponse = $response->withHeader('Content-type', ' application/octet-stream; charset=utf-8')->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate')->withHeader('Content-Disposition', ' attachment; filename='.$token.'.sh');//->getBody()->write($builder->output());
                $newResponse->getBody()->write(LinkController::GetRouter(User::where("id", "=", $Elink->userid)->first(), $Elink->geo, $is_ss));
                return $newResponse;
            case 11: // 所有可订阅的链接
                $user=User::where("id", $Elink->userid)->first();
                if ($user == null) {
                    return null;
                }

                $mu = 0;
                if (!empty($request->getQueryParams()["mu"])) {
                    $mu = (int)$request->getQueryParams()["mu"];
                }

                $is_ss = 0;
                if (!empty($request->getQueryParams()["is_ss"])) {
                    $is_ss = (int)$request->getQueryParams()["is_ss"];
                }

                $v = 2;
                if (!empty($request->getQueryParams()["v"])) {
                    $v = (int)$request->getQueryParams()["v"];
                }

                $newResponse = $response->withHeader('Content-type', ' application/octet-stream; charset=utf-8')->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate')->withHeader('Content-Disposition', ' attachment; filename='.$domainname.'.txt');
                $newResponse->getBody()->write(LinkController::GetSub(User::where("id", "=", $Elink->userid)->first(), $mu, $is_ss, $v));
                return $newResponse;
            case 12:
                $user=User::where("id", $Elink->userid)->first();
                if ($user == null) {
                    return null;
                }

                $mu = 0;
                if (!empty($request->getQueryParams()["mu"])) {
                    $mu = (int)$request->getQueryParams()["mu"];
                }

                $query = $request->getQueryParams();
                $cnip = 0;
                if (!empty($query["cnip"])) {
                    $cnip = (int)$query["cnip"];
                }
                if ($cnip == 1) {
                    $domainname .= '-cnip';
                }

                // stream media
                $sm = -1;
                if (isset($query["sm"])) {
                    $sm = (int)$query["sm"];
                }
                switch ($sm) {
                    case 0:
                        $domainname .= '-sm-direct';
                        break;
                    case 1:
                        $domainname .= '-sm-proxy';
                        break;
                    default:
                        break;
                }

                $newResponse = $response->withHeader('Content-type', ' application/octet-stream; charset=utf-8')->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate')->withHeader('Content-Disposition', ' attachment; filename='.$domainname.'.yaml');
                $newResponse->getBody()->write(LinkController::GetClash(User::where("id", "=", $Elink->userid)->first(), $mu, $cnip, $sm));
                return $newResponse;
            case 13:
                $user=User::where("id", $Elink->userid)->first();
                if ($user == null) {
                    return null;
                }

                $newResponse->getBody()->write('');
                return $newResponse;
            case 14:
                $user=User::where("id", $Elink->userid)->first();
                if ($user == null) {
                    return null;
                }

                $newResponse->getBody()->write('');
                return $newResponse;
            default:
                break;
        }
        $newResponse = $response->withHeader('Content-type', ' application/x-ns-proxy-autoconfig; charset=utf-8')->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate');//->getBody()->write($builder->output());
        $newResponse->getBody()->write(LinkController::GetPac($type, $Elink->address, $Elink->port, User::where("id", "=", $Elink->userid)->first()->pac));
        return $newResponse;
    }


    public static function GetGfwlistJs($request, $response, $args)
    {
        $newResponse = $response->withHeader('Content-type', ' application/x-ns-proxy-autoconfig; charset=utf-8')->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate')->withHeader('Content-Disposition', ' attachment; filename=gfwlist.js');
        ;//->getBody()->write($builder->output());
        $newResponse->getBody()->write(LinkController::GetMacPac());
        return $newResponse;
    }

    public static function GetPcConf($user, $is_mu = 0, $is_ss = 0)
    {
        $string='
{
    "index" : 0,
    "random" : false,
    "sysProxyMode" : 0,
    "shareOverLan" : false,
    "bypassWhiteList" : false,
    "localPort" : 1080,
    "localAuthPassword" : "'.Tools::genRandomChar(26).'",
    "dns_server" : "",
    "reconnectTimes" : 4,
    "randomAlgorithm" : 0,
    "TTL" : 60,
    "connect_timeout" : 5,
    "proxyRuleMode" : 1,
    "proxyEnable" : false,
    "pacDirectGoProxy" : false,
    "proxyType" : 0,
    "proxyHost" : "",
    "proxyPort" : 0,
    "proxyAuthUser" : "",
    "proxyAuthPass" : "",
    "proxyUserAgent" : "",
    "authUser" : "",
    "authPass" : "",
    "autoBan" : false,
    "sameHostForSameTarget" : true,
    "keepVisitTime" : 180,
    "isHideTips" : true,
    "token" : {

    },
    "portMap" : {

    }
}
		';


        $json=json_decode($string, true);
        $temparray=array();

        $items = URL::getAllSSRItems($user, $is_mu, $is_ss);
        foreach($items as $item) {
            array_push($temparray, array("remarks"=>$item['remark'],
                                        "server"=>$item['address'],
                                        "server_port"=>$item['port'],
                                        "method"=>$item['method'],
                                        "obfs"=>$item['obfs'],
                                        "obfsparam"=>$item['obfs_param'],
                                        "remarks_base64"=>base64_encode($item['remark']),
                                        "password"=>$item['passwd'],
                                        "tcp_over_udp"=>false,
                                        "udp_over_tcp"=>false,
                                        "group"=>$item['group'],
                                        "protocol"=>$item['protocol'],
                                        "protoparam"=>$item['protocol_param'],
                                        "obfs_udp"=>false,
                                        "enable"=>true));
        }

        $json["configs"]=$temparray;
        return json_encode($json, JSON_PRETTY_PRINT);
    }


    public static function GetIosConf($user, $is_mu = 0, $is_ss = 0)
    {
        $dt = date("Y/m/d H:i:s");
        [$rules, $rules_ip] = LinkController::MakeUserRules($user);
        return '# jiufuni.klutztech.com: '.$dt.'
[General]
bypass-system = true
skip-proxy = 192.168.0.0/16, 10.0.0.0/8, 172.16.0.0/12, localhost, *.local, captive.apple.com
tun-excluded-routes = 10.0.0.0/8, 100.64.0.0/10, 127.0.0.0/8, 169.254.0.0/16, 172.16.0.0/12, 192.0.0.0/24, 192.0.2.0/24, 192.88.99.0/24, 192.168.0.0/16, 198.51.100.0/24, 203.0.113.0/24, 224.0.0.0/4, 255.255.255.255/32, 239.255.255.250/32
dns-server = system
fallback-dns-server = system
ipv6 = true
prefer-ipv6 = false
dns-fallback-system = false
dns-direct-system = false
icmp-auto-reply = true
always-reject-url-rewrite = false
private-ip-answer = true
# direct domain fail to resolve use proxy rule
dns-direct-fallback-proxy = true
# The fallback behavior when UDP traffic matches a policy that doesn\'t support the UDP relay. Possible values: DIRECT, REJECT.
udp-policy-not-supported-behaviour = REJECT

[Rule]
# User Defined
'.implode("\n", $rules).'
# Block HTTP3/QUIC
# AND,((PROTOCOL,UDP),(DEST-PORT,443)),REJECT-NO-DROP
# Baidu/iqiyi
DOMAIN-SUFFIX,baidu.com,DIRECT
DOMAIN-SUFFIX,baidubcr.com,DIRECT
DOMAIN-SUFFIX,bdstatic.com,DIRECT
DOMAIN-SUFFIX,yunjiasu-cdn.net,DIRECT
# Alibaba
DOMAIN-SUFFIX,taobao.com,DIRECT
DOMAIN-SUFFIX,alicdn.com,DIRECT
# Accelerate most visited sites
DOMAIN,blzddist1-a.akamaihd.net,DIRECT
DOMAIN,cdn.angruo.com,DIRECT
DOMAIN,download.jetbrains.com,DIRECT
DOMAIN,file-igamecj.akamaized.net,DIRECT
DOMAIN,images-cn.ssl-images-amazon.com,DIRECT
DOMAIN,officecdn-microsoft-com.akamaized.net,DIRECT
DOMAIN,speedtest.macpaw.com,DIRECT
DOMAIN-SUFFIX,126.net,DIRECT
DOMAIN-SUFFIX,127.net,DIRECT
DOMAIN-SUFFIX,163.com,DIRECT
DOMAIN-SUFFIX,163yun.com,DIRECT
DOMAIN-SUFFIX,21cn.com,DIRECT
DOMAIN-SUFFIX,343480.com,DIRECT
DOMAIN-SUFFIX,360buyimg.com,DIRECT
DOMAIN-SUFFIX,360in.com,DIRECT
DOMAIN-SUFFIX,51ym.me,DIRECT
DOMAIN-SUFFIX,71.am.com,DIRECT
DOMAIN-SUFFIX,8686c.com,DIRECT
DOMAIN-SUFFIX,abchina.com,DIRECT
DOMAIN-SUFFIX,accuweather.com,DIRECT
DOMAIN-SUFFIX,acgvideo.com,DIRECT
DOMAIN-SUFFIX,acm.org,DIRECT
DOMAIN-SUFFIX,acs.org,DIRECT
DOMAIN-SUFFIX,aicoinstorge.com,DIRECT
DOMAIN-SUFFIX,aip.org,DIRECT
DOMAIN-SUFFIX,air-matters.com,DIRECT
DOMAIN-SUFFIX,air-matters.io,DIRECT
DOMAIN-SUFFIX,aixifan.com,DIRECT
DOMAIN-SUFFIX,akadns.net,DIRECT
DOMAIN-SUFFIX,alibaba.com,DIRECT
DOMAIN-SUFFIX,alikunlun.com,DIRECT
DOMAIN-SUFFIX,alipay.com,DIRECT
DOMAIN-SUFFIX,amap.com,DIRECT
DOMAIN-SUFFIX,amd.com,DIRECT
DOMAIN-SUFFIX,ams.org,DIRECT
DOMAIN-SUFFIX,animebytes.tv,DIRECT
DOMAIN-SUFFIX,annualreviews.org,DIRECT
DOMAIN-SUFFIX,aps.org,DIRECT
DOMAIN-SUFFIX,ascelibrary.org,DIRECT
DOMAIN-SUFFIX,asm.org,DIRECT
DOMAIN-SUFFIX,asme.org,DIRECT
DOMAIN-SUFFIX,astm.org,DIRECT
DOMAIN-SUFFIX,autonavi.com,DIRECT
DOMAIN-SUFFIX,awesome-hd.me,DIRECT
DOMAIN-SUFFIX,b612.net,DIRECT
DOMAIN-SUFFIX,baduziyuan.com,DIRECT
DOMAIN-SUFFIX,battle.net,DIRECT
DOMAIN-SUFFIX,bdatu.com,DIRECT
DOMAIN-SUFFIX,beitaichufang.com,DIRECT
DOMAIN-SUFFIX,biliapi.com,DIRECT
DOMAIN-SUFFIX,biliapi.net,DIRECT
DOMAIN-SUFFIX,bilibili.com,DIRECT
DOMAIN-SUFFIX,bilibili.tv,DIRECT
DOMAIN-SUFFIX,bjango.com,DIRECT
DOMAIN-SUFFIX,blizzard.com,DIRECT
DOMAIN-SUFFIX,bmj.com,DIRECT
DOMAIN-SUFFIX,booking.com,DIRECT
DOMAIN-SUFFIX,broadcasthe.net,DIRECT
DOMAIN-SUFFIX,bstatic.com,DIRECT
DOMAIN-SUFFIX,cailianpress.com,DIRECT
DOMAIN-SUFFIX,cambridge.org,DIRECT
DOMAIN-SUFFIX,camera360.com,DIRECT
DOMAIN-SUFFIX,cas.org,DIRECT
DOMAIN-SUFFIX,ccgslb.com,DIRECT
DOMAIN-SUFFIX,ccgslb.net,DIRECT
DOMAIN-SUFFIX,cctv.com,DIRECT
DOMAIN-SUFFIX,cctvpic.com,DIRECT
DOMAIN-SUFFIX,chdbits.co,DIRECT
DOMAIN-SUFFIX,chinanetcenter.com,DIRECT
DOMAIN-SUFFIX,chinaso.com,DIRECT
DOMAIN-SUFFIX,chua.pro,DIRECT
DOMAIN-SUFFIX,chuimg.com,DIRECT
DOMAIN-SUFFIX,chunyu.mobi,DIRECT
DOMAIN-SUFFIX,chushou.tv,DIRECT
DOMAIN-SUFFIX,clarivate.com,DIRECT
DOMAIN-SUFFIX,classix-unlimited.co.uk,DIRECT
DOMAIN-SUFFIX,cmbchina.com,DIRECT
DOMAIN-SUFFIX,cmbimg.com,DIRECT
DOMAIN-SUFFIX,cn,DIRECT
DOMAIN-SUFFIX,com-hs-hkdy.com,DIRECT
DOMAIN-SUFFIX,ctrip.com,DIRECT
DOMAIN-SUFFIX,czybjz.com,DIRECT
DOMAIN-SUFFIX,dandanzan.com,DIRECT
DOMAIN-SUFFIX,dfcfw.com,DIRECT
DOMAIN-SUFFIX,didialift.com,DIRECT
DOMAIN-SUFFIX,didiglobal.com,DIRECT
DOMAIN-SUFFIX,dingtalk.com,DIRECT
DOMAIN-SUFFIX,docschina.org,DIRECT
DOMAIN-SUFFIX,douban.com,DIRECT
DOMAIN-SUFFIX,doubanio.com,DIRECT
DOMAIN-SUFFIX,douyu.com,DIRECT
DOMAIN-SUFFIX,duokan.com,DIRECT
DOMAIN-SUFFIX,dxycdn.com,DIRECT
DOMAIN-SUFFIX,dytt8.net,DIRECT
DOMAIN-SUFFIX,eastmoney.com,DIRECT
DOMAIN-SUFFIX,ebscohost.com,DIRECT
DOMAIN-SUFFIX,emerald.com,DIRECT
DOMAIN-SUFFIX,empornium.me,DIRECT
DOMAIN-SUFFIX,engineeringvillage.com,DIRECT
DOMAIN-SUFFIX,eudic.net,DIRECT
DOMAIN-SUFFIX,feiliao.com,DIRECT
DOMAIN-SUFFIX,feng.com,DIRECT
DOMAIN-SUFFIX,fengkongcloud.com,DIRECT
DOMAIN-SUFFIX,fjhps.com,DIRECT
DOMAIN-SUFFIX,frdic.com,DIRECT
DOMAIN-SUFFIX,futu5.com,DIRECT
DOMAIN-SUFFIX,futunn.com,DIRECT
DOMAIN-SUFFIX,gandi.net,DIRECT
DOMAIN-SUFFIX,gazellegames.net,DIRECT
DOMAIN-SUFFIX,geilicdn.com,DIRECT
DOMAIN-SUFFIX,getpricetag.com,DIRECT
DOMAIN-SUFFIX,gifshow.com,DIRECT
DOMAIN-SUFFIX,godic.net,DIRECT
DOMAIN-SUFFIX,gtimg.com,DIRECT
DOMAIN-SUFFIX,hdbits.org,DIRECT
DOMAIN-SUFFIX,hdchina.org,DIRECT
DOMAIN-SUFFIX,hdhome.org,DIRECT
DOMAIN-SUFFIX,hdsky.me,DIRECT
DOMAIN-SUFFIX,hdslb.com,DIRECT
DOMAIN-SUFFIX,hicloud.com,DIRECT
DOMAIN-SUFFIX,hitv.com,DIRECT
DOMAIN-SUFFIX,hongxiu.com,DIRECT
DOMAIN-SUFFIX,hostbuf.com,DIRECT
DOMAIN-SUFFIX,huxiucdn.com,DIRECT
DOMAIN-SUFFIX,huya.com,DIRECT
DOMAIN-SUFFIX,icetorrent.org,DIRECT
DOMAIN-SUFFIX,icevirtuallibrary.com,DIRECT
DOMAIN-SUFFIX,iciba.com,DIRECT
DOMAIN-SUFFIX,idqqimg.com,DIRECT
DOMAIN-SUFFIX,ieee.org,DIRECT
DOMAIN-SUFFIX,iesdouyin.com,DIRECT
DOMAIN-SUFFIX,igamecj.com,DIRECT
DOMAIN-SUFFIX,imf.org,DIRECT
DOMAIN-SUFFIX,infinitynewtab.com,DIRECT
DOMAIN-SUFFIX,iop.org,DIRECT
DOMAIN-SUFFIX,ip-cdn.com,DIRECT
DOMAIN-SUFFIX,ip.la,DIRECT
DOMAIN-SUFFIX,ipip.net,DIRECT
DOMAIN-SUFFIX,ipv6-test.com,DIRECT
DOMAIN-SUFFIX,iqiyi.com,DIRECT
DOMAIN-SUFFIX,iqiyipic.com,DIRECT
DOMAIN-SUFFIX,ithome.com,DIRECT
DOMAIN-SUFFIX,jamanetwork.com,DIRECT
DOMAIN-SUFFIX,java.com,DIRECT
DOMAIN-SUFFIX,jd.com,DIRECT
DOMAIN-SUFFIX,jd.hk,DIRECT
DOMAIN-SUFFIX,jdpay.com,DIRECT
DOMAIN-SUFFIX,jhu.edu,DIRECT
DOMAIN-SUFFIX,jidian.im,DIRECT
DOMAIN-SUFFIX,jpopsuki.eu,DIRECT
DOMAIN-SUFFIX,jstor.org,DIRECT
DOMAIN-SUFFIX,jstucdn.com,DIRECT
DOMAIN-SUFFIX,kaiyanapp.com,DIRECT
DOMAIN-SUFFIX,karger.com,DIRECT
DOMAIN-SUFFIX,kaspersky-labs.com,DIRECT
DOMAIN-SUFFIX,keepcdn.com,DIRECT
DOMAIN-SUFFIX,keepfrds.com,DIRECT
DOMAIN-SUFFIX,kkmh.com,DIRECT
DOMAIN-SUFFIX,ksosoft.com,DIRECT
DOMAIN-SUFFIX,kuyunbo.club,DIRECT
DOMAIN-SUFFIX,libguides.com,DIRECT
DOMAIN-SUFFIX,livechina.com,DIRECT
DOMAIN-SUFFIX,lofter.com,DIRECT
DOMAIN-SUFFIX,loli.net,DIRECT
DOMAIN-SUFFIX,luojilab.com,DIRECT
DOMAIN-SUFFIX,m-team.cc,DIRECT
DOMAIN-SUFFIX,madsrevolution.net,DIRECT
DOMAIN-SUFFIX,maoyan.com,DIRECT
DOMAIN-SUFFIX,maoyun.tv,DIRECT
DOMAIN-SUFFIX,meipai.com,DIRECT
DOMAIN-SUFFIX,meitu.com,DIRECT
DOMAIN-SUFFIX,meituan.com,DIRECT
DOMAIN-SUFFIX,meituan.net,DIRECT
DOMAIN-SUFFIX,meitudata.com,DIRECT
DOMAIN-SUFFIX,meitustat.com,DIRECT
DOMAIN-SUFFIX,meixincdn.com,DIRECT
DOMAIN-SUFFIX,mgtv.com,DIRECT
DOMAIN-SUFFIX,mi-img.com,DIRECT
DOMAIN-SUFFIX,microsoft.com,DIRECT
DOMAIN-SUFFIX,miui.com,DIRECT
DOMAIN-SUFFIX,miwifi.com,DIRECT
DOMAIN-SUFFIX,mobike.com,DIRECT
DOMAIN-SUFFIX,moke.com,DIRECT
DOMAIN-SUFFIX,morethan.tv,DIRECT
DOMAIN-SUFFIX,mpg.de,DIRECT
DOMAIN-SUFFIX,msecnd.net,DIRECT
DOMAIN-SUFFIX,mubu.com,DIRECT
DOMAIN-SUFFIX,mxhichina.com,DIRECT
DOMAIN-SUFFIX,myanonamouse.net,DIRECT
DOMAIN-SUFFIX,myapp.com,DIRECT
DOMAIN-SUFFIX,myilibrary.com,DIRECT
DOMAIN-SUFFIX,myqcloud.com,DIRECT
DOMAIN-SUFFIX,myzaker.com,DIRECT
DOMAIN-SUFFIX,nanyangpt.com,DIRECT
DOMAIN-SUFFIX,nature.com,DIRECT
DOMAIN-SUFFIX,ncore.cc,DIRECT
DOMAIN-SUFFIX,netease.com,DIRECT
DOMAIN-SUFFIX,netspeedtestmaster.com,DIRECT
DOMAIN-SUFFIX,nim-lang-cn.org,DIRECT
DOMAIN-SUFFIX,nvidia.com,DIRECT
DOMAIN-SUFFIX,oecd-ilibrary.org,DIRECT
DOMAIN-SUFFIX,office365.com,DIRECT
DOMAIN-SUFFIX,open.cd,DIRECT
DOMAIN-SUFFIX,oracle.com,DIRECT
DOMAIN-SUFFIX,osapublishing.org,DIRECT
DOMAIN-SUFFIX,oup.com,DIRECT
DOMAIN-SUFFIX,ourbits.club,DIRECT
DOMAIN-SUFFIX,ourdvs.com,DIRECT
DOMAIN-SUFFIX,outlook.com,DIRECT
DOMAIN-SUFFIX,ovid.com,DIRECT
DOMAIN-SUFFIX,oxfordartonline.com,DIRECT
DOMAIN-SUFFIX,oxfordbibliographies.com,DIRECT
DOMAIN-SUFFIX,oxfordmusiconline.com,DIRECT
DOMAIN-SUFFIX,passthepopcorn.me,DIRECT
DOMAIN-SUFFIX,paypal.com,DIRECT
DOMAIN-SUFFIX,paypalobjects.com,DIRECT
DOMAIN-SUFFIX,pnas.org,DIRECT
DOMAIN-SUFFIX,privatehd.to,DIRECT
DOMAIN-SUFFIX,proquest.com,DIRECT
DOMAIN-SUFFIX,pstatp.com,DIRECT
DOMAIN-SUFFIX,pterclub.com,DIRECT
DOMAIN-SUFFIX,qdaily.com,DIRECT
DOMAIN-SUFFIX,qhimg.com,DIRECT
DOMAIN-SUFFIX,qhres.com,DIRECT
DOMAIN-SUFFIX,qidian.com,DIRECT
DOMAIN-SUFFIX,qq.com,DIRECT
DOMAIN-SUFFIX,wechat.com,DIRECT
DOMAIN-SUFFIX,dns.pub,DIRECT
DOMAIN-SUFFIX,doh.pub,DIRECT
DOMAIN-SUFFIX,qyer.com,DIRECT
DOMAIN-SUFFIX,qyerstatic.com,DIRECT
DOMAIN-SUFFIX,raychase.net,DIRECT
DOMAIN-SUFFIX,redacted.ch,DIRECT
DOMAIN-SUFFIX,ronghub.com,DIRECT
DOMAIN-SUFFIX,rsc.org,DIRECT
DOMAIN-SUFFIX,ruguoapp.com,DIRECT
DOMAIN-SUFFIX,s-microsoft.com,DIRECT
DOMAIN-SUFFIX,s-reader.com,DIRECT
DOMAIN-SUFFIX,sagepub.com,DIRECT
DOMAIN-SUFFIX,sankuai.com,DIRECT
DOMAIN-SUFFIX,sciencedirect.com,DIRECT
DOMAIN-SUFFIX,sciencemag.org,DIRECT
DOMAIN-SUFFIX,scomper.me,DIRECT
DOMAIN-SUFFIX,scopus.com,DIRECT
DOMAIN-SUFFIX,seafile.com,DIRECT
DOMAIN-SUFFIX,servicewechat.com,DIRECT
DOMAIN-SUFFIX,siam.org,DIRECT
DOMAIN-SUFFIX,sina.com,DIRECT
DOMAIN-SUFFIX,sm.ms,DIRECT
DOMAIN-SUFFIX,smzdm.com,DIRECT
DOMAIN-SUFFIX,snapdrop.net,DIRECT
DOMAIN-SUFFIX,snssdk.com,DIRECT
DOMAIN-SUFFIX,snwx.com,DIRECT
DOMAIN-SUFFIX,sogo.com,DIRECT
DOMAIN-SUFFIX,sogou.com,DIRECT
DOMAIN-SUFFIX,sogoucdn.com,DIRECT
DOMAIN-SUFFIX,sohu-inc.com,DIRECT
DOMAIN-SUFFIX,sohu.com,DIRECT
DOMAIN-SUFFIX,sohucs.com,DIRECT
DOMAIN-SUFFIX,soku.com,DIRECT
DOMAIN-SUFFIX,spiedigitallibrary.org,DIRECT
DOMAIN-SUFFIX,springer.com,DIRECT
DOMAIN-SUFFIX,springerlink.com,DIRECT
DOMAIN-SUFFIX,springsunday.net,DIRECT
DOMAIN-SUFFIX,sspai.com,DIRECT
DOMAIN-SUFFIX,staticdn.net,DIRECT
DOMAIN-SUFFIX,steam-chat.com,DIRECT
DOMAIN-SUFFIX,steamcdn-a.akamaihd.net,DIRECT
DOMAIN-SUFFIX,steamcontent.com,DIRECT
DOMAIN-SUFFIX,steamgames.com,DIRECT
DOMAIN-SUFFIX,steampowered.com,DIRECT
DOMAIN-SUFFIX,steamstat.us,DIRECT
DOMAIN-SUFFIX,steamstatic.com,DIRECT
DOMAIN-SUFFIX,steamusercontent.com,DIRECT
DOMAIN-SUFFIX,takungpao.com,DIRECT
DOMAIN-SUFFIX,tandfonline.com,DIRECT
DOMAIN-SUFFIX,teamviewer.com,DIRECT
DOMAIN-SUFFIX,tencent-cloud.net,DIRECT
DOMAIN-SUFFIX,tencent.com,DIRECT
DOMAIN-SUFFIX,tenpay.com,DIRECT
DOMAIN-SUFFIX,test-ipv6.com,DIRECT
DOMAIN-SUFFIX,tianyancha.com,DIRECT
DOMAIN-SUFFIX,tjupt.org,DIRECT
DOMAIN-SUFFIX,tmall.com,DIRECT
DOMAIN-SUFFIX,tmall.hk,DIRECT
DOMAIN-SUFFIX,totheglory.im,DIRECT
DOMAIN-SUFFIX,toutiao.com,DIRECT
DOMAIN-SUFFIX,udache.com,DIRECT
DOMAIN-SUFFIX,udacity.com,DIRECT
DOMAIN-SUFFIX,un.org,DIRECT
DOMAIN-SUFFIX,uni-bielefeld.de,DIRECT
DOMAIN-SUFFIX,uning.com,DIRECT
DOMAIN-SUFFIX,v-56.com,DIRECT
DOMAIN-SUFFIX,visualstudio.com,DIRECT
DOMAIN-SUFFIX,vmware.com,DIRECT
DOMAIN-SUFFIX,wangsu.com,DIRECT
DOMAIN-SUFFIX,weather.com,DIRECT
DOMAIN-SUFFIX,webofknowledge.com,DIRECT
DOMAIN-SUFFIX,wechat.com,DIRECT
DOMAIN-SUFFIX,weibo.com,DIRECT
DOMAIN-SUFFIX,weibocdn.com,DIRECT
DOMAIN-SUFFIX,weico.cc,DIRECT
DOMAIN-SUFFIX,weidian.com,DIRECT
DOMAIN-SUFFIX,westlaw.com,DIRECT
DOMAIN-SUFFIX,whatismyip.com,DIRECT
DOMAIN-SUFFIX,wiley.com,DIRECT
DOMAIN-SUFFIX,windows.com,DIRECT
DOMAIN-SUFFIX,windowsupdate.com,DIRECT
DOMAIN-SUFFIX,worldbank.org,DIRECT
DOMAIN-SUFFIX,worldscientific.com,DIRECT
DOMAIN-SUFFIX,xiachufang.com,DIRECT
DOMAIN-SUFFIX,xiami.com,DIRECT
DOMAIN-SUFFIX,xiami.net,DIRECT
DOMAIN-SUFFIX,xiaomi.com,DIRECT
DOMAIN-SUFFIX,xiaohongshu.com,DIRECT
DOMAIN-SUFFIX,xhscdn.com,DIRECT
DOMAIN-SUFFIX,ximalaya.com,DIRECT
DOMAIN-SUFFIX,xinhuanet.com,DIRECT
DOMAIN-SUFFIX,xmcdn.com,DIRECT
DOMAIN-SUFFIX,yangkeduo.com,DIRECT
DOMAIN-SUFFIX,ydstatic.com,DIRECT
DOMAIN-SUFFIX,youku.com,DIRECT
DOMAIN-SUFFIX,zhangzishi.cc,DIRECT
DOMAIN-SUFFIX,zhihu.com,DIRECT
DOMAIN-SUFFIX,zhimg.com,DIRECT
DOMAIN-SUFFIX,zhuihd.com,DIRECT
DOMAIN-SUFFIX,zimuzu.io,DIRECT
DOMAIN-SUFFIX,zimuzu.tv,DIRECT
DOMAIN-SUFFIX,zmz2019.com,DIRECT
DOMAIN-SUFFIX,zmzapi.com,DIRECT
DOMAIN-SUFFIX,zmzapi.net,DIRECT
DOMAIN-SUFFIX,zmzfile.com,DIRECT
DOMAIN-SUFFIX,manmanbuy.com,DIRECT
# Remove these lines below if you don\'t have trouble accessing Apple resources
DOMAIN,www-cdn.icloud.com.akadns.net,DIRECT
DOMAIN-SUFFIX,aaplimg.com,DIRECT
DOMAIN-SUFFIX,apple-cloudkit.com,DIRECT
DOMAIN-SUFFIX,apple.co,DIRECT
DOMAIN-SUFFIX,apple.com,DIRECT
DOMAIN-SUFFIX,apple.news,DIRECT
DOMAIN-SUFFIX,apple.com.cn,DIRECT
DOMAIN-SUFFIX,appstore.com,DIRECT
DOMAIN-SUFFIX,cdn-apple.com,DIRECT
DOMAIN-SUFFIX,crashlytics.com,DIRECT
DOMAIN-SUFFIX,icloud-content.com,DIRECT
DOMAIN-SUFFIX,icloud.com,DIRECT
DOMAIN-SUFFIX,icloud.com.cn,DIRECT
DOMAIN-SUFFIX,me.com,DIRECT
DOMAIN-SUFFIX,mzstatic.com,DIRECT
# LINE
DOMAIN-SUFFIX,scdn.co,PROXY
DOMAIN-SUFFIX,line.naver.jp,PROXY
DOMAIN-SUFFIX,line.me,PROXY
DOMAIN-SUFFIX,line-apps.com,PROXY
DOMAIN-SUFFIX,line-cdn.net,PROXY
DOMAIN-SUFFIX,line-scdn.net,PROXY
USER-AGENT,Line*,PROXY
# Google
DOMAIN-KEYWORD,blogspot,PROXY
DOMAIN-KEYWORD,google,PROXY
DOMAIN-SUFFIX,abc.xyz,PROXY
DOMAIN-SUFFIX,admin.recaptcha.net,PROXY
DOMAIN-SUFFIX,ampproject.org,PROXY
DOMAIN-SUFFIX,android.com,PROXY
DOMAIN-SUFFIX,androidify.com,PROXY
DOMAIN-SUFFIX,appspot.com,PROXY
DOMAIN-SUFFIX,autodraw.com,PROXY
DOMAIN-SUFFIX,blogger.com,PROXY
DOMAIN-SUFFIX,capitalg.com,PROXY
DOMAIN-SUFFIX,certificate-transparency.org,PROXY
DOMAIN-SUFFIX,chrome.com,PROXY
DOMAIN-SUFFIX,chromeexperiments.com,PROXY
DOMAIN-SUFFIX,chromestatus.com,PROXY
DOMAIN-SUFFIX,chromium.org,PROXY
DOMAIN-SUFFIX,creativelab5.com,PROXY
DOMAIN-SUFFIX,debug.com,PROXY
DOMAIN-SUFFIX,deepmind.com,PROXY
DOMAIN-SUFFIX,dialogflow.com,PROXY
DOMAIN-SUFFIX,firebaseio.com,PROXY
DOMAIN-SUFFIX,getmdl.io,PROXY
DOMAIN-SUFFIX,getoutline.org,PROXY
DOMAIN-SUFFIX,ggpht.com,PROXY
DOMAIN-SUFFIX,gmail.com,PROXY
DOMAIN-SUFFIX,gmodules.com,PROXY
DOMAIN-SUFFIX,godoc.org,PROXY
DOMAIN-SUFFIX,golang.org,PROXY
DOMAIN-SUFFIX,gstatic.com,PROXY
DOMAIN-SUFFIX,gv.com,PROXY
DOMAIN-SUFFIX,gvt0.com,PROXY
DOMAIN-SUFFIX,gvt1.com,PROXY
DOMAIN-SUFFIX,gvt3.com,PROXY
DOMAIN-SUFFIX,gwtproject.org,PROXY
DOMAIN-SUFFIX,itasoftware.com,PROXY
DOMAIN-SUFFIX,madewithcode.com,PROXY
DOMAIN-SUFFIX,material.io,PROXY
DOMAIN-SUFFIX,polymer-project.org,PROXY
DOMAIN-SUFFIX,recaptcha.net,PROXY
DOMAIN-SUFFIX,shattered.io,PROXY
DOMAIN-SUFFIX,synergyse.com,PROXY
DOMAIN-SUFFIX,telephony.goog,PROXY
DOMAIN-SUFFIX,tensorflow.org,PROXY
DOMAIN-SUFFIX,tfhub.dev,PROXY
DOMAIN-SUFFIX,tiltbrush.com,PROXY
DOMAIN-SUFFIX,waveprotocol.org,PROXY
DOMAIN-SUFFIX,waymo.com,PROXY
DOMAIN-SUFFIX,webmproject.org,PROXY
DOMAIN-SUFFIX,webrtc.org,PROXY
DOMAIN-SUFFIX,whatbrowser.org,PROXY
DOMAIN-SUFFIX,widevine.com,PROXY
DOMAIN-SUFFIX,x.company,PROXY
DOMAIN-SUFFIX,xn--ngstr-lra8j.com,PROXY
DOMAIN-SUFFIX,youtu.be,PROXY
DOMAIN-SUFFIX,yt.be,PROXY
DOMAIN-SUFFIX,ytimg.com,PROXY
# Clubhouse
DOMAIN-SUFFIX,clubhouseapi.com,PROXY
DOMAIN-SUFFIX,clubhouse.pubnub.com,PROXY
DOMAIN-SUFFIX,joinclubhouse.com,PROXY
DOMAIN-SUFFIX,ap3.agora.io,PROXY
# Top blocked sites
DOMAIN-KEYWORD,aka,PROXY
DOMAIN-KEYWORD,facebook,PROXY
DOMAIN-KEYWORD,youtube,PROXY
DOMAIN-KEYWORD,twitter,PROXY
DOMAIN-KEYWORD,instagram,PROXY
DOMAIN-KEYWORD,gmail,PROXY
DOMAIN-KEYWORD,pixiv,PROXY
DOMAIN-SUFFIX,fb.com,PROXY
DOMAIN-SUFFIX,meta.com,PROXY
DOMAIN-SUFFIX,twimg.com,PROXY
DOMAIN-SUFFIX,t.co,PROXY
DOMAIN-SUFFIX,kenengba.com,PROXY
DOMAIN-SUFFIX,akamai.net,PROXY
DOMAIN-SUFFIX,whatsapp.net,PROXY
DOMAIN-SUFFIX,whatsapp.com,PROXY
DOMAIN-SUFFIX,snapchat.com,PROXY
DOMAIN-SUFFIX,amazonaws.com,PROXY
DOMAIN-SUFFIX,angularjs.org,PROXY
DOMAIN-SUFFIX,akamaihd.net,PROXY
DOMAIN-SUFFIX,amazon.com,PROXY
DOMAIN-SUFFIX,bit.ly,PROXY
DOMAIN-SUFFIX,bitbucket.org,PROXY
DOMAIN-SUFFIX,blog.com,PROXY
DOMAIN-SUFFIX,blogcdn.com,PROXY
DOMAIN-SUFFIX,blogsmithmedia.com,PROXY
DOMAIN-SUFFIX,box.net,PROXY
DOMAIN-SUFFIX,bloomberg.com,PROXY
DOMAIN-SUFFIX,cl.ly,PROXY
DOMAIN-SUFFIX,cloudfront.net,PROXY
DOMAIN-SUFFIX,cloudflare.com,PROXY
DOMAIN-SUFFIX,cocoapods.org,PROXY
DOMAIN-SUFFIX,dribbble.com,PROXY
DOMAIN-SUFFIX,dropbox.com,PROXY
DOMAIN-SUFFIX,dropboxstatic.com,PROXY
DOMAIN-SUFFIX,dropboxusercontent.com,PROXY
DOMAIN-SUFFIX,docker.com,PROXY
DOMAIN-SUFFIX,duckduckgo.com,PROXY
DOMAIN-SUFFIX,digicert.com,PROXY
DOMAIN-SUFFIX,dnsimple.com,PROXY
DOMAIN-SUFFIX,edgecastcdn.net,PROXY
DOMAIN-SUFFIX,engadget.com,PROXY
DOMAIN-SUFFIX,eurekavpt.com,PROXY
DOMAIN-SUFFIX,fb.me,PROXY
DOMAIN-SUFFIX,fbcdn.net,PROXY
DOMAIN-SUFFIX,fc2.com,PROXY
DOMAIN-SUFFIX,feedburner.com,PROXY
DOMAIN-SUFFIX,fabric.io,PROXY
DOMAIN-SUFFIX,flickr.com,PROXY
DOMAIN-SUFFIX,fastly.net,PROXY
DOMAIN-SUFFIX,github.com,PROXY
DOMAIN-SUFFIX,github.io,PROXY
DOMAIN-SUFFIX,githubusercontent.com,PROXY
DOMAIN-SUFFIX,goo.gl,PROXY
DOMAIN-SUFFIX,godaddy.com,PROXY
DOMAIN-SUFFIX,gravatar.com,PROXY
DOMAIN-SUFFIX,imageshack.us,PROXY
DOMAIN-SUFFIX,imgur.com,PROXY
DOMAIN-SUFFIX,jshint.com,PROXY
DOMAIN-SUFFIX,ift.tt,PROXY
DOMAIN-SUFFIX,j.mp,PROXY
DOMAIN-SUFFIX,kat.cr,PROXY
DOMAIN-SUFFIX,linode.com,PROXY
DOMAIN-SUFFIX,lithium.com,PROXY
DOMAIN-SUFFIX,megaupload.com,PROXY
DOMAIN-SUFFIX,mobile01.com,PROXY
DOMAIN-SUFFIX,modmyi.com,PROXY
DOMAIN-SUFFIX,nytimes.com,PROXY
DOMAIN-SUFFIX,name.com,PROXY
DOMAIN-SUFFIX,openvpn.net,PROXY
DOMAIN-SUFFIX,openwrt.org,PROXY
DOMAIN-SUFFIX,ow.ly,PROXY
DOMAIN-SUFFIX,pinboard.in,PROXY
DOMAIN-SUFFIX,ssl-images-amazon.com,PROXY
DOMAIN-SUFFIX,sstatic.net,PROXY
DOMAIN-SUFFIX,stackoverflow.com,PROXY
DOMAIN-SUFFIX,staticflickr.com,PROXY
DOMAIN-SUFFIX,squarespace.com,PROXY
DOMAIN-SUFFIX,symcd.com,PROXY
DOMAIN-SUFFIX,symcb.com,PROXY
DOMAIN-SUFFIX,symauth.com,PROXY
DOMAIN-SUFFIX,ubnt.com,PROXY
DOMAIN-SUFFIX,thepiratebay.org,PROXY
DOMAIN-SUFFIX,tumblr.com,PROXY
DOMAIN-SUFFIX,twitch.tv,PROXY
DOMAIN-SUFFIX,twitter.com,PROXY
DOMAIN-SUFFIX,wikipedia.com,PROXY
DOMAIN-SUFFIX,wikipedia.org,PROXY
DOMAIN-SUFFIX,wikimedia.org,PROXY
DOMAIN-SUFFIX,wordpress.com,PROXY
DOMAIN-SUFFIX,wsj.com,PROXY
DOMAIN-SUFFIX,wsj.net,PROXY
DOMAIN-SUFFIX,wp.com,PROXY
DOMAIN-SUFFIX,vimeo.com,PROXY
DOMAIN-SUFFIX,tapbots.com,PROXY
DOMAIN-SUFFIX,ykimg.com,DIRECT
DOMAIN-SUFFIX,medium.com,PROXY
DOMAIN-SUFFIX,fast.com,PROXY
DOMAIN-SUFFIX,nflxvideo.net,PROXY
DOMAIN-SUFFIX,linkedin.com,PROXY
DOMAIN-SUFFIX,licdn.com,PROXY
DOMAIN-SUFFIX,bing.com,PROXY
# SoundCloud
DOMAIN-SUFFIX,soundcloud.com,PROXY
DOMAIN-SUFFIX,sndcdn.com,PROXY
# DNS Leak
DOMAIN-SUFFIX,dnsleaktest.com,PROXY
DOMAIN-SUFFIX,dnsleak.com,PROXY
DOMAIN-SUFFIX,expressvpn.com,PROXY
DOMAIN-SUFFIX,nordvpn.com,PROXY
DOMAIN-SUFFIX,surfshark.com,PROXY
DOMAIN-SUFFIX,ipleak.net,PROXY
DOMAIN-SUFFIX,perfect-privacy.com,PROXY
DOMAIN-SUFFIX,browserleaks.com,PROXY
DOMAIN-SUFFIX,browserleaks.org,PROXY
DOMAIN-SUFFIX,vpnunlimited.com,PROXY
DOMAIN-SUFFIX,whoer.net,PROXY
DOMAIN-SUFFIX,whrq.net,PROXY
# Telegram
DOMAIN-SUFFIX,t.me,PROXY
DOMAIN-SUFFIX,tdesktop.com,PROXY
DOMAIN-SUFFIX,telegra.ph,PROXY
DOMAIN-SUFFIX,telegram.me,PROXY
DOMAIN-SUFFIX,telegram.org,PROXY
DOMAIN-SUFFIX,telesco.pe,PROXY
IP-CIDR,91.108.4.0/22,PROXY,no-resolve
IP-CIDR,91.108.8.0/22,PROXY,no-resolve
IP-CIDR,91.108.12.0/22,PROXY,no-resolve
IP-CIDR,91.108.16.0/22,PROXY,no-resolve
IP-CIDR,91.108.56.0/22,PROXY,no-resolve
IP-CIDR,109.239.140.0/24,PROXY,no-resolve
IP-CIDR,149.154.160.0/20,PROXY,no-resolve
IP-CIDR,2001:B28:F23D::/48,PROXY,no-resolve
IP-CIDR,2001:B28:F23F::/48,PROXY,no-resolve
IP-CIDR,2001:67C:4E8::/48,PROXY,no-resolve
# User Defined IPs
'.implode("\n", $rules_ip).'
# LAN
IP-CIDR,192.168.0.0/16,DIRECT
IP-CIDR,10.0.0.0/8,DIRECT
IP-CIDR,172.16.0.0/12,DIRECT
IP-CIDR,127.0.0.0/8,DIRECT
# China
GEOIP,CN,DIRECT
# Final
FINAL,PROXY

[Host]
localhost = 127.0.0.1

[URL Rewrite]
^https?://(www.)?g.cn https://www.google.com 302
^https?://(www.)?google.cn https://www.google.com 302
';
    }

    private static function GetSurge($passwd, $method, $server, $port, $defined)
    {
        $rulelist = base64_decode(file_get_contents("https://raw.githubusercontent.com/gfwlist/gfwlist/master/gfwlist.txt"))."\n".$defined;
        $gfwlist = explode("\n", $rulelist);

        $count = 0;
        $pac_content = '';
        $find_function_content = '
[General]
skip-proxy = 192.168.0.0/16, 10.0.0.0/8, 172.16.0.0/12, localhost, *.local
bypass-tun = 192.168.0.0/16, 10.0.0.0/8, 172.16.0.0/12
dns-server = 119.29.29.29, 223.5.5.5, 114.114.114.114
loglevel = notify

[Proxy]
Proxy = custom,'.$server.','.$port.','.$method.','.$passwd.','.Config::get('baseUrl').'/downloads/SSEncrypt.module

[Rule]
DOMAIN-KEYWORD,adsmogo,REJECT
DOMAIN-SUFFIX,acs86.com,REJECT
DOMAIN-SUFFIX,adcome.cn,REJECT
DOMAIN-SUFFIX,adinfuse.com,REJECT
DOMAIN-SUFFIX,admaster.com.cn,REJECT
DOMAIN-SUFFIX,admob.com,REJECT
DOMAIN-SUFFIX,adsage.cn,REJECT
DOMAIN-SUFFIX,adsage.com,REJECT
DOMAIN-SUFFIX,adsmogo.org,REJECT
DOMAIN-SUFFIX,ads.mobclix.com,REJECT
DOMAIN-SUFFIX,adview.cn,REJECT
DOMAIN-SUFFIX,adwhirl.com,REJECT
DOMAIN-SUFFIX,adwo.com,REJECT
DOMAIN-SUFFIX,appads.com,REJECT
DOMAIN-SUFFIX,domob.cn,REJECT
DOMAIN-SUFFIX,domob.com.cn,REJECT
DOMAIN-SUFFIX,domob.org,REJECT
DOMAIN-SUFFIX,doubleclick.net,REJECT
DOMAIN-SUFFIX,duomeng.cn,REJECT
DOMAIN-SUFFIX,duomeng.net,REJECT
DOMAIN-SUFFIX,duomeng.org,REJECT
DOMAIN-SUFFIX,googeadsserving.cn,REJECT
DOMAIN-SUFFIX,guomob.com,REJECT
DOMAIN-SUFFIX,immob.cn,REJECT
DOMAIN-SUFFIX,inmobi.com,REJECT
DOMAIN-SUFFIX,mobads.baidu.com,REJECT
DOMAIN-SUFFIX,mobads-logs.baidu.com,REJECT
DOMAIN-SUFFIX,smartadserver.com,REJECT
DOMAIN-SUFFIX,tapjoyads.com,REJECT
DOMAIN-SUFFIX,umeng.co,REJECT
DOMAIN-SUFFIX,umeng.com,REJECT
DOMAIN-SUFFIX,umtrack.com,REJECT
DOMAIN-SUFFIX,uyunad.com,REJECT
DOMAIN-SUFFIX,youmi.net,REJECT'."\n";
        $isget=array();
        foreach ($gfwlist as $index=>$rule) {
            if (empty($rule)) {
                continue;
            } elseif (substr($rule, 0, 1) == '!' || substr($rule, 0, 1) == '[') {
                continue;
            }

            if (substr($rule, 0, 2) == '@@') {
                // ||开头表示前面还有路径
                if (substr($rule, 2, 2) =='||') {
                    //$rule_reg = preg_match("/^((http|https):\/\/)?([^\/]+)/i",substr($rule, 2), $matches);
                    $host = substr($rule, 4);
                    //preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
                    if (isset($isget[$host])) {
                        continue;
                    }
                    $isget[$host]=1;
                    $find_function_content.="DOMAIN,".$host.",DIRECT,force-remote-dns\n";
                    continue;
                // !开头相当于正则表达式^
                } elseif (substr($rule, 2, 1) == '|') {
                    preg_match("/(\d{1,3}\.){3}\d{1,3}/", substr($rule, 3), $matches);
                    if (!isset($matches[0])) {
                        continue;
                    }

                    $host = $matches[0];
                    if ($host != "") {
                        if (isset($isget[$host])) {
                            continue;
                        }
                        $isget[$host]=1;
                        $find_function_content.="IP-CIDR,".$host."/32,DIRECT,no-resolve \n";
                        continue;
                    } else {
                        preg_match_all("~^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?~i", substr($rule, 3), $matches);

                        if (!isset($matches[4][0])) {
                            continue;
                        }

                        $host = $matches[4][0];
                        if ($host != "") {
                            if (isset($isget[$host])) {
                                continue;
                            }
                            $isget[$host]=1;
                            $find_function_content.="DOMAIN-SUFFIX,".$host.",DIRECT,force-remote-dns\n";
                            continue;
                        }
                    }
                } elseif (substr($rule, 2, 1) == '.') {
                    $host = substr($rule, 3);
                    if ($host != "") {
                        if (isset($isget[$host])) {
                            continue;
                        }
                        $isget[$host]=1;
                        $find_function_content.="DOMAIN-SUFFIX,".$host.",DIRECT,force-remote-dns \n";
                        continue;
                    }
                }
            }

            // ||开头表示前面还有路径
            if (substr($rule, 0, 2) =='||') {
                //$rule_reg = preg_match("/^((http|https):\/\/)?([^\/]+)/i",substr($rule, 2), $matches);
                $host = substr($rule, 2);
                //preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);

                if (strpos($host, "*")!==false) {
                    $host = substr($host, strpos($host, "*")+1);
                    if (strpos($host, ".")!==false) {
                        $host = substr($host, strpos($host, ".")+1);
                    }
                    if (isset($isget[$host])) {
                        continue;
                    }
                    $isget[$host]=1;
                    $find_function_content.="DOMAIN-KEYWORD,".$host.",Proxy,force-remote-dns\n";
                    continue;
                }

                if (isset($isget[$host])) {
                    continue;
                }
                $isget[$host]=1;
                $find_function_content.="DOMAIN,".$host.",Proxy,force-remote-dns\n";
            // !开头相当于正则表达式^
            } elseif (substr($rule, 0, 1) == '|') {
                preg_match("/(\d{1,3}\.){3}\d{1,3}/", substr($rule, 1), $matches);

                if (!isset($matches[0])) {
                    continue;
                }

                $host = $matches[0];
                if ($host != "") {
                    if (isset($isget[$host])) {
                        continue;
                    }
                    $isget[$host]=1;
                    $find_function_content.="IP-CIDR,".$host."/32,Proxy,no-resolve \n";
                    continue;
                } else {
                    preg_match_all("~^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?~i", substr($rule, 1), $matches);

                    if (!isset($matches[4][0])) {
                        continue;
                    }

                    $host = $matches[4][0];
                    if (strpos($host, "*")!==false) {
                        $host = substr($host, strpos($host, "*")+1);
                        if (strpos($host, ".")!==false) {
                            $host = substr($host, strpos($host, ".")+1);
                        }
                        if (isset($isget[$host])) {
                            continue;
                        }
                        $isget[$host]=1;
                        $find_function_content.="DOMAIN-KEYWORD,".$host.",Proxy,force-remote-dns\n";
                        continue;
                    }

                    if ($host != "") {
                        if (isset($isget[$host])) {
                            continue;
                        }
                        $isget[$host]=1;
                        $find_function_content.="DOMAIN-SUFFIX,".$host.",Proxy,force-remote-dns\n";
                        continue;
                    }
                }
            } else {
                $host = substr($rule, 0);
                if (strpos($host, "/")!==false) {
                    $host = substr($host, 0, strpos($host, "/"));
                }

                if ($host != "") {
                    if (isset($isget[$host])) {
                        continue;
                    }
                    $isget[$host]=1;
                    $find_function_content.="DOMAIN-KEYWORD,".$host.",PROXY,force-remote-dns \n";
                    continue;
                }
            }


            $count = $count + 1;
        }
        $find_function_content.='
DOMAIN-KEYWORD,google,Proxy,force-remote-dns
IP-CIDR,91.108.4.0/22,Proxy,no-resolve
IP-CIDR,91.108.56.0/22,Proxy,no-resolve
IP-CIDR,109.239.140.0/24,Proxy,no-resolve
IP-CIDR,149.154.160.0/20,Proxy,no-resolve
IP-CIDR,10.0.0.0/8,DIRECT
IP-CIDR,127.0.0.0/8,DIRECT
IP-CIDR,172.16.0.0/12,DIRECT
IP-CIDR,192.168.0.0/16,DIRECT
GEOIP,CN,DIRECT
FINAL,DIRECT
	  ';
        $pac_content.=$find_function_content;
        return $pac_content;
    }


    private static function GetSurgeGeo($passwd, $method, $server, $port)
    {
        return '
[General]
skip-proxy = 192.168.0.0/16, 10.0.0.0/8, 172.16.0.0/12, localhost, *.local
bypass-tun = 192.168.0.0/16, 10.0.0.0/8, 172.16.0.0/12
dns-server = 119.29.29.29, 223.5.5.5, 114.114.114.114
loglevel = notify

[Proxy]
Proxy = custom,'.$server.','.$port.','.$method.','.$passwd.','.Config::get('baseUrl').'/downloads/SSEncrypt.module

[Rule]
DOMAIN-KEYWORD,adsmogo,REJECT
DOMAIN-SUFFIX,acs86.com,REJECT
DOMAIN-SUFFIX,adcome.cn,REJECT
DOMAIN-SUFFIX,adinfuse.com,REJECT
DOMAIN-SUFFIX,admaster.com.cn,REJECT
DOMAIN-SUFFIX,admob.com,REJECT
DOMAIN-SUFFIX,adsage.cn,REJECT
DOMAIN-SUFFIX,adsage.com,REJECT
DOMAIN-SUFFIX,adsmogo.org,REJECT
DOMAIN-SUFFIX,ads.mobclix.com,REJECT
DOMAIN-SUFFIX,adview.cn,REJECT
DOMAIN-SUFFIX,adwhirl.com,REJECT
DOMAIN-SUFFIX,adwo.com,REJECT
DOMAIN-SUFFIX,appads.com,REJECT
DOMAIN-SUFFIX,domob.cn,REJECT
DOMAIN-SUFFIX,domob.com.cn,REJECT
DOMAIN-SUFFIX,domob.org,REJECT
DOMAIN-SUFFIX,doubleclick.net,REJECT
DOMAIN-SUFFIX,duomeng.cn,REJECT
DOMAIN-SUFFIX,duomeng.net,REJECT
DOMAIN-SUFFIX,duomeng.org,REJECT
DOMAIN-SUFFIX,googeadsserving.cn,REJECT
DOMAIN-SUFFIX,guomob.com,REJECT
DOMAIN-SUFFIX,immob.cn,REJECT
DOMAIN-SUFFIX,inmobi.com,REJECT
DOMAIN-SUFFIX,mobads.baidu.com,REJECT
DOMAIN-SUFFIX,mobads-logs.baidu.com,REJECT
DOMAIN-SUFFIX,smartadserver.com,REJECT
DOMAIN-SUFFIX,tapjoyads.com,REJECT
DOMAIN-SUFFIX,umeng.co,REJECT
DOMAIN-SUFFIX,umeng.com,REJECT
DOMAIN-SUFFIX,umtrack.com,REJECT
DOMAIN-SUFFIX,uyunad.com,REJECT
DOMAIN-SUFFIX,youmi.net,REJECT
GEOIP,AD,Proxy
GEOIP,AE,Proxy
GEOIP,AF,Proxy
GEOIP,AG,Proxy
GEOIP,AI,Proxy
GEOIP,AL,Proxy
GEOIP,AM,Proxy
GEOIP,AO,Proxy
GEOIP,AQ,Proxy
GEOIP,AR,Proxy
GEOIP,AS,Proxy
GEOIP,AS,Proxy
GEOIP,AS,Proxy
GEOIP,AS,Proxy
GEOIP,AT,Proxy
GEOIP,AU,Proxy
GEOIP,AW,Proxy
GEOIP,AX,Proxy
GEOIP,AZ,Proxy
GEOIP,BA,Proxy
GEOIP,BD,Proxy
GEOIP,BE,Proxy
GEOIP,BF,Proxy
GEOIP,BG,Proxy
GEOIP,BH,Proxy
GEOIP,BI,Proxy
GEOIP,BJ,Proxy
GEOIP,BL,Proxy
GEOIP,BM,Proxy
GEOIP,BN,Proxy
GEOIP,BO,Proxy
GEOIP,BQ,Proxy
GEOIP,BR,Proxy
GEOIP,BS,Proxy
GEOIP,BT,Proxy
GEOIP,BW,Proxy
GEOIP,BY,Proxy
GEOIP,BZ,Proxy
GEOIP,CA,Proxy
GEOIP,CC,Proxy
GEOIP,CD,Proxy
GEOIP,CF,Proxy
GEOIP,CG,Proxy
GEOIP,CH,Proxy
GEOIP,CI,Proxy
GEOIP,CK,Proxy
GEOIP,CL,Proxy
GEOIP,CM,Proxy
GEOIP,CO,Proxy
GEOIP,CR,Proxy
GEOIP,CU,Proxy
GEOIP,CV,Proxy
GEOIP,CW,Proxy
GEOIP,CX,Proxy
GEOIP,CY,Proxy
GEOIP,CZ,Proxy
GEOIP,DE,Proxy
GEOIP,DJ,Proxy
GEOIP,DK,Proxy
GEOIP,DM,Proxy
GEOIP,DO,Proxy
GEOIP,DZ,Proxy
GEOIP,EC,Proxy
GEOIP,EE,Proxy
GEOIP,EG,Proxy
GEOIP,EG,Proxy
GEOIP,EH,Proxy
GEOIP,ER,Proxy
GEOIP,ES,Proxy
GEOIP,ET,Proxy
GEOIP,FI,Proxy
GEOIP,FJ,Proxy
GEOIP,FK,Proxy
GEOIP,FM,Proxy
GEOIP,FO,Proxy
GEOIP,FR,Proxy
GEOIP,GA,Proxy
GEOIP,GB,Proxy
GEOIP,GD,Proxy
GEOIP,GE,Proxy
GEOIP,GF,Proxy
GEOIP,GG,Proxy
GEOIP,GH,Proxy
GEOIP,GI,Proxy
GEOIP,GL,Proxy
GEOIP,GM,Proxy
GEOIP,GN,Proxy
GEOIP,GP,Proxy
GEOIP,GQ,Proxy
GEOIP,GR,Proxy
GEOIP,GS,Proxy
GEOIP,GT,Proxy
GEOIP,GU,Proxy
GEOIP,GW,Proxy
GEOIP,GY,Proxy
GEOIP,HK,Proxy
GEOIP,HM,Proxy
GEOIP,HN,Proxy
GEOIP,HR,Proxy
GEOIP,HT,Proxy
GEOIP,HU,Proxy
GEOIP,ID,Proxy
GEOIP,IE,Proxy
GEOIP,IL,Proxy
GEOIP,IM,Proxy
GEOIP,IN,Proxy
GEOIP,IO,Proxy
GEOIP,IQ,Proxy
GEOIP,IR,Proxy
GEOIP,IS,Proxy
GEOIP,IT,Proxy
GEOIP,JE,Proxy
GEOIP,JM,Proxy
GEOIP,JO,Proxy
GEOIP,JP,Proxy
GEOIP,KE,Proxy
GEOIP,KG,Proxy
GEOIP,KH,Proxy
GEOIP,KI,Proxy
GEOIP,KM,Proxy
GEOIP,KN,Proxy
GEOIP,KP,Proxy
GEOIP,KR,Proxy
GEOIP,KW,Proxy
GEOIP,KY,Proxy
GEOIP,KZ,Proxy
GEOIP,LA,Proxy
GEOIP,LB,Proxy
GEOIP,LC,Proxy
GEOIP,LI,Proxy
GEOIP,LK,Proxy
GEOIP,LR,Proxy
GEOIP,LS,Proxy
GEOIP,LT,Proxy
GEOIP,LU,Proxy
GEOIP,LV,Proxy
GEOIP,LY,Proxy
GEOIP,MA,Proxy
GEOIP,MC,Proxy
GEOIP,MD,Proxy
GEOIP,ME,Proxy
GEOIP,MF,Proxy
GEOIP,MG,Proxy
GEOIP,MH,Proxy
GEOIP,MK,Proxy
GEOIP,ML,Proxy
GEOIP,MM,Proxy
GEOIP,MN,Proxy
GEOIP,MO,Proxy
GEOIP,MP,Proxy
GEOIP,MQ,Proxy
GEOIP,MR,Proxy
GEOIP,MS,Proxy
GEOIP,MT,Proxy
GEOIP,MU,Proxy
GEOIP,MV,Proxy
GEOIP,MW,Proxy
GEOIP,MX,Proxy
GEOIP,MY,Proxy
GEOIP,MZ,Proxy
GEOIP,NA,Proxy
GEOIP,NC,Proxy
GEOIP,NE,Proxy
GEOIP,NF,Proxy
GEOIP,NG,Proxy
GEOIP,NI,Proxy
GEOIP,NL,Proxy
GEOIP,NO,Proxy
GEOIP,NP,Proxy
GEOIP,NR,Proxy
GEOIP,NU,Proxy
GEOIP,NZ,Proxy
GEOIP,OM,Proxy
GEOIP,PA,Proxy
GEOIP,PE,Proxy
GEOIP,PF,Proxy
GEOIP,PG,Proxy
GEOIP,PH,Proxy
GEOIP,PK,Proxy
GEOIP,PL,Proxy
GEOIP,PM,Proxy
GEOIP,PN,Proxy
GEOIP,PR,Proxy
GEOIP,PS,Proxy
GEOIP,PT,Proxy
GEOIP,PW,Proxy
GEOIP,PY,Proxy
GEOIP,QA,Proxy
GEOIP,RE,Proxy
GEOIP,RO,Proxy
GEOIP,RS,Proxy
GEOIP,RU,Proxy
GEOIP,RW,Proxy
GEOIP,SA,Proxy
GEOIP,SB,Proxy
GEOIP,SC,Proxy
GEOIP,SD,Proxy
GEOIP,SE,Proxy
GEOIP,SG,Proxy
GEOIP,SH,Proxy
GEOIP,SI,Proxy
GEOIP,SJ,Proxy
GEOIP,SK,Proxy
GEOIP,SL,Proxy
GEOIP,SM,Proxy
GEOIP,SN,Proxy
GEOIP,SO,Proxy
GEOIP,SR,Proxy
GEOIP,SS,Proxy
GEOIP,ST,Proxy
GEOIP,SV,Proxy
GEOIP,SX,Proxy
GEOIP,SY,Proxy
GEOIP,SZ,Proxy
GEOIP,TC,Proxy
GEOIP,TD,Proxy
GEOIP,TF,Proxy
GEOIP,TG,Proxy
GEOIP,TH,Proxy
GEOIP,TJ,Proxy
GEOIP,TK,Proxy
GEOIP,TL,Proxy
GEOIP,TM,Proxy
GEOIP,TN,Proxy
GEOIP,TO,Proxy
GEOIP,TR,Proxy
GEOIP,TT,Proxy
GEOIP,TV,Proxy
GEOIP,TW,Proxy
GEOIP,TZ,Proxy
GEOIP,UA,Proxy
GEOIP,UG,Proxy
GEOIP,UM,Proxy
GEOIP,US,Proxy
GEOIP,UY,Proxy
GEOIP,UZ,Proxy
GEOIP,VA,Proxy
GEOIP,VC,Proxy
GEOIP,VE,Proxy
GEOIP,VG,Proxy
GEOIP,VI,Proxy
GEOIP,VN,Proxy
GEOIP,VU,Proxy
GEOIP,WF,Proxy
GEOIP,WS,Proxy
GEOIP,YE,Proxy
GEOIP,YT,Proxy
GEOIP,ZA,Proxy
GEOIP,ZM,Proxy
GEOIP,ZW,Proxy
IP-CIDR,91.108.4.0/22,Proxy,no-resolve
IP-CIDR,91.108.56.0/22,Proxy,no-resolve
IP-CIDR,109.239.140.0/24,Proxy,no-resolve
IP-CIDR,149.154.160.0/20,Proxy,no-resolve
IP-CIDR,10.0.0.0/8,DIRECT
IP-CIDR,127.0.0.0/8,DIRECT
IP-CIDR,172.16.0.0/12,DIRECT
IP-CIDR,192.168.0.0/16,DIRECT
GEOIP,CN,DIRECT
FINAL,Proxy';
    }

    private static function GetApn($apn, $server, $port)
    {
        return '
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
    <key>PayloadContent</key>
    <array>
        <dict>
            <key>PayloadContent</key>
            <array>
                <dict>
                    <key>DefaultsData</key>
                    <dict>
                        <key>apns</key>
                        <array>
                            <dict>
                                <key>apn</key>
                                <string>'.$apn.'</string>
                                <key>proxy</key>
                                <string>'.$server.'</string>
                                <key>proxyPort</key>
                                <integer>'.$port.'</integer>
                            </dict>
                        </array>
                    </dict>
                    <key>DefaultsDomainName</key>
                    <string>com.apple.managedCarrier</string>
                </dict>
            </array>
            <key>PayloadDescription</key>
            <string>提供对营运商“接入点名称”的自定义。</string>
            <key>PayloadDisplayName</key>
            <string>APN</string>
            <key>PayloadIdentifier</key>
            <string>com.tony.APNUNI'.$server.'.</string>
            <key>PayloadOrganization</key>
            <string>Tony</string>
            <key>PayloadType</key>
            <string>com.apple.apn.managed</string>
            <key>PayloadUUID</key>
            <string>7AC1FC00-7670-41CA-9EE1-4A5882DBD'.rand(100, 999).'D</string>
            <key>PayloadVersion</key>
            <integer>1</integer>
        </dict>
    </array>
    <key>PayloadDescription</key>
    <string>APN配置文件</string>
    <key>PayloadDisplayName</key>
    <string>APN快速配置 - '.$server.' ('.$apn.')</string>
    <key>PayloadIdentifier</key>
    <string>com.tony.APNUNI'.$server.'</string>
    <key>PayloadOrganization</key>
    <string>Tony</string>
    <key>PayloadRemovalDisallowed</key>
    <false/>
    <key>PayloadType</key>
    <string>Configuration</string>
    <key>PayloadUUID</key>
    <string>4C355D66-E72E-4DC8-864F-62C416015'.rand(100, 999).'D</string>
    <key>PayloadVersion</key>
    <integer>1</integer>
</dict>
</plist>
';
    }


    private static function GetPac($type, $address, $port, $defined)
    {
        header('Content-type: application/x-ns-proxy-autoconfig; charset=utf-8');
        return LinkController::get_pac($type, $address, $port, true, $defined);
    }

    private static function GetMacPac()
    {
        header('Content-type: application/x-ns-proxy-autoconfig; charset=utf-8');
        return LinkController::get_mac_pac();
    }


    private static function GetAcl($user)
    {
        $rulelist = base64_decode(file_get_contents("https://raw.githubusercontent.com/gfwlist/gfwlist/master/gfwlist.txt"))."\n".$user->pac;
        $gfwlist = explode("\n", $rulelist);

        $count = 0;
        $acl_content = '';
        $find_function_content = '
#Generated by sspanel-glzjin-mod v3
#Time:'.date('Y-m-d H:i:s').'

[bypass_all]

';

        $proxy_list = '[proxy_list]

';
        $bypass_list = '[bypass_list]

';
        $outbound_block_list = '[outbound_block_list]

';

        $isget=array();
        foreach ($gfwlist as $index=>$rule) {
            if (empty($rule)) {
                continue;
            } elseif (substr($rule, 0, 1) == '!' || substr($rule, 0, 1) == '[') {
                continue;
            }

            if (substr($rule, 0, 2) == '@@') {
                // ||开头表示前面还有路径
                if (substr($rule, 2, 2) =='||') {
                    //$rule_reg = preg_match("/^((http|https):\/\/)?([^\/]+)/i",substr($rule, 2), $matches);
                    $host = substr($rule, 4);
                    //preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
                    if (isset($isget[$host])) {
                        continue;
                    }
                    $isget[$host]=1;
                    //$find_function_content.="DOMAIN,".$host.",DIRECT,force-remote-dns\n";
                    $bypass_list .= $host."\n";
                    continue;
                // !开头相当于正则表达式^
                } elseif (substr($rule, 2, 1) == '|') {
                    preg_match("/(\d{1,3}\.){3}\d{1,3}/", substr($rule, 3), $matches);
                    if (!isset($matches[0])) {
                        continue;
                    }

                    $host = $matches[0];
                    if ($host != "") {
                        if (isset($isget[$host])) {
                            continue;
                        }
                        $isget[$host]=1;
                        //$find_function_content.="IP-CIDR,".$host."/32,DIRECT,no-resolve \n";
                        $bypass_list .= $host."/32\n";
                        continue;
                    } else {
                        preg_match_all("~^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?~i", substr($rule, 3), $matches);

                        if (!isset($matches[4][0])) {
                            continue;
                        }

                        $host = $matches[4][0];
                        if ($host != "") {
                            if (isset($isget[$host])) {
                                continue;
                            }
                            $isget[$host]=1;
                            //$find_function_content.="DOMAIN-SUFFIX,".$host.",DIRECT,force-remote-dns\n";
                            $bypass_list .= $host."\n";
                            continue;
                        }
                    }
                } elseif (substr($rule, 2, 1) == '.') {
                    $host = substr($rule, 3);
                    if ($host != "") {
                        if (isset($isget[$host])) {
                            continue;
                        }
                        $isget[$host]=1;
                        //$find_function_content.="DOMAIN-SUFFIX,".$host.",DIRECT,force-remote-dns \n";
                        $bypass_list .= $host."\n";
                        continue;
                    }
                }
            }

            // ||开头表示前面还有路径
            if (substr($rule, 0, 2) =='||') {
                //$rule_reg = preg_match("/^((http|https):\/\/)?([^\/]+)/i",substr($rule, 2), $matches);
                $host = substr($rule, 2);
                //preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);

                if (strpos($host, "*")!==false) {
                    $host = substr($host, strpos($host, "*")+1);
                    if (strpos($host, ".")!==false) {
                        $host = substr($host, strpos($host, ".")+1);
                    }
                    if (isset($isget[$host])) {
                        continue;
                    }
                    $isget[$host]=1;
                    //$find_function_content.="DOMAIN-KEYWORD,".$host.",Proxy,force-remote-dns\n";
                    $proxy_list .= $host."\n";
                    continue;
                }

                if (isset($isget[$host])) {
                    continue;
                }
                $isget[$host]=1;
                //$find_function_content.="DOMAIN,".$host.",Proxy,force-remote-dns\n";
                $proxy_list .= $host."\n";
            // !开头相当于正则表达式^
            } elseif (substr($rule, 0, 1) == '|') {
                preg_match("/(\d{1,3}\.){3}\d{1,3}/", substr($rule, 1), $matches);

                if (!isset($matches[0])) {
                    continue;
                }

                $host = $matches[0];
                if ($host != "") {
                    if (isset($isget[$host])) {
                        continue;
                    }
                    $isget[$host]=1;

                    preg_match("/(\d{1,3}\.){3}\d{1,3}\/\d{1,2}/", substr($rule, 1), $matches_ips);

                    if (!isset($matches_ips[0])) {
                        $proxy_list .= $host."/32\n";
                    } else {
                        $host = $matches_ips[0];
                        $proxy_list .= $host."\n";
                    }

                    //$find_function_content.="IP-CIDR,".$host."/32,Proxy,no-resolve \n";

                    continue;
                } else {
                    preg_match_all("~^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?~i", substr($rule, 1), $matches);

                    if (!isset($matches[4][0])) {
                        continue;
                    }

                    $host = $matches[4][0];
                    if (strpos($host, "*")!==false) {
                        $host = substr($host, strpos($host, "*")+1);
                        if (strpos($host, ".")!==false) {
                            $host = substr($host, strpos($host, ".")+1);
                        }
                        if (isset($isget[$host])) {
                            continue;
                        }
                        $isget[$host]=1;
                        //$find_function_content.="DOMAIN-KEYWORD,".$host.",Proxy,force-remote-dns\n";
                        $proxy_list .= $host."\n";
                        continue;
                    }

                    if ($host != "") {
                        if (isset($isget[$host])) {
                            continue;
                        }
                        $isget[$host]=1;
                        //$find_function_content.="DOMAIN-SUFFIX,".$host.",Proxy,force-remote-dns\n";
                        $proxy_list .= $host."\n";
                        continue;
                    }
                }
            } else {
                $host = substr($rule, 0);
                if (strpos($host, "/")!==false) {
                    $host = substr($host, 0, strpos($host, "/"));
                }

                if ($host != "") {
                    if (isset($isget[$host])) {
                        continue;
                    }
                    $isget[$host]=1;
                    //$find_function_content.="DOMAIN-KEYWORD,".$host.",PROXY,force-remote-dns \n";
                    $proxy_list .= $host."\n";
                    continue;
                }
            }


            $count = $count + 1;
        }

        $acl_content .= $find_function_content."\n".$proxy_list."\n".$bypass_list."\n".$outbound_block_list;
        return $acl_content;
    }



    /**
     * This is a php implementation of autoproxy2pac
     */
    private static function reg_encode($str)
    {
        $tmp_str = $str;
        $tmp_str = str_replace('/', "\\/", $tmp_str);
        $tmp_str = str_replace('.', "\\.", $tmp_str);
        $tmp_str = str_replace(':', "\\:", $tmp_str);
        $tmp_str = str_replace('%', "\\%", $tmp_str);
        $tmp_str = str_replace('*', ".*", $tmp_str);
        $tmp_str = str_replace('-', "\\-", $tmp_str);
        $tmp_str = str_replace('&', "\\&", $tmp_str);
        $tmp_str = str_replace('?', "\\?", $tmp_str);
        $tmp_str = str_replace('+', "\\+", $tmp_str);

        return $tmp_str;
    }

    private static function get_pac($proxy_type, $proxy_host, $proxy_port, $proxy_google, $defined)
    {
        $rulelist = base64_decode(file_get_contents("https://raw.githubusercontent.com/gfwlist/gfwlist/master/gfwlist.txt"))."\n".$defined;
        $gfwlist = explode("\n", $rulelist);
        if ($proxy_google == "true") {
            $gfwlist[] = ".google.com";
        }

        $count = 0;
        $pac_content = '';
        $find_function_content = 'function FindProxyForURL(url, host) { var PROXY = "'.$proxy_type.' '.$proxy_host.':'.$proxy_port.'; DIRECT"; var DEFAULT = "DIRECT";'."\n";
        foreach ($gfwlist as $index=>$rule) {
            if (empty($rule)) {
                continue;
            } elseif (substr($rule, 0, 1) == '!' || substr($rule, 0, 1) == '[') {
                continue;
            }
            $return_proxy = 'PROXY';
        // @@开头表示默认是直接访问
        if (substr($rule, 0, 2) == '@@') {
            $rule = substr($rule, 2);
            $return_proxy = "DEFAULT";
        }

        // ||开头表示前面还有路径
        if (substr($rule, 0, 2) =='||') {
            $rule_reg = "^[\\w\\-]+:\\/+(?!\\/)(?:[^\\/]+\\.)?".LinkController::reg_encode(substr($rule, 2));
        // !开头相当于正则表达式^
        } elseif (substr($rule, 0, 1) == '|') {
            $rule_reg = "^" . LinkController::reg_encode(substr($rule, 1));
        // 前后匹配的/表示精确匹配
        } elseif (substr($rule, 0, 1) == '/' && substr($rule, -1) == '/') {
            $rule_reg = substr($rule, 1, strlen($rule) - 2);
        } else {
            $rule_reg = LinkController::reg_encode($rule);
        }
        // 以|结尾，替换为$结尾
        if (preg_match("/\|$/i", $rule_reg)) {
            $rule_reg = substr($rule_reg, 0, strlen($rule_reg) - 1)."$";
        }
            $find_function_content.='if (/' . $rule_reg . '/i.test(url)) return '.$return_proxy.';'."\n";
            $count = $count + 1;
        }
        $find_function_content.='return DEFAULT;'."}";
        $pac_content.=$find_function_content;
        return $pac_content;
    }


    private static function get_mac_pac()
    {
        $rulelist = base64_decode(file_get_contents("https://raw.githubusercontent.com/gfwlist/gfwlist/master/gfwlist.txt"));
        $gfwlist = explode("\n", $rulelist);
        $gfwlist[] = ".google.com";

        $count = 0;
        $pac_content = '';
        $find_function_content = 'function FindProxyForURL(url, host) { var PROXY = "SOCKS5 127.0.0.1:1080; SOCKS 127.0.0.1:1080; DIRECT;"; var DEFAULT = "DIRECT";'."\n";
        foreach ($gfwlist as $index=>$rule) {
            if (empty($rule)) {
                continue;
            } elseif (substr($rule, 0, 1) == '!' || substr($rule, 0, 1) == '[') {
                continue;
            }
            $return_proxy = 'PROXY';
        // @@开头表示默认是直接访问
        if (substr($rule, 0, 2) == '@@') {
            $rule = substr($rule, 2);
            $return_proxy = "DEFAULT";
        }

        // ||开头表示前面还有路径
        if (substr($rule, 0, 2) =='||') {
            $rule_reg = "^[\\w\\-]+:\\/+(?!\\/)(?:[^\\/]+\\.)?".LinkController::reg_encode(substr($rule, 2));
        // !开头相当于正则表达式^
        } elseif (substr($rule, 0, 1) == '|') {
            $rule_reg = "^" . LinkController::reg_encode(substr($rule, 1));
        // 前后匹配的/表示精确匹配
        } elseif (substr($rule, 0, 1) == '/' && substr($rule, -1) == '/') {
            $rule_reg = substr($rule, 1, strlen($rule) - 2);
        } else {
            $rule_reg = LinkController::reg_encode($rule);
        }
        // 以|结尾，替换为$结尾
        if (preg_match("/\|$/i", $rule_reg)) {
            $rule_reg = substr($rule_reg, 0, strlen($rule_reg) - 1)."$";
        }
            $find_function_content.='if (/' . $rule_reg . '/i.test(url)) return '.$return_proxy.';'."\n";
            $count = $count + 1;
        }
        $find_function_content.='return DEFAULT;'."}";
        $pac_content.=$find_function_content;
        return $pac_content;
    }

    public static function GetRouter($user, $is_mu = 0, $is_ss = 0)
    {
        $bash = '#!/bin/sh'."\n";
        $bash .= 'export PATH=\'/opt/usr/sbin:/opt/usr/bin:/opt/sbin:/opt/bin:/usr/local/sbin:/usr/sbin:/usr/bin:/sbin:/bin\''."\n";
        $bash .= 'export LD_LIBRARY_PATH=/lib:/opt/lib'."\n";
        $bash .= 'nvram set ss_type='.($is_ss == 1 ? '0' : '1')."\n";

        $count = 0;

        $items = URL::getAllSSRItems($user, $is_mu, $is_ss);
        foreach($items as $item) {
            if ($is_ss == 0) {
                $bash .= 'nvram set rt_ss_name_x'.$count.'="'.$item['remark']."\"\n";
                $bash .= 'nvram set rt_ss_port_x'.$count.'='.$item['port']."\n";
                $bash .= 'nvram set rt_ss_password_x'.$count.'="'.$item['passwd']."\"\n";
                $bash .= 'nvram set rt_ss_server_x'.$count.'='.$item['address']."\n";
                $bash .= 'nvram set rt_ss_usage_x'.$count.'="'."-o ".$item['obfs']." -g ".$item['obfs_param']." -O ".$item['protocol']." -G ".$item['protocol_param']."\"\n";
                $bash .= 'nvram set rt_ss_method_x'.$count.'='.$item['method']."\n";
                $count += 1;
            }else{
                $bash .= 'nvram set rt_ss_name_x'.$count.'="'.$item['remark']."\"\n";
                $bash .= 'nvram set rt_ss_port_x'.$count.'='.$item['port']."\n";
                $bash .= 'nvram set rt_ss_password_x'.$count.'="'.$item['passwd']."\"\n";
                $bash .= 'nvram set rt_ss_server_x'.$count.'='.$item['address']."\n";
                $bash .= 'nvram set rt_ss_usage_x'.$count.'=""'."\n";
                $bash .= 'nvram set rt_ss_method_x'.$count.'='.$item['method']."\n";
                $count += 1;
            }
        }

        $bash .= "nvram set rt_ssnum_x=".$count."\n";

        return $bash;
    }

    public static function GetSub($user, $mu = 0, $is_ss = 0, $v = 2)
    {
        // return Tools::base64_url_encode(URL::getAllUrl($user, $mu, $is_ss, $v, 1));
        return base64_encode(URL::getAllUrl($user, $mu, $is_ss, $v, 1));
    }

    public static function MakeUserRules($user)
    {
        $custom_rules = explode("\n", $user->pac);
        $country_iso_codes = ['AD', 'AE', 'AF', 'AG', 'AI', 'AL', 'AM', 'AO', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AW', 'AX', 'AZ', 'BA', 'BB', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BL', 'BM', 'BN', 'BO', 'BQ', 'BR', 'BS', 'BT', 'BV', 'BW', 'BY', 'BZ', 'CA', 'CC', 'CD', 'CF', 'CG', 'CH', 'CI', 'CK', 'CL', 'CM', 'CN', 'CO', 'CR', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DE', 'DJ', 'DK', 'DM', 'DO', 'DZ', 'EC', 'EE', 'EG', 'EH', 'ER', 'ES', 'ET', 'FI', 'FJ', 'FK', 'FM', 'FO', 'FR', 'GA', 'GB', 'GD', 'GE', 'GF', 'GG', 'GH', 'GI', 'GL', 'GM', 'GN', 'GP', 'GQ', 'GR', 'GS', 'GT', 'GU', 'GW', 'GY', 'HK', 'HM', 'HN', 'HR', 'HT', 'HU', 'ID', 'IE', 'IL', 'IM', 'IN', 'IO', 'IQ', 'IR', 'IS', 'IT', 'JE', 'JM', 'JO', 'JP', 'KE', 'KG', 'KH', 'KI', 'KM', 'KN', 'KP', 'KR', 'KW', 'KY', 'KZ', 'LA', 'LB', 'LC', 'LI', 'LK', 'LR', 'LS', 'LT', 'LU', 'LV', 'LY', 'MA', 'MC', 'MD', 'ME', 'MF', 'MG', 'MH', 'MK', 'ML', 'MM', 'MN', 'MO', 'MP', 'MQ', 'MR', 'MS', 'MT', 'MU', 'MV', 'MW', 'MX', 'MY', 'MZ', 'NA', 'NC', 'NE', 'NF', 'NG', 'NI', 'NL', 'NO', 'NP', 'NR', 'NU', 'NZ', 'OM', 'PA', 'PE', 'PF', 'PG', 'PH', 'PK', 'PL', 'PM', 'PN', 'PR', 'PS', 'PT', 'PW', 'PY', 'QA', 'RE', 'RO', 'RS', 'RU', 'RW', 'SA', 'SB', 'SC', 'SD', 'SE', 'SG', 'SH', 'SI', 'SJ', 'SK', 'SL', 'SM', 'SN', 'SO', 'SR', 'SS', 'ST', 'SV', 'SX', 'SY', 'SZ', 'TC', 'TD', 'TF', 'TG', 'TH', 'TJ', 'TK', 'TL', 'TM', 'TN', 'TO', 'TR', 'TT', 'TV', 'TW', 'TZ', 'UA', 'UG', 'UM', 'US', 'UY', 'UZ', 'VA', 'VC', 'VE', 'VG', 'VI', 'VN', 'VU', 'WF', 'WS', 'XK', 'YE', 'YT', 'ZA', 'ZM', 'ZW'];
        $rules = [];
        $rules_ip = [];
        foreach ($custom_rules as $index => $custom_rule) {
            if (empty(str_replace(' ', '', $custom_rule))) {
                continue;
            } else {
                $domain_suffix = '';
                $country_code = '';
                $geosite = '';
                $method = '';

                if (substr($custom_rule, 0, 2) == '@@') {
                    $method = ',DIRECT';
                    $custom_rule = substr($custom_rule, 2);
                } elseif (substr($custom_rule, 0, 1) == '!') {
                    $method = ',REJECT';
                    $custom_rule = substr($custom_rule, 1);
                } else {
                    $method = ',PROXY';
                }

                if (substr($custom_rule, 0, 2) == '||') {
                    $domain_suffix = '-SUFFIX';
                } elseif (substr($custom_rule, 0, 1) == '|') {
                    $country_code = strtoupper(substr($custom_rule, 1));
                } elseif (substr($custom_rule, 0, 1) == '$') {
                    $geosite = substr($custom_rule, 1);
                } else {
                    continue;
                }

                if (preg_match("/(?:[\d\.]+){3}\d+\/\d+/", $custom_rule, $matches)) {
                    array_push($rules_ip, 'IP-CIDR,'.$matches[0].$method.',no-resolve');
                    continue;
                }
                if (preg_match("/[a-z0-9.\-]+\.[a-z]+/i", $custom_rule, $matches)) {
                    array_push($rules, 'DOMAIN'.$domain_suffix.','.strtolower($matches[0]).$method);
                    continue;
                }
                if (!empty($country_code) && in_array($country_code, $country_iso_codes)) {
                    array_push($rules_ip, 'GEOIP,'.$country_iso_code.$method.',no-resolve');
                    continue;
                }
                if (!empty($geosite)) {
                    array_push($rules, 'GEOSITE,'.$geosite.$method);
                    continue;
                }
                if (preg_match("/[a-z0-9-]+/i", $custom_rule, $matches)) {
                    array_push($rules, 'DOMAIN-KEYWORD,'.strtolower($matches[0]).$method);
                    continue;
                }
            }
        }
        return [$rules, $rules_ip];
    }

    public static function ReorderRules($rules)
    {
        $domains = [];
        $ips = [];
        $match = [];
        $ip_rules = ['GEOIP', 'IP-CIDR', 'IP-CIDR6', 'SRC-IP-CIDR', 'IPSET'];
        foreach ($rules as $rule) {
            $rs = explode(',', $rule);
            if (in_array($rs[0], $ip_rules) or strtoupper($rs[0]) == 'MATCH') {
                array_push($ips, $rule);
                continue;
            }
            array_push($domains, $rule);
        }
        return array_merge($domains, $ips);
    }

    public static function GetClash($user, $mu = 0, $cnip = 0, $sm = -1)
    {
        $root_conf = [
            "port" => 7890,
            "socks-port" => 7891,
            "allow-lan" => false,
            "mode" => "rule",
            "log-level" => "info",
            "external-controller" => "127.0.0.1:9090",
            "hosts" => [
                "localhost" => "127.0.0.1"
            ],
            "dns" => [
                "ipv6" => true,
                "default-nameserver" => [
                    "119.28.28.28",
                    "223.6.6.6",
                    "114.114.115.115"
                ],
                "enhanced-mode" => "fake-ip",
                "fake-ip-filter" => [
                    "*.lan",
                    "localhost.ptlogin2.qq.com"
                ],                
                "use-hosts" => true,
                "nameserver" => [
                    "119.28.28.28",
                    "223.6.6.6",
                    "114.114.115.115"
                ],
                "fallback" => [
                    "tls://dns.google:853",
                    "tls://1.0.0.1:853",
                    "tls://dns.adguard.com:853",
                    "https://dns.google/dns-query",
                    "https://cloudflare-dns.com/dns-query",
                    "https://dns.adguard.com/dns-query"
                ],
                "fallback-filter" => [
                    "geoip" => true,
                    "geoip-code" => "CN",
                    "geosite" => [
                        "gfw"
                    ],
                    "ipcidr" => [
                        "240.0.0.0/4"
                    ],
                    "domain" => [
                        "+.google.com",
                        "+.youtube.com",
                        "+.appspot.com",
                        "+.telegram.com",
                        "+.facebook.com",
                        "+.twitter.com",
                        "+.blogger.com",
                        "+.gmail.com",
                        "+.gvt1.com"
                    ]
                ]
            ],
            "sniffer" => [
                "enable" => false,
                "force-dns-mapping" => true,
                "parse-pure-ip" => true,
                "override-destination" => false,
                "sniff" => [
                    "HTTP" => [
                        "ports" => [
                            80,
                            "8080-8880",
                        ],
                        "override-destination" => true,
                    ],
                    "TLS" => [
                        "ports" => [
                            443,
                            8443,
                        ],
                    ],
                    "QUIC" => [
                        "ports" => [
                            443,
                            8443,
                        ],
                    ],
                ],
                "force-domain" => [
                    "+.v2ex.com",
                ],
                "skip-domain" => [
                    "Mijia Cloud",
                ],
            ],
            "proxies" => [],
            "proxy-groups" => [
                [
                    "name" => "PROXY",
                    "type" => "url-test",
                    "proxies" => [],
                    "url" => "https://www.google.com/gen_204",
                    "interval" => 10
                ]
            ],
            "rules" => []
        ];
        if ($user->is_admin or $user->class >= Node::max('node_class')) {
            $root_conf['proxy-groups'][0]['type'] = 'fallback';
        }
        $items = Tools::arrayOrderby(URL::getAllItems($user, $mu, 0, 1), 'node_class', SORT_DESC, 'id', SORT_DESC);
        foreach ($items as $index => $item) {
            if (array_key_exists('protocol_param', $item)) { //SS
                $ss = [
                    "name" => $item['remark'],
                    "type" => 'ss',
                    "server" => $item['address'],
                    "port" => $item['port'],
                    "cipher" => $item['method'],
                    "password" => $item['passwd'],
                    "udp" => true
                ];
                array_push($root_conf['proxies'], $ss);
                array_push($root_conf['proxy-groups'][0]['proxies'], $ss['name']);
                continue;
            }
            // hysteria 2
            if (array_key_exists('obfs_password', $item)) {
                $hysteria = [
                    "name" => $item['remark'],
                    "type" => "hysteria2",
                    "server" => $item['server'],
                    "port" => intval(preg_split('/[,\-]/', $item['ports'])[0]),
                    "up" => $item['up'].' Mbps',
                    "down" => $item['down'].' Mbps',
                    "password" => $item['auth'],
                    "obfs" => $item['obfs'],
                    "obfs_password" => $item['obfs_password'],
                    "sni" => $item['sni'],
                    "skip-cert-verify" => false,
                    "alpn" => [
                        "h3"
                    ]
                ];
                if ( empty($item['obfs_password']) ) {
                    unset($hysteria["obfs"]);
                    unset($hysteria["obfs_password"]);
                }
                array_push($root_conf['proxies'], $hysteria);
                array_push($root_conf['proxy-groups'][0]['proxies'], $hysteria['name']);
                continue;
            }
            // trojan original
            if (!array_key_exists('uuid', $item) && array_key_exists('sni', $item)) {
                $trojan = [
                    "name" => $item['remark'],
                    "type" => "trojan",
                    "server" => $item['address'],
                    "port" => $item['port'],
                    "password" => $item['passwd'],
                    "udp" => true,
                    "sni" => $item['sni'],
                    "alpn" => [
                        "h2",
                        "http/1.1"
                    ],
                    "skip-cert-verify" => false
                ];
                array_push($root_conf['proxies'], $trojan);
                array_push($root_conf['proxy-groups'][0]['proxies'], $trojan['name']);
                continue;
            }
            //vmess & vless
            $ray = [];
            if (array_key_exists('uuid', $item)) {
                $ray = [
                    "name" => $item['remark'],
                    "type" => $item['protocol'],
                    "server" => $item['host'],
                    "port" => $item['port'],
                    "uuid" => $item['uuid'],
                    "alterId" => 0,
                    "cipher" => 'auto',
                    "udp" => true,
                    "flow" => 'none',
                    "tls" => $item['tls'] == 1 ? true : false,
                    "servername" => $item['host'],
                    "skip-cert-verify" => false,
                    "client-fingerprint" => $item['fingerprint'],
                    "network" => $item['network']
                ];
                if (array_key_exists('aid', $item)) {
                    // vmess
                    $ray['alterId'] = $item['aid'];
                    // $ray['uuid'] = $item['uuid'];
                    unset($ray['flow']);
                } else {
                    // vless or xray
                    unset($ray['alterId']);
                    unset($ray['cipher']);
                    // $ray['uuid'] = $item['passwd'];
                    $ray['flow'] = $item['xtls'];
                }
            } else {
                // v2ray trojan
                $ray = [
                    "name" => $item['remark'],
                    "type" => $item['protocol'],
                    "server" => $item['host'],
                    "port" => $item['port'],
                    "password" => $item['passwd'],
                    "flow" => $item['xtls'],
                    "network" => $item['network'],
                    "sni" => $item['host'],
                    "skip-cert-verify" => false,
                    "client-fingerprint" => $item['fingerprint'],
                    "udp" => true
                ];
            }

            switch ($ray['network']) {
                case 'ws':
                    if (!empty($item['wsPath'])) {
                        $ray['ws-path'] = $item['wsPath'];
                    }
                    if (!empty($item['wsHost'])) {
                        $ray['ws-headers'] = [
                            "Host" => $item['wsHost']
                        ];
                    } else {
                        $ray['ws-headers'] = [
                            "Host" => $item['host']
                        ];
                    }
                    $ray['ws-opts'] = [
                        "path" => $ray['ws-path'],
                        "headers" => $ray['ws-headers']
                    ];
                    break;

                case 'h2':
                    $ray['h2-opts'] = [];
                    if (!empty($item['h2Path'])) {
                        $ray['h2-opts']['path'] = $item['h2Path'];
                    }
                    if (!empty($item['h2Host'])) {
                        $ray['h2-opts']['host'] = explode('\n', $item['h2Host']);
                    } else {
                        $ray['h2-opts']['host'] = [ $item['host']  ];
                    }
                    break;

                case 'http':
                    $ray['http-opts'] = [ 'method' => 'GET' ];
                    if (!empty($item['h2Path'])) {
                        $ray['http-opts']['path'] = [ $item['h2Path'] ];
                    }
                    if (!empty($item['h2Host'])) {
                        $ray['http-opts']['headers'] = [ 'Host' => [ $item['h2Host'] ] ];
                    } else {
                        $ray['http-opts']['headers'] = [ 'Host' => [ $item['host'] ] ];
                    }
                    break;

                case 'grpc':
                    $ray['grpc-opts'] = [ 'grpc-service-name' => $item['servicename'] ];
                    break;

                default:
                    break;
            }
            array_push($root_conf['proxies'], $ray);
            array_push($root_conf['proxy-groups'][0]['proxies'], $ray['name']);
        }
        [$rules, $rules_ip] = LinkController::MakeUserRules($user);
        $root_conf['rules'] = array_merge($rules, $rules_ip);

        if ($sm == 0) { // 0 for direct 1 for proxy -1 for leave it
            $rs = explode("\n", file_get_contents(BASE_PATH.'/storage/clash-rules-stream-media-direct.yaml'));
            $root_conf['rules'] = array_merge($rs, $root_conf['rules']);
        }
        if ($sm == 1) {
            $rs = explode("\n", str_replace(',DIRECT', ',PROXY', file_get_contents(BASE_PATH.'/storage/clash-rules-stream-media-direct.yaml')));
            $root_conf['rules'] = array_merge($rs, $root_conf['rules']);
        }

        if ($cnip == 1) {
            $rs = explode("\n", file_get_contents(BASE_PATH.'/storage/clash_rules_cnip.yaml'));
            $root_conf['rules'] = array_merge($root_conf['rules'], $rs);
        } else {
            $rs = explode("\n", file_get_contents(BASE_PATH.'/storage/clash_rules.yaml'));
            $root_conf['rules'] = array_merge($root_conf['rules'], $rs);
        }
        $root_conf['rules'] = LinkController::ReorderRules($root_conf['rules']);
        
        return yaml_emit($root_conf, YAML_UTF8_ENCODING, YAML_CRLN_BREAK);
    }
}
