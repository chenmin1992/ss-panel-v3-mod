
{include file='admin/main.tpl'}







	<main class="content">
		<div class="content-header ui-content-header">
			<div class="container">
				<h1 class="content-heading">添加节点</h1>
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
										<input class="form-control" id="name" type="text" name="name">
									</div>


									<div class="form-group form-group-label">
										<label class="floating-label" for="server">节点地址</label>
										<input class="form-control" id="server" type="text" name="server">
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="server">节点IP(不填则自动获取，填写请按照 <a href="https://github.com/esdeathlove/ss-panel-v3-mod/wiki/%E8%8A%82%E7%82%B9IP%E5%A1%AB%E5%86%99%E8%A7%84%E5%88%99">这里</a> 的规则进行填写)</label>
										<input class="form-control" id="node_ip" name="node_ip" type="text">
									</div>

									<div class="form-group form-group-label" hidden="hidden">
										<label class="floating-label" for="method">加密方式</label>
										<input class="form-control" id="method" type="text" name="method" value="aes-256-cfb">
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="rate">流量比例</label>
										<input class="form-control" id="rate" type="text" name="rate">
									</div>

									<div class="form-group form-group-label" hidden="hidden">
										<div class="checkbox switch">
											<label for="custom_method">
												<input  class="access-hide" id="custom_method" type="checkbox" name="custom_method" checked="checked" disabled><span class="switch-toggle"></span>自定义加密
											</label>
										</div>
									</div>

									<div class="form-group form-group-label" hidden="hidden">
										<div class="checkbox switch">
											<label for="custom_rss">
												<input  class="access-hide" id="custom_rss" type="checkbox" name="custom_rss" checked="checked" disabled><span class="switch-toggle"></span>自定义协议&混淆
											</label>
										</div>
									</div>

									<div class="form-group form-group-label">
										<label for="mu_only">
											<label class="floating-label" for="sort">单端口多用户启用</label>
											<select id="mu_only" class="form-control" name="is_multi_user">
												<option value="0">单端口多用户与普通端口并存</option>
												<option value="-1">只启用普通端口</option>
												<option value="1">只启用单端口多用户</option>
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
												<input checked class="access-hide" id="type" type="checkbox" name="type"><span class="switch-toggle"></span>是否显示
											</label>
										</div>
									</div>


									<div class="form-group form-group-label">
										<label class="floating-label" for="status">节点状态</label>
										<input class="form-control" id="status" type="text" name="status">
									</div>

									<div class="form-group form-group-label">
										<div class="form-group form-group-label">
												<label class="floating-label" for="sort">节点类型</label>
												<select id="sort" class="form-control" name="sort">
													<option value="0">Shadowsocks</option>
													<option value="1">VPN/Radius基础</option>
													<option value="2">SSH</option>
													<option value="3">PAC</option>
													<option value="4">APN文件外链</option>
													<option value="5">Anyconnect</option>
													<option value="6">APN</option>
													<option value="7">PAC PLUS(Socks 代理生成 PAC文件)</option>
													<option value="8">PAC PLUS PLUS(HTTPS 代理生成 PAC文件)</option>
													<option value="9">Shadowsocks 单端口多用户</option>
													<option value="10">Shadowsocks 中转</option>
													<option value="11">V2Ray</option>
												</select>
											</div>
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="info">节点描述</label>
										<input class="form-control" id="info" type="text" name="info">
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="class">节点等级（不分级请填0，分级为数字）</label>
										<input class="form-control" id="class" type="text" value="0" name="class">
									</div>


									<div class="form-group form-group-label">
										<label class="floating-label" for="group">节点群组（分组为数字，不分组请填0）</label>
										<input class="form-control" id="group" type="text" value="0" name="group">
									</div>


									<div class="form-group form-group-label">
										<label class="floating-label" for="node_bandwidth_limit">节点流量上限（不使用的话请填0）（GB）</label>
										<input class="form-control" id="node_bandwidth_limit" type="text" value="0" name="node_bandwidth_limit">
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="bandwidthlimit_resetday">节点流量上限清空日</label>
										<input class="form-control" id="bandwidthlimit_resetday" type="text" value="0" name="bandwidthlimit_resetday">
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="node_speedlimit">节点限速(对于每个用户端口)（Mbps）</label>
										<input class="form-control" id="node_speedlimit" type="text" value="0" name="node_speedlimit">
									</div>
								</div>
							</div>
						</div>

						<div class="card access-hide" id="v2in">
							<div class="card-main">
								<div class="card-inner">
									<p><h4>V2Ray设置</h4></p>

                                    <button class="btn btn-flat waves-attach" type="button" id="add-inbound"><span class="icon icon-lg">add</span>&nbsp;添加一个Inbound</button>
                                    <button class="btn btn-flat waves-attach" type="button" id="del-inbound"><span class="icon icon-lg">clear</span>&nbsp;移除当前Inbound</button>

                                    <nav class="tab-nav margin-top-no">
                                        <ul class="nav nav-list" id="inbounds-nav">
                                            <li class="active">
                                                <a class="waves-attach waves-effect" data-toggle="tab" href="#in-0"><i class="icon icon-lg">vertical_align_bottom</i>&nbsp;in-0</a>
                                            </li>
                                        </ul>
                                    </nav>

									<div class="card-inner">
										<div class="tab-content" id="inbounds">
											<div class="tab-pane fade active in" id="in-0">
                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="listen">监听地址</label>
                                                    <input class="form-control" id="listen" type="text" name="listen">
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="port">端口</label>
                                                    <input class="form-control" id="port" type="number" name="port">
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <div class="form-group form-group-label">
                                                            <label class="floating-label" for="protocol">协议</label>
                                                            <select id="protocol" class="form-control" name="protocol">
                                                                <option value="vmess" selected>VMess</option>
                                                                <option value="socks" disabled>Socks</option>
                                                                <option value="shadowsocks" disabled>Shadowsocks</option>
                                                                <option value="mtproto" disabled>MTProto</option>
                                                                <option value="http" disabled>HTTP</option>
                                                                <option value="dokodemo-door" disabled>Dokodemo-door</option>
                                                                <option value="dns" disabled>DNS</option>
                                                                <option value="blackhole" disabled>Blackhole</option>
                                                            </select>
                                                        </div>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="alterid">AlterId</label>
                                                    <input class="form-control" id="alterid" type="number" name="alterid" value="32">
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <div class="checkbox switch">
                                                        <label for="disable_insecure_encryption">
                                                            <input checked class="access-hide" id="disable_insecure_encryption" type="checkbox" name="disable_insecure_encryption"><span class="switch-toggle"></span>禁用不安全的加密方式
                                                        </label>
                                                    </div>
                                                </div>

			                                    <div class="form-group form-group-label">
			                                        <div class="checkbox switch">
			                                            <label for="block_bt">
			                                                <input checked class="access-hide" id="block_bt" type="checkbox" name="block_bt"><span class="switch-toggle"></span>禁止BT下载
			                                            </label>
			                                        </div>
			                                    </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="security">TLS</label>
                                                    <select id="security" class="form-control" name="security">
                                                        <option value="none" selected>none</option>
                                                        <option value="tls">tls</option>
                                                    </select>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="cert">证书/cert</label>
                                                    <select id="cert" class="form-control" name="cert">
                                                        <option value="0" selected>none</option>
														{foreach $certs as $cert}
                                                        <option value="{$cert->id}">{$cert->name}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="network">传输类型</label>
                                                    <select id="network" class="form-control" name="network">
                                                        <option value="tcp">TCP</option>
                                                        <option value="kcp">mKCP</option>
                                                        <option value="ws" selected>WebSocket</option>
                                                        <option value="h2">HTTP/2</option>
                                                        <option value="domainsocket">DomainSocket</option>
                                                        <option value="quic">QUIC</option>
                                                    </select>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="tcpfastopen">TCP Fast Open</label>
                                                    <select id="tcpfastopen" class="form-control" name="tcpfastopen">
                                                        <option value="none" selected>跟随系统</option>
                                                        <option value="true">强制开启</option>
                                                        <option value="false">强制关闭</option>
                                                    </select>
                                                </div>

                                                <div class="tab-content" id="networks">
                                                    <div class="tab-pane fade" id="tcp">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="obfs">Header</label>
                                                            <select id="obfs" class="form-control" name="obfs">
                                                                <option value="none">none</option>
                                                                <option value="http" selected>http</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="http_request">HTTP Request</label>
                                                            <textarea class="form-control" id="http_request" rows="15">{
  "version": "1.1",
  "method": "GET",
  "path": ["/"],
  "headers": {
    "Host": ["www.github.com", "www.bing.com"],
    "User-Agent": [
      "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36",
      "Mozilla/5.0 (iPhone; CPU iPhone OS 10_0_2 like Mac OS X) AppleWebKit/601.1 (KHTML, like Gecko) CriOS/53.0.2785.109 Mobile/14A456 Safari/601.1.46"
    ],
    "Accept-Encoding": ["gzip, deflate"],
    "Connection": ["keep-alive"],
    "Pragma": "no-cache"
  }
}</textarea>
                                                        </div>

                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="http_response">HTTP Response</label>
                                                            <textarea class="form-control" id="http_response" rows="15">{
  "version": "1.1",
  "status": "200",
  "reason": "OK",
  "headers": {
    "Content-Type": ["application/octet-stream", "video/mpeg"],
    "Transfer-Encoding": ["chunked"],
    "Connection": ["keep-alive"],
    "Pragma": "no-cache"
  }
}</textarea>
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

                                                    <div class="tab-pane fade" id="kcp">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="mtu">MTU</label>
                                                            <input class="form-control" id="mtu" type="number" name="mtu" value="1350">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="tti">TTI (ms)</label>
                                                            <input class="form-control" id="tti" type="number" name="tti" value="20">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="uplinkcapacity">UplinkCapacity (MB/s)</label>
                                                            <input class="form-control" id="uplinkcapacity" type="number" name="uplinkcapacity" value="5">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="downlinkcapacity">DownlinkCapacity (MB/s)</label>
                                                            <input class="form-control" id="downlinkcapacity" type="number" name="downlinkcapacity" value="20">
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
                                                            <input class="form-control" id="readbuffersize" type="number" name="readbuffersize" value="2">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="writebuffersize">WriteBufferSize (MB)</label>
                                                            <input class="form-control" id="writebuffersize" type="number" name="writebuffersize" value="2">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="obfs">伪装类型</label>
                                                            <select id="obfs" class="form-control" name="obfs">
                                                                <option value="none">none</option>
                                                                <option value="srtp">srtp</option>
                                                                <option value="utp">utp</option>
                                                                <option value="wechat-video" selected>wechat-video</option>
                                                                <option value="dtls">dtls</option>
                                                                <option value="wireguard">wireguard</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade active in" id="ws">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="path">Path</label>
                                                            <input class="form-control" id="path" type="text" name="path" value="/ws">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="headers">Headers</label>
                                                            <textarea class="form-control" id="headers" rows="10">{}</textarea>
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

                                                    <div class="tab-pane fade" id="h2">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="path">Path</label>
                                                            <input class="form-control" id="path" type="text" name="path" value="/h2">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="host">Host</label>
                                                            <textarea class="form-control" id="host" rows="10">www.baidu.com,www.bing.com</textarea>
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

                                                    <div class="tab-pane fade" id="domainsocket">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="path">Path</label>
                                                            <input class="form-control" id="path" type="text" name="path" value="/tmp/v2ray.sock">
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="quic">
                                                        <div class="form-group form-group-label">
                                                                <label class="floating-label" for="encryption">加密方式</label>
                                                                <select id="encryption" class="form-control" name="encryption">
                                                                    <option value="none" selected>none</option>
                                                                    <option value="aes-128-gcm">aes-128-gcm</option>
                                                                    <option value="chacha20-poly1305">chacha20-poly1305</option>
                                                                </select>
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="quic_key">Key</label>
                                                            <input class="form-control" id="quic_key" type="text" name="quic_key">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="obfs">伪装类型</label>
                                                            <select id="obfs" class="form-control" name="obfs">
                                                                <option value="none">none</option>
                                                                <option value="srtp">srtp</option>
                                                                <option value="utp">utp</option>
                                                                <option value="wechat-video" selected>wechat-video</option>
                                                                <option value="dtls">dtls</option>
                                                                <option value="wireguard">wireguard</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
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
												<button id="submit" type="submit" class="btn btn-block btn-brand waves-attach waves-light">添加</button>
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
        if(this.value == '11') {
            $('#v2in').removeClass('access-hide');
        } else {
            $('#v2in').addClass('access-hide');
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
            $(this).val(oinb.find('select#'+$(this).prop('id')).val());
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
					"listen": $(this).find("#listen").val(),
					"port": parseInt($(this).find("#port").val()),
					"protocol": $(this).find("#protocol").val(),
					"alterid": parseInt($(this).find("#alterid").val()),
					"disableinsecureencryption": $(this).find("#disable_insecure_encryption").is(":checked"),
					"blockbt": $(this).find("#block_bt").is(":checked"),
					"network": $(this).find("#network").val(),
					"tcpfastopen": $(this).find("#tcpfastopen").val(),
					// tcp
					"obfs": "none",
					"httprequest": {},
					"httpresponse": {},
					// kcp
					"mtu": 1350,
					"tti": 20,
					"uplinkcapacity": 5,
					"downlinkcapacity": 20,
					"congestion": false,
					"readbuffersize": 1,
					"writebuffersize": 1,
					"obfs": "wechat-video",
					// ws
					"path": "",
					"headers": {},
					// h2
					"host": "",
					"path": "",
					// quic
					"encryption": "none",
					"quickey": "",
					"obfs": "wechat-video",
					// reverse proxy
					"proxyaddr": "",
					"proxyport": 0,
					"proxysecurity": "none",
					// tls
					"security": $(this).find("#security").val(),
					"cert": 0
				};
				if(inb["network"] == "tcp") {
					inb["obfs"] = $(this).find("#tcp #obfs").val();
					try { inb["httprequest"] = JSON.parse($(this).find("#tcp #http_request").val()); } catch(err) {}
					try { inb["httpresponse"] = JSON.parse($(this).find("#tcp #http_response").val()); } catch(err) {}
				}
				if(inb["network"] == "kcp") {
					inb["mtu"] = parseInt($(this).find("#kcp #mtu").val());
					inb["tti"] = parseInt($(this).find("#kcp #tti").val());
					inb["uplinkcapacity"] = parseInt($(this).find("#kcp #uplinkcapacity").val());
					inb["downlinkcapacity"] = parseInt($(this).find("#kcp #downlinkcapacity").val());
					inb["congestion"] = $(this).find("#kcp #congestion").is(":checked");
					inb["readbuffersize"] = parseInt($(this).find("#kcp #readbuffersize").val());
					inb["writebuffersize"] = parseInt($(this).find("#kcp #writebuffersize").val());
					inb["obfs"] = $(this).find("#kcp #obfs").val();
				}
				if(inb["network"] == "ws") {
					inb["path"] = $(this).find("#ws #path").val();
					try { inb["headers"] = JSON.parse($(this).find("#ws #headers").val()); } catch(err) {}
					inb["proxyaddr"] = $(this).find("#ws #proxy_addr").val();
					inb["proxyport"] = parseInt($(this).find("#ws #proxy_port").val());
					inb["proxysecurity"] = $(this).find("#ws #proxy_security").val();
				}
				if(inb["network"] == "h2") {
					inb["host"] = $(this).find("#h2 #host").val();
					inb["path"] = $(this).find("#h2 #path").val();
					inb["proxyaddr"] = $(this).find("#h2 #proxy_addr").val();
					inb["proxyport"] = parseInt($(this).find("#h2 #proxy_port").val());
					inb["proxysecurity"] = $(this).find("#h2 #proxy_security").val();
				}
				if(inb["network"] == "domainsocket") {
					inb["path"] = $(this).find("#domainsocket #path").val();
				}
				if(inb["network"] == "quic") {
					inb["encryption"] = $(this).find("#quic #encryption").val();
					inb["quickey"] = $(this).find("#quic #quic_key").val();
					inb["obfs"] = $(this).find("#quic #obfs").val();
				}
				if(inb["security"] == "tls") {
					inb["cert"] = parseInt($(this).find("#cert").val());
				}
				inbs.push(inb);
			});

{/literal}
            $.ajax({
                type: "POST",
                url: "/admin/node",
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
					node_speedlimit: $("#node_speedlimit").val(),
                    sort: $("#sort").val(),
					class: $("#class").val(),
					node_bandwidth_limit: $("#node_bandwidth_limit").val(),
					bandwidthlimit_resetday: $("#bandwidthlimit_resetday").val(),
					custom_rss: custom_rss,
					mu_only: $("#mu_only").val(),
					v2conf: JSON.stringify(inbs)
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
