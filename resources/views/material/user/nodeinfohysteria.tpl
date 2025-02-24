


{include file='user/header_info.tpl'}


{$hysteria_item = URL::getHysteriaItem($user, $node, $node->hysteria_conf|json_decode)}



	<main class="content">
		<div class="content-header ui-content-header">
			<div class="container">
				<h1 class="content-heading">节点信息</h1>
			</div>
		</div>
		<div class="container">
			<section class="content-inner margin-top-no">
				<div class="ui-card-wrap">
					<div class="row">
						<div class="col-lg-12 col-sm-12">
							<div class="card">
								<div class="card-main">
									<div class="card-inner margin-bottom-no">
										<p class="card-heading">注意！</p>
										<p>配置文件以及二维码请勿泄露！</p>
									</div>

								</div>
							</div>
						</div>


						<div class="col-lg-12 col-sm-12">
							<div class="card">
								<div class="card-main">
									<div class="card-inner margin-bottom-no">
										<p class="card-heading">配置信息</p>
										<div class="tab-content">
											<p>服务器地址：{$hysteria_item['server']}<br>
											服务器端口：{$hysteria_item['ports']}<br>
											混淆密码：{$hysteria_item['obfs_password']}<br>
											上行速度：{$hysteria_item['up']}<br>
											下行速度：{$hysteria_item['down']}<br></p>
										</div>
									</div>
								</div>
							</div>
						</div>



						<div class="col-lg-12 col-sm-12">
							<div class="card">
								<div class="card-main">
									<div class="card-inner margin-bottom-no">
										<p class="card-heading">客户端下载</p>
										<div class="tab-content">
											<p><i class="icon icon-lg">desktop_windows</i>&nbsp;<a href="/ssr-download/hysteria-win.zip" target="_blank">Windows</a></p>
											<p><i class="icon icon-lg">laptop_mac</i>&nbsp;<a href="/ssr-download/hysteria-mac.dmg" target="_blank">Mac OS X</a></p>
											<p><i class="icon icon-lg">laptop_windows</i>&nbsp;<a href="https://github.com/hysteria-gfw/hysteria/releases/latest" target="_blank">Linux</a></p>
											<p><i class="icon icon-lg">android</i>&nbsp;<a href="/ssr-download/hysteria-android.apk" target="_blank">Android</a></p>
											<p><i class="icon icon-lg">phone_iphone</i>&nbsp;<a href="https://itunes.apple.com/us/app/shadowrocket/id932747118" target="_blank">iOS</a></p>
										</div>	
									</div>

								</div>
							</div>
						</div>

						<div class="col-lg-12 col-sm-12">
							<div class="card">
								<div class="card-main">
									<div class="card-inner margin-bottom-no">
										<p class="card-heading">配置 Yaml</p>

										<div class="tab-content">
											<textarea class="form-control" rows="6">
server: {$hysteria_item['server']}
auth: {$hysteria_item['auth']}
tls:
  sni: {$hysteria_item['sni']}
  insecure: false
transport:
  type: udp
  udp:
    hopInterval: 30s
{if !empty($hysteria_item['obfs_password'])}
obfs:
  type: $hysteria_item['obfs']
  salamander:
    password: $hysteria_item['obfs_password']
{/if}
quic:
  initStreamReceiveWindow: 8388608
  maxStreamReceiveWindow: 8388608
  initConnReceiveWindow: 20971520
  maxConnReceiveWindow: 20971520
  maxIdleTimeout: 30s
  keepAlivePeriod: 10s
  disablePathMTUDiscovery: false
bandwidth:
  up: {$hysteria_item['up']} mbps
  down: {$hysteria_item['down']} mbps
fastOpen: {if $hysteria_item['fast_open'] == 1}true{else}false{/if}

socks5:
  listen: 127.0.0.1:1080
  disableUDP: false
http:
  listen: 127.0.0.1:8080</textarea>
										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="col-lg-12 col-sm-12">
							<div class="card">
								<div class="card-main">
									<div class="card-inner margin-bottom-no">
										<p class="card-heading">配置链接</p>
										<div class="tab-content">
											<p><a href="{URL::getHysteriaItemUrl($hysteria_item)}"/>手机上用默认浏览器打开点我就可以直接添加了(iOS 给 Shadowrocket, Android 给 igniter)</a></p>
										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="col-lg-12 col-sm-12">
							<div class="card">
								<div class="card-main">
									<div class="card-inner margin-bottom-no">
										<p class="card-heading">配置二维码</p>
										<div class="tab-content text-center">
											<div id="hysteria-qr-n"></div>
										</div>
									</div>

								</div>
							</div>
						</div>



					</div>
				</div>
			</section>
		</div>
	</main>







{include file='user/footer.tpl'}


<script src="/assets/public/js/jquery.qrcode.min.js"></script>
<script>
	var text_qrcode = '{URL::getHysteriaItemUrl($hysteria_item)}';
	jQuery('#hysteria-qr-n').qrcode({
		"text": text_qrcode
	});
</script>
