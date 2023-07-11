
{include file='admin/main.tpl'}







	<main class="content">
		<div class="content-header ui-content-header">
			<div class="container">
				<h1 class="content-heading">编辑节点 #{$node->id}</h1>
			</div>
		</div>
		<div class="container">
			<div class="col-lg-12 col-sm-12">
				<section class="content-inner margin-top-no">
					<form id="main_form">
						<div class="card">
							<div class="card-main">
								<div class="card-inner">
									<div class="form-group form-group-label">
										<label class="floating-label" for="name">节点名称</label>
										<input class="form-control" id="name" name="name" type="text" value="{$node->name}">
									</div>


									<div class="form-group form-group-label">
										<label class="floating-label" for="server">节点地址</label>
										<input class="form-control" id="server" name="server" type="text" value="{$node->server}">
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="server">节点IP(不填则自动获取，填写请按照 <a href="https://github.com/esdeathlove/ss-panel-v3-mod/wiki/%E8%8A%82%E7%82%B9IP%E5%A1%AB%E5%86%99%E8%A7%84%E5%88%99">这里</a> 的规则进行填写)</label>
										<input class="form-control" id="node_ip" name="node_ip" type="text" value="{$node->node_ip}">
									</div>

									<div class="form-group form-group-label" hidden="hidden">
										<label class="floating-label" for="method">加密方式</label>
										<input class="form-control" id="method" name="method" type="text" value="{$node->method}">
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="rate">流量比例</label>
										<input class="form-control" id="rate" name="rate" type="text" value="{$node->traffic_rate}">
									</div>


									<div class="form-group form-group-label" hidden="hidden">
										<div class="checkbox switch">
											<label for="custom_method">
												<input {if $node->custom_method==1}checked{/if} class="access-hide" id="custom_method" name="custom_method" type="checkbox"><span class="switch-toggle"></span>自定义加密
											</label>
										</div>
									</div>

									<div class="form-group form-group-label" hidden="hidden">
										<div class="checkbox switch">
											<label for="custom_rss">
												<input {if $node->custom_rss==1}checked{/if} class="access-hide" id="custom_rss" type="checkbox" name="custom_rss"><span class="switch-toggle"></span>自定义协议&混淆
											</label>
										</div>
									</div>

									<div class="form-group form-group-label">
										<label for="mu_only">
											<label class="floating-label" for="sort">单端口多用户启用</label>
											<select id="mu_only" class="form-control" name="is_multi_user">
												<option value="0" {if $node->mu_only==0}selected{/if}>单端口多用户与普通端口并存</option>
												<option value="-1" {if $node->mu_only==-1}selected{/if}>只启用普通端口</option>
												<option value="1" {if $node->mu_only==1}selected{/if}>只启用单端口多用户</option>
											</select>
										</label>
									</div>


								</div>
							</div>
						</div>

						<div class="card">
							<div class="card-main">
								<div class="card-inner">
									<div class="form-group form-group-label">
										<div class="checkbox switch">
											<label for="type">
												<input {if $node->type==1}checked{/if} class="access-hide" id="type" name="type" type="checkbox"><span class="switch-toggle"></span>是否显示
											</label>
										</div>
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="status">节点状态</label>
										<input class="form-control" id="status" name="status" type="text" value="{$node->status}">
									</div>

									<div class="form-group form-group-label">
										<div class="form-group form-group-label">
												<label class="floating-label" for="sort">节点类型</label>
												<select id="sort" class="form-control" name="sort">
													<option value="0" {if $node->sort==0}selected{/if}>Shadowsocks</option>
													<option value="1" {if $node->sort==1}selected{/if}>VPN/Radius基础</option>
													<option value="2" {if $node->sort==2}selected{/if}>SSH</option>
													<option value="3" {if $node->sort==3}selected{/if}>PAC</option>
													<option value="4" {if $node->sort==4}selected{/if}>APN文件外链</option>
													<option value="5" {if $node->sort==5}selected{/if}>Anyconnect</option>
													<option value="6" {if $node->sort==6}selected{/if}>APN</option>
													<option value="7" {if $node->sort==7}selected{/if}>PAC PLUS(Socks 代理生成 PAC文件)</option>
													<option value="8" {if $node->sort==8}selected{/if}>PAC PLUS PLUS(HTTPS 代理生成 PAC文件)</option>
													<option value="9" {if $node->sort==9}selected{/if}>Shadowsocks 单端口多用户</option>
													<option value="10" {if $node->sort==10}selected{/if}>Shadowsocks 中转</option>
													<option value="11" {if $node->sort==11}selected{/if}>V2Ray</option>
													<option value="12" {if $node->sort==12}selected{/if}>Trojan</option>
													<option value="13" {if $node->sort==13}selected{/if}>Trojan 中转</option>
												</select>
											</div>
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="info">节点描述</label>
										<input class="form-control" id="info" name="info" type="text" value="{$node->info}">
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="class">节点等级（不分级请填0，分级为数字）</label>
										<input class="form-control" id="class" name="class" type="text" value="{$node->node_class}">
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="group">节点群组（分组为数字，不分组请填0）</label>
										<input class="form-control" id="group" name="group" type="text" value="{$node->node_group}">
									</div>


									<div class="form-group form-group-label">
										<label class="floating-label" for="node_bandwidth_limit">节点流量上限（不使用的话请填0）（GB）</label>
										<input class="form-control" id="node_bandwidth_limit" name="node_bandwidth_limit" type="text" value="{$node->node_bandwidth_limit/1024/1024/1024}">
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="bandwidthlimit_resetday">节点流量上限清空日</label>
										<input class="form-control" id="bandwidthlimit_resetday" name="bandwidthlimit_resetday" type="text" value="{$node->bandwidthlimit_resetday}">
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="node_speedlimit">节点限速(对于每个用户端口)（Mbps）</label>
										<input class="form-control" id="node_speedlimit" name="node_speedlimit" type="text" value="{$node->node_speedlimit}">
									</div>
								</div>
							</div>
						</div>

						<div class="card {if $node->sort!=11}access-hide{/if}" id="v2in">
							<div class="card-main">
								<div class="card-inner">
									<p><h4>V2Ray设置</h4></p>

                                    <button class="btn btn-flat waves-attach" type="button" id="add-inbound"><span class="icon icon-lg">add</span>&nbsp;添加一个Inbound</button>
                                    <button class="btn btn-flat waves-attach" type="button" id="del-inbound"><span class="icon icon-lg">clear</span>&nbsp;移除当前Inbound</button>

                                    <nav class="tab-nav margin-top-no">
                                        <ul class="nav nav-list" id="inbounds-nav">
                                           {foreach from=$node->v2conf|json_decode key=index item=inbound}
                                            <li {if $index==0}class="active"{/if}>
                                                <a class="waves-attach waves-effect" data-toggle="tab" href="#in-{$index}"><i class="icon icon-lg">vertical_align_bottom</i>&nbsp;in-{$index}</a>
                                            </li>
                                            {/foreach}
                                        </ul>
                                    </nav>

									<div class="card-inner">
										<div class="tab-content" id="inbounds">
											{foreach from=$node->v2conf|json_decode key=index item=inbound}
											<div class="tab-pane fade {if $index==0}active in{/if}" id="in-{$index}">
                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="listen">监听地址</label>
                                                    <input class="form-control" id="listen" type="text" name="listen" value="{$inbound->listen}">
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="port">监听端口</label>
                                                    <input class="form-control" id="port" type="number" name="port" value="{$inbound->port}">
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="protocol">协议</label>
                                                    <select id="protocol" class="form-control" name="protocol">                                                                
                                                        <option value="blackhole" disabled>Blackhole</option>
                                                        <option value="dns" disabled>DNS</option>
                                                        <option value="dokodemo-door" disabled>Dokodemo-door</option>
                                                        <option value="freedom" disabled>Freedom</option>
                                                        <option value="http" disabled>HTTP</option>
                                                        <option value="socks" disabled>Socks</option>
                                                        <option value="vmess" {if $inbound->protocol=='vmess'}selected{/if}>VMess</option>
                                                        <option value="shadowsocks" disabled>Shadowsocks</option>
                                                        <option value="trojan" {if $inbound->protocol=='trojan'}selected{/if}>Trojan</option>
                                                        <option value="vless" {if $inbound->protocol=='vless'}selected{/if}>VLess</option>
                                                        <option value="mtproto" disabled>MTProto</option>
                                                    </select>
                                                </div>

                                                <div class="tab-content" id="protocols">
                                                    <div class="tab-pane fade {if $inbound->protocol=='vmess'}active in{/if}" id="vmess">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="alterid">AlterId</label>
                                                            <input class="form-control" id="alterid" type="number" name="alterid" value="{$inbound->alterid}">
                                                        </div>

                                                        <div class="form-group form-group-label">
                                                            <div class="checkbox switch">
                                                                <label for="disable_insecure_encryption">
                                                                    <input {if $inbound->disableinsecureencryption}checked{/if} class="access-hide" id="disable_insecure_encryption" type="checkbox" name="disable_insecure_encryption"><span class="switch-toggle"></span>禁用不安全的加密方式
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

			                                    <div class="form-group form-group-label">
			                                        <div class="checkbox switch">
			                                            <label for="block_bt">
			                                                <input {if $inbound->blockbt}checked{/if} class="access-hide" id="block_bt" type="checkbox" name="block_bt"><span class="switch-toggle"></span>禁止BT下载
			                                            </label>
			                                        </div>
			                                    </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="security">TLS</label>
                                                    <select id="security" class="form-control" name="security">
                                                        <option value="none" {if $inbound->security!='tls'}selected{/if}>none</option>
                                                        <option value="tls" {if $inbound->security=='tls'}selected{/if}>TLS</option>
                                                    </select>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="xtls">XTLS</label>
                                                    <select id="xtls" class="form-control" name="xtls">
                                                        <option value="none" {if $inbound->xtls=='none'}selected{/if}>none</option>
                                                        <option value="xtls-rprx-direct" {if $inbound->xtls=='xtls-rprx-direct'}selected{/if}>xtls-rprx-direct</option>
                                                        <option value="xtls-rprx-origin" {if $inbound->xtls=='xtls-rprx-origin'}selected{/if}>xtls-rprx-origin</option>
                                                        <option value="xtls-rprx-vision" {if $inbound->xtls=='xtls-rprx-vision'}selected{/if}>xtls-rprx-vision</option>
                                                    </select>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="cert">证书/cert</label>
                                                    <select id="cert" class="form-control" name="cert">
                                                        <option value="0">none</option>
                                                        {foreach $certs as $cert}
                                                        <option value="{$cert->id}" {if $inbound->cert==$cert->id}selected{/if}>{$cert->name}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="network">传输类型</label>
                                                    <select id="network" class="form-control" name="network">
                                                        <option value="tcp" {if $inbound->network=='tcp'}selected{/if}>TCP</option>
                                                        <option value="kcp" {if $inbound->network=='kcp'}selected{/if}>mKCP</option>
                                                        <option value="ws" {if $inbound->network=='ws'}selected{/if}>WebSocket</option>
                                                        <option value="h2" {if $inbound->network=='h2'}selected{/if}>HTTP/2</option>
                                                        <option value="quic" {if $inbound->network=='quic'}selected{/if}>QUIC</option>
                                                        <option value="domainsocket" {if $inbound->network=='domainsocket'}selected{/if}>DomainSocket</option>
                                                        <option value="grpc" {if $inbound->network=='grpc'}selected{/if}>gRPC</option>
                                                    </select>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="tcpfastopen">TCP Fast Open</label>
                                                    <select id="tcpfastopen" class="form-control" name="tcpfastopen">
                                                        <option value="none" {if $inbound->tcpfastopen=='none'}selected{/if}>跟随系统</option>
                                                        <option value="true" {if $inbound->tcpfastopen=='true'}selected{/if}>强制开启</option>
                                                        <option value="false" {if $inbound->tcpfastopen=='false'}selected{/if}>强制关闭</option>
                                                    </select>
                                                </div>

                                                <div class="tab-content" id="networks">
                                                    <div class="tab-pane fade {if $inbound->network=='tcp'}active in{/if}" id="tcp">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="obfs">Header</label>
                                                            <select id="obfs" class="form-control" name="obfs">
                                                                <option value="none" {if $inbound->obfs=='none'}selected{/if}>none</option>
                                                                <option value="http" {if $inbound->obfs=='http'}selected{/if}>http</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="http_request">HTTP Request</label>
                                                            <textarea class="form-control" id="http_request" rows="15">{str_replace('    ', '  ', json_encode($inbound->httprequest, JSON_PRETTY_PRINT))}</textarea>
                                                        </div>

                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="http_response">HTTP Response</label>
                                                            <textarea class="form-control" id="http_response" rows="15">{str_replace('    ', '  ', json_encode($inbound->httpresponse, JSON_PRETTY_PRINT))}</textarea>
                                                        </div>

                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="proxy_addr">代理地址，不使用Nginx/Caddy/CDN请留空</label>
                                                            <input class="form-control" id="proxy_addr" type="text" name="proxy_addr">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="proxy_port">代理端口，不使用Nginx/Caddy/CDN请留空</label>
                                                            <input class="form-control" id="proxy_port" type="number" name="proxy_port">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="proxy_security">代理TLS，不使用Nginx/Caddy/CDN请选择none</label>
                                                            <select id="proxy_security" class="form-control" name="proxy_security">
                                                                <option value="none" selected>none</option>
                                                                <option value="tls">tls</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade {if $inbound->network=='kcp'}active in{/if}" id="kcp">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="mtu">MTU</label>
                                                            <input class="form-control" id="mtu" type="number" name="mtu" value="{$inbound->mtu}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="tti">TTI (ms)</label>
                                                            <input class="form-control" id="tti" type="number" name="tti" value="{$inbound->tti}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="uplinkcapacity">UplinkCapacity (MB/s)</label>
                                                            <input class="form-control" id="uplinkcapacity" type="number" name="uplinkcapacity" value="{$inbound->uplinkcapacity}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="downlinkcapacity">DownlinkCapacity (MB/s)</label>
                                                            <input class="form-control" id="downlinkcapacity" type="number" name="downlinkcapacity" value="{$inbound->downlinkcapacity}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <div class="checkbox switch">
                                                                <label for="congestion">
                                                                    <input class="access-hide" id="congestion" type="checkbox" name="congestion"><span class="switch-toggle"></span>拥塞控制
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="readbuffersize">ReadBufferSize (MB)</label>
                                                            <input class="form-control" id="readbuffersize" type="number" name="readbuffersize" value="{$inbound->readbuffersize}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="writebuffersize">WriteBufferSize (MB)</label>
                                                            <input class="form-control" id="writebuffersize" type="number" name="writebuffersize" value="{$inbound->writebuffersize}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="obfs">伪装类型</label>
                                                            <select id="obfs" class="form-control" name="obfs">
                                                                <option value="none" {if $inbound->obfs=='none'}selected{/if}>none</option>
                                                                <option value="srtp" {if $inbound->obfs=='srtp'}selected{/if}>srtp</option>
                                                                <option value="utp" {if $inbound->obfs=='utp'}selected{/if}>utp</option>
                                                                <option value="wechat-video" {if $inbound->obfs=='wechat-video'}selected{/if}>wechat-video</option>
                                                                <option value="dtls" {if $inbound->obfs=='dtls'}selected{/if}>dtls</option>
                                                                <option value="wireguard" {if $inbound->obfs=='wireguard'}selected{/if}>wireguard</option>
                                                            </select>
                                                        </div>
		                                                <div class="form-group form-group-label">
		                                                    <label class="floating-label" for="seed">Seed (留空随机生成)</label>
		                                                    <input class="form-control" id="seed" type="text" name="seed" value="{$inbound->seed}">
		                                                </div>
                                                    </div>

                                                    <div class="tab-pane fade {if $inbound->network=='ws'}active in{/if}" id="ws">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="path">Path</label>
                                                            <input class="form-control" id="path" type="text" name="path" value="{$inbound->path}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="headers">Headers</label>
                                                            <textarea class="form-control" id="headers" rows="10">{$inbound->headers|json_encode}</textarea>
                                                        </div>

                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="proxy_addr">代理地址，不使用 Nginx/Caddy/CDN 请清空</label>
                                                            <input class="form-control" id="proxy_addr" type="text" name="proxy_addr" value="{$inbound->proxyaddr}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="proxy_port">代理端口，不使用 Nginx/Caddy/CDN 请清空</label>
                                                            <input class="form-control" id="proxy_port" type="number" name="proxy_port" value="{$inbound->proxyport}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="proxy_security">代理TLS，不使用 Nginx/Caddy/CDN 请选择none</label>
                                                            <select id="proxy_security" class="form-control" name="proxy_security">
                                                                <option value="none" {if $inbound->proxysecurity!='tls'}selected{/if}>none</option>
                                                                <option value="tls" {if $inbound->proxysecurity=='tls'}selected{/if}>tls</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade {if $inbound->network=='h2'}active in{/if}" id="h2">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="path">Path</label>
                                                            <input class="form-control" id="path" type="text" name="path" value="{$inbound->path}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="host">Host</label>
                                                            <textarea class="form-control" id="host" rows="10">{$inbound->host}</textarea>
                                                        </div>

                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="proxy_addr">代理地址，不使用 Caddy/CDN 请清空</label>
                                                            <input class="form-control" id="proxy_addr" type="text" name="proxy_addr" value="{$inbound->proxyaddr}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="proxy_port">代理端口，不使用 Caddy/CDN 请清空</label>
                                                            <input class="form-control" id="proxy_port" type="number" name="proxy_port" value="{$inbound->proxyport}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="proxy_security">代理TLS，不使用 Caddy/CDN 请选择none</label>
                                                            <select id="proxy_security" class="form-control" name="proxy_security">
                                                                <option value="none" {if $inbound->proxysecurity!='tls'}selected{/if}>none</option>
                                                                <option value="tls" {if $inbound->proxysecurity=='tls'}selected{/if}>tls</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade {if $inbound->network=='quic'}active in{/if}" id="quic">
                                                        <div class="form-group form-group-label">
                                                                <label class="floating-label" for="encryption">加密方式</label>
                                                                <select id="encryption" class="form-control" name="encryption">
                                                                    <option value="none" {if $inbound->encryption=='none'}selected{/if}>none</option>
                                                                    <option value="aes-128-gcm" {if $inbound->encryption=='aes-128-gcm'}selected{/if}>aes-128-gcm</option>
                                                                    <option value="chacha20-poly1305" {if $inbound->encryption=='chacha20-poly1305'}selected{/if}>chacha20-poly1305</option>
                                                                </select>
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="quic_key">Key</label>
                                                            <input class="form-control" id="quic_key" type="text" name="quic_key" value="{$inbound->quickey}">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="obfs">伪装类型</label>
                                                            <select id="obfs" class="form-control" name="obfs">
                                                                <option value="none" {if $inbound->obfs=='none'}selected{/if}>none</option>
                                                                <option value="srtp" {if $inbound->obfs=='srtp'}selected{/if}>srtp</option>
                                                                <option value="utp" {if $inbound->obfs=='utp'}selected{/if}>utp</option>
                                                                <option value="wechat-video" {if $inbound->obfs=='wechat-video'}selected{/if}>wechat-video</option>
                                                                <option value="dtls" {if $inbound->obfs=='dtls'}selected{/if}>dtls</option>
                                                                <option value="wireguard" {if $inbound->obfs=='wireguard'}selected{/if}>wireguard</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade {if $inbound->network=='domainsocket'}active in{/if}" id="domainsocket">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="path">Path</label>
                                                            <input class="form-control" id="path" type="text" name="path" value="{$inbound->path}">
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade {if $inbound->network=='grpc'}active in{/if}" id="grpc">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="servicename">serviceName</label>
                                                            <input class="form-control" id="servicename" type="text" name="servicename" value="{$inbound->servicename}">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            {/foreach}
                                        </div>
                                    </div>

								</div>
							</div>
						</div>

						<div class="card {if $node->sort!=12}access-hide{/if}" id="trojan">
							<div class="card-main">
								<div class="card-inner">
                                    {$trojan_conf=$node->trojan_conf|json_decode}
                                    <div class="form-group form-group-label">
                                        <label class="floating-label" for="local_addr">监听地址/local_addr</label>
                                        <input class="form-control" id="local_addr" type="text" name="local_addr" value="{$trojan_conf->local_addr}">
                                    </div>
                                    <div class="form-group form-group-label">
                                        <label class="floating-label" for="local_port">监听端口/local_port</label>
                                        <input class="form-control" id="local_port" type="number" name="local_port" value="{$trojan_conf->local_port}">
                                    </div>

                                    <div class="form-group form-group-label">
                                        <label class="floating-label" for="cert">证书/cert</label>
                                        <select id="cert" class="form-control" name="cert">
                                            <option value="0">none</option>
                                            {foreach $certs as $cert}
                                            <option value="{$cert->id}" {if $trojan_conf->cert==$cert->id}selected{/if}>{$cert->name}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                    <div class="form-group form-group-label">
                                        <div class="checkbox switch">
                                            <label for="prefer_server_cipher">
                                                <input {if $trojan_conf->prefer_server_cipher}checked{/if} class="access-hide" id="prefer_server_cipher" type="checkbox" name="prefer_server_cipher"><span class="switch-toggle"></span>优先服务端加密算法/prefer_server_cipher
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-label">
                                        <div class="checkbox switch">
                                            <label for="reuse_session">
                                                <input {if $trojan_conf->reuse_session}checked{/if} class="access-hide" id="reuse_session" type="checkbox" name="reuse_session"><span class="switch-toggle"></span>重用会话/reuse_session
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-label">
                                        <div class="checkbox switch">
                                            <label for="session_ticket">
                                                <input {if $trojan_conf->session_ticket}checked{/if} class="access-hide" id="session_ticket" type="checkbox" name="session_ticket"><span class="switch-toggle"></span>会话凭证/session_ticket
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-label">
                                        <label class="floating-label" for="session_timeout">会话超时/session_timeout(秒)</label>
                                        <input class="form-control" id="session_timeout" type="number" name="session_timeout" value="{$trojan_conf->session_timeout}">
                                    </div>

                                    <div class="form-group form-group-label">
                                        <div class="checkbox switch">
                                            <label for="prefer_ipv4">
                                                <input {if $trojan_conf->prefer_ipv4}checked{/if} class="access-hide" id="prefer_ipv4" type="checkbox" name="prefer_ipv4"><span class="switch-toggle"></span>优先IPv4/prefer_ipv4
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-label">
                                        <div class="checkbox switch">
                                            <label for="no_delay">
                                                <input {if $trojan_conf->no_delay}checked{/if} class="access-hide" id="no_delay" type="checkbox" name="no_delay"><span class="switch-toggle"></span>No Delay/no_delay
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-label">
                                        <div class="checkbox switch">
                                            <label for="keep_alive">
                                                <input {if $trojan_conf->keep_alive}checked{/if} class="access-hide" id="keep_alive" type="checkbox" name="keep_alive"><span class="switch-toggle"></span>保持连接/keep_alive
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-label">
                                        <div class="checkbox switch">
                                            <label for="reuse_port">
                                                <input {if $trojan_conf->reuse_port}checked{/if} class="access-hide" id="reuse_port" type="checkbox" name="reuse_port"><span class="switch-toggle"></span>重用端口/reuse_port
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-label">
                                        <div class="checkbox switch">
                                            <label for="fast_open">
                                                <input {if $trojan_conf->fast_open}checked{/if} class="access-hide" id="fast_open" type="checkbox" name="fast_open"><span class="switch-toggle"></span>快速打开/fast_open
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-label">
                                        <label class="floating-label" for="fast_open_qlen">快速打开队列容量/fast_open_qlen</label>
                                        <input class="form-control" id="fast_open_qlen" type="number" name="fast_open_qlen" value="{$trojan_conf->fast_open_qlen}">
                                    </div>

								</div>
							</div>
						</div>

						<div class="card">
							<div class="card-main">
								<div class="card-inner">

									<div class="form-group">
										<div class="row">
											<div class="col-md-10 col-md-push-1">
												<button id="submit" type="submit" class="btn btn-block btn-brand waves-attach waves-light">修改</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					{include file='dialog.tpl'}

			</div>



		</div>
	</main>











