
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
													<option value="1">V2Ray</option>
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

						<div class="card">
							<div class="card-main">
								<div class="card-inner">
                                        <div class="pull-right">
                                            <button class="btn btn-flat waves-attach waves-effect" id="add-inbound"><span class="icon icon-lg">add</span>&nbsp;添加</button>
                                        </div>
                                    
                                    <nav class="tab-nav margin-top-no">
                                        <ul class="nav nav-list">
                                            <li class="active">
                                                <a class="waves-attach" data-toggle="tab" href="#inbound-1"><i class="icon icon-lg">vertical_align_bottom</i>&nbsp;inbound-1</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    
									<div class="card-inner">
										<div class="tab-content" id="inbounds">
											<div class="tab-pane fade active in" id="inbound-1">
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
                                                                <option value="0" selected>VMess</option>
                                                                <option value="1" disabled>Socks</option>
                                                                <option value="2" disabled>Shadowsocks</option>
                                                                <option value="3" disabled>MTProto</option>
                                                                <option value="4" disabled>HTTP</option>
                                                                <option value="5" disabled>Freedom</option>
                                                                <option value="6" disabled>Dokodemo-door</option>
                                                                <option value="7" disabled>Blackhole</option>
                                                            </select>
                                                        </div>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <div class="checkbox switch">
                                                        <label for="disableinsecureencryption">
                                                            <input checked class="access-hide" id="disableinsecureencryption" type="checkbox" name="disableinsecureencryption"><span class="switch-toggle"></span>禁用不安全的加密方式
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <div class="checkbox switch">
                                                        <label for="sniffing">
                                                            <input checked class="access-hide" id="sniffing" type="checkbox" name="sniffing"><span class="switch-toggle"></span>开启探测流量
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <div class="form-group form-group-label">
                                                            <label class="floating-label" for="network">传输类型</label>
                                                            <select id="network" class="form-control" name="network">
                                                                <option value="0">TCP</option>
                                                                <option value="1">mKCP</option>
                                                                <option value="2" selected>WebSocket</option>
                                                                <option value="3">HTTP/2</option>
                                                                <option value="4">DomainSocket</option>
                                                                <option value="5">QUIC</option>
                                                            </select>
                                                        </div>
                                                </div>
                                                
                                                <div class="tab-content" id="network_tabs">
                                                    <div class="tab-pane fade" id="tcp">
                                                        暂不支持此传输类型
                                                    </div>

                                                    <div class="tab-pane fade" id="kcp">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="kcp_mtu">MTU</label>
                                                            <input class="form-control" id="kcp_mtu" type="number" name="kcp_mtu" value="1350">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="kcp_tti">TTI (ms)</label>
                                                            <input class="form-control" id="kcp_tti" type="number" name="kcp_tti" value="20">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="kcp_uplinkcapacity">UplinkCapacity (MB/s)</label>
                                                            <input class="form-control" id="kcp_uplinkcapacity" type="number" name="kcp_uplinkcapacity" value="5">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="kcp_downlinkcapacity">DownlinkCapacity (MB/s)</label>
                                                            <input class="form-control" id="kcp_downlinkcapacity" type="number" name="kcp_downlinkcapacity" value="20">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <div class="checkbox switch">
                                                                <label for="kcp_congestion">
                                                                    <input class="access-hide" id="kcp_congestion" type="checkbox" name="kcp_congestion"><span class="switch-toggle"></span>拥塞控制
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="kcp_readbuffersize">ReadBufferSize (MB)</label>
                                                            <input class="form-control" id="kcp_readbuffersize" type="number" name="kcp_readbuffersize" value="2">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="kcp_writebuffersize">WriteBufferSize (MB)</label>
                                                            <input class="form-control" id="kcp_writebuffersize" type="number" name="kcp_writebuffersize" value="2">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <div class="form-group form-group-label">
                                                                    <label class="floating-label" for="network">伪装类型</label>
                                                                    <select id="network" class="form-control" name="network">
                                                                        <option value="0">none</option>
                                                                        <option value="1">srtp</option>
                                                                        <option value="2">utp</option>
                                                                        <option value="3" selected>wechat-video</option>
                                                                        <option value="4">dtls</option>
                                                                        <option value="5">wireguard</option>
                                                                    </select>
                                                                </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade active in" id="websocket">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="ws_path">Path</label>
                                                            <input class="form-control" id="ws_path" type="text" name="ws_path" value="/ws">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="ws_headers">Headers</label>
                                                            <textarea class="form-control" id="ws_headers" rows="15">"Host": "v2ray.com","Host": "baidu.com"</textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="tab-pane fade" id="http2">
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="h2_path">Path</label>
                                                            <input class="form-control" id="h2_path" type="text" name="h2_path" value="/ws">
                                                        </div>
                                                        <div class="form-group form-group-label">
                                                            <label class="floating-label" for="h2_hosts">Host</label>
                                                            <textarea class="form-control" id="h2_hosts" rows="15">"v2ray.com","baidu.com"</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="domainsocket">
                                                        暂不支持此传输类型
                                                    </div>

                                                    <div class="tab-pane fade" id="quic">
                                                        暂不支持此传输类型
                                                    </div>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <div class="form-group form-group-label">
                                                            <label class="floating-label" for="security">TLS</label>
                                                            <select id="security" class="form-control" name="security">
                                                                <option value="0">none</option>
                                                                <option value="1" selected>tls</option>
                                                            </select>
                                                        </div>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="cert">证书/cert</label>
                                                    <textarea class="form-control" id="cert" rows="15"></textarea>
                                                </div>

                                                <div class="form-group form-group-label">
                                                    <label class="floating-label" for="key">私钥/key</label>
                                                    <textarea class="form-control" id="key" rows="15"></textarea>
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
    $( "#network" ).change(function() {
      $("#network_tabs").children(".tab-pane, .fade, div").removeClass("active in");
      switch(this.value) {
        case "0":
           $("#tcp").addClass("active in");
           break;
        case "1":
           $("#kcp").addClass("active in");
           break;
        case "2":
           $("#websocket").addClass("active in");
           break;
        case "3":
           $("#http2").addClass("active in");
           break;
        case "4":
           $("#domainsocket").addClass("active in");
           break;
        case "5":
           $("#quic").addClass("active in");
           break;
        default:
           break;
      }
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
			{/literal}
			if(document.getElementById('custom_rss').checked)
			{
				var custom_rss=1;
			}
			else
			{
				var custom_rss=0;
			}


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
										mu_only: $("#mu_only").val()
                },
                success: function (data) {
                    if (data.ret) {
                        $("#result").modal();
                        $("#msg").html(data.msg);
                        window.setTimeout("location.href=top.document.referrer", {$config['jump_delay']});
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

</script>
