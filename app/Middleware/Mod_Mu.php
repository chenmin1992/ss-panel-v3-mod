<?php


namespace App\Middleware;

use App\Services\Config;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Services\Factory;
use App\Utils\Helper;
use App\Models\Node;

class Mod_Mu
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        $key = Helper::getMuKeyFromReq($request);
        if (empty($key)) {
            $res['ret'] = 0;
            $res['data'] = "key is null";
            $response->getBody()->write(json_encode($res));
            return $response;
        }

        $auth=false;
        $keyset=explode(",", Config::get('muKey'));
        foreach ($keyset as $sinkey) {
            if ($key==$sinkey) {
                $auth=true;
                break;
            }
        }

        if ($auth==false) {
            $res['ret'] = 0;
            $res['data'] = "token or source is invalid";
            $response->getBody()->write(json_encode($res));
            return $response;
        }

        $cip = $_SERVER["REMOTE_ADDR"];
        $cipc = substr($cip, 0, strrpos($cip, '.')+1);
        $node = Node::where("node_ip", "LIKE", '%'.$cip.'%')->orWhere(
                function ($query) use ($cipc){
                    $query->where("name", "LIKE", "%Claw%")
                        ->where("node_ip", "LIKE", '%'.$cipc.'%');
                }
        )->first();
        if ($node==null && $cip != '127.0.0.1') {
            $res['ret'] = 0;
            $res['data'] = "token or source is invalid";
            $response->getBody()->write(json_encode($res));
            return $response;
        }

        $response = $next($request, $response);
        return $response;
    }
}