{include file='admin/footer.tpl'}


{literal}
<script>
    $('#sort').change(function() {
        $('.card#v2in').addClass('access-hide');
        $('.card#trojan').addClass('access-hide');
        switch(this.value) {
            case '11':
                $('.card#v2in').removeClass('access-hide');
                break;
            case '12':
                $('.card#trojan').removeClass('access-hide');
                break;
            default:
        }
    });

    $('#add-inbound').click(function() {
        var newid = parseInt($('#inbounds').children().last().prop('id').split('-')[1]) + 1;

        var li = $('<li><a class="waves-attach waves-effect" data-toggle="tab" href="#in-' + newid + '" aria-expanded="false"><i class="icon icon-lg">vertical_align_bottom</i>&nbsp;in-' + newid + '</a></li>');
        $('#inbounds-nav').append(li);

        var oinb = $('#inbounds').children('div.active.in');
        var inb = oinb.clone();
        inb.prop('id', 'in-' + newid);
        inb.removeClass('active in');
        inb.find('select').each(function() { // bug fix https://bugs.jquery.com/ticket/1294
        	var pathes = [];
        	var e = $(this);
        	while(!e.is(inb)) {
        		var path = e.prop('tagName').toLowerCase();
        		var id = e.prop('id');
        		if(id != undefined && id != '') {
        			path += '#' + id;
        		}
        		var classes = e.prop('class');
        		if(classes != undefined && classes != '') {
        			classes = classes.split(' ');
        			for (var i = 0; i < classes.length; i++) {
        				if(classes[i] !== '') {
        					path += '.' + classes[i];
        				}
        			}
        		}
        		pathes.push(path);
        		e = e.parent();
        	}
        	var full_path = pathes.reverse().join(' ');
			$(this).val(oinb.find(full_path).val());
        });
        inb.find('#protocol').change(function() {
            $(this).parent().siblings('#protocols').children('div.active.in').removeClass('active in');
            $(this).parent().siblings('#protocols').children('div#' + this.value ).addClass('active in');
        });
        inb.find('#network').change(function() {
            $(this).parent().siblings('#networks').children('div.active.in').removeClass('active in');
            $(this).parent().siblings('#networks').children('div#' + this.value ).addClass('active in');
        });
        inb.find('span.switch-toggle').each(function() {
            $(this).click(function(e) {
                $(this).siblings('input').prop('checked', !$(this).siblings('input').prop('checked'))
                e.preventDefault();
            });
        });
        $('#inbounds').append(inb);

        $('a[href="#in-' + newid + '"]').click();
    });

    $('#del-inbound').click(function() {
        if($('#inbounds').children().length == 1) {
            return
        }
        $('#inbounds-nav').children('.active').remove();
        $('#inbounds').children('.active').remove();
        $('#inbounds-nav a').first().click();
    });

    $('#inbounds').children().each(function() {
        $(this).find('#protocol').change(function() {
            $(this).parent().siblings('#protocols').children('div.active.in').removeClass('active in');
            $(this).parent().siblings('#protocols').children('div#' + this.value ).addClass('active in');
        });
        $(this).find('#network').change(function() {
            $(this).parent().siblings('#networks').children('div.active.in').removeClass('active in');
            $(this).parent().siblings('#networks').children('div#' + this.value ).addClass('active in');
        });
    });

    $('#inbounds').find('span.switch-toggle').each(function() {
        $(this).click(function(e) {
            $(this).siblings('input').prop('checked', !$(this).siblings('input').prop('checked'))
            e.preventDefault();
        });
    });

	$('#main_form').validate({
		rules: {
		  name: {required: true},
		  server: {required: true},
		  method: {required: true},
		  rate: {required: true},
		  info: {required: true},
		  group: {required: true},
		  status: {required: true},
		  node_speedlimit: {required: true},
		  sort: {required: true},
		  node_bandwidth_limit: {required: true},
		  bandwidthlimit_resetday: {required: true}
		},

		submitHandler: function() {
			if(document.getElementById('custom_method').checked)
			{
				var custom_method=1;
			}
			else
			{
				var custom_method=0;
			}

			if(document.getElementById('type').checked)
			{
				var type=1;
			}
			else
			{
				var type=0;
			}

			if(document.getElementById('custom_rss').checked)
			{
				var custom_rss=1;
			}
			else
			{
				var custom_rss=0;
			}

            var inbs = [];
            $("#inbounds").children().each(function() {
                var inb = {
                    "listen": $("#listen").val(),
                    "port": parseInt($("#port").val()),
                    "protocol": $("#protocol").val(),
                    // vmess
                    "alterid": parseInt($("#alterid").val()),
                    "disableinsecureencryption": $("#disable_insecure_encryption").is(":checked"),
                    // trojan
                    // "fallback": $("#fallback").val(),
                    "blockbt": $("#block_bt").is(":checked"),
                    "network": $("#network").val(),
                    "tcpfastopen": $("#tcpfastopen").val(),
                    // tcp
                    "obfs": $("#tcp #obfs").val(),
                    "httprequest": JSON.parse($("#tcp #http_request").val()),
                    "httpresponse": JSON.parse($("#tcp #http_response").val()),
                    // kcp
                    "mtu": parseInt($("#kcp #mtu").val()),
                    "tti": parseInt($("#kcp #tti").val()),
                    "uplinkcapacity": parseInt($("#kcp #uplinkcapacity").val()),
                    "downlinkcapacity": parseInt($("#kcp #downlinkcapacity").val()),
                    "congestion": $("#kcp #congestion").is(":checked"),
                    "readbuffersize": parseInt($("#kcp #readbuffersize").val()),
                    "writebuffersize": parseInt($("#kcp #writebuffersize").val()),
                    "obfs": $("#kcp #obfs").val(),
                    "seed": $("#kcp #seed").val(),
                    // ws
                    "path": $("#ws #path").val(),
                    "headers": JSON.parse($("#ws #headers").val()),
                    // h2
                    "host": $("#h2 #host").val(),
                    "path": $("#h2 #path").val(),
                    // quic
                    "encryption": $("#quic #encryption").val(),
                    "quickey": $("#quic #quic_key").val(),
                    "obfs": $("#quic #obfs").val(),
                    // domainsocket
                    "path": $("#domainsocket #path").val(),
                    // grpc
                    "servicename": $("#grpc #servicename").val(),
                    // reverse proxy
                    "proxyaddr": $("#ws #proxy_addr").val(),
                    "proxyport": parseInt($("#ws #proxy_port").val()),
                    "proxysecurity": $("#ws #proxy_security").val(),
                    // tls
                    "security": $("#security").val(),
                    "cert": parseInt($("#v2in #cert").val()),
                    "xtls": $("#xtls").val()
                };
                inb["path"] = '';
                inb["obfs"] = '';
                if ($("#" + $("#network").val() + " #path").val() != undefined) {
                	inb["path"] = $("#" + $("#network").val() + " #path").val();
                }
                if ($("#" + $("#network").val() + " #obfs").val() != undefined) {
                	inb["obfs"] = $("#" + $("#network").val() + " #obfs").val();
                }
                inbs.push(inb);
            });

            var trojan_conf = {
                    "local_addr": $("#trojan #local_addr").val(),
                    "local_port": parseInt($("#trojan #local_port").val()),
                    "cert": parseInt($("#trojan #cert").val()),
                    "prefer_server_cipher": $("#trojan #prefer_server_cipher").is(":checked"),
                    "reuse_session": $("#trojan #reuse_session").is(":checked"),
                    "session_ticket": $("#trojan #session_ticket").is(":checked"),
                    "session_timeout": parseInt($("#trojan #session_timeout").val()),
                    "prefer_ipv4": $("#trojan #prefer_ipv4").is(":checked"),
                    "no_delay": $("#trojan #no_delay").is(":checked"),
                    "keep_alive": $("#trojan #keep_alive").is(":checked"),
                    "reuse_port": $("#trojan #reuse_port").is(":checked"),
                    "fast_open": $("#trojan #fast_open").is(":checked"),
                    "fast_open_qlen": parseInt($("#trojan #fast_open_qlen").val())
                };
{/literal}
            $.ajax({
                type: "PUT",
                url: "/admin/node/{$node->id}",
                dataType: "json",
                data: {
                    name: $("#name").val(),
                    server: $("#server").val(),
                    node_ip: $("#node_ip").val(),
                    method: $("#method").val(),
                    custom_method: custom_method,
                    rate: $("#rate").val(),
                    info: $("#info").val(),
                    type: type,
                    group: $("#group").val(),
                    status: $("#status").val(),
                    sort: $("#sort").val(),
                    node_speedlimit: $("#node_speedlimit").val(),
                    class: $("#class").val(),
                    node_bandwidth_limit: $("#node_bandwidth_limit").val(),
                    bandwidthlimit_resetday: $("#bandwidthlimit_resetday").val(),
                    custom_rss: custom_rss,
                    mu_only: $("#mu_only").val(),
                    v2conf: JSON.stringify(inbs),
                    trojan_conf: JSON.stringify(trojan_conf)
                },
                success: function (data) {
                    if (data.ret) {
                        $("#result").modal();
                        $("#msg").html(data.msg);
                        window.setTimeout("location.href='/admin/node'", {$config['jump_delay']});
{literal}
                    } else {
                        $("#result").modal();
                        $("#msg").html(data.msg);
                    }
                },
                error: function (jqXHR) {
                    $("#result").modal();
                    $("#msg").html(data.msg+"  发生错误了。");
                }
            });
        }
    });

{/literal}
</script>
