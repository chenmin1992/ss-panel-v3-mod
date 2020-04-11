


{include file='user/header_info.tpl'}


{$trojan_item = URL::getTrojanItem($user, $node, $node->trojan_conf|json_decode)}



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
											<p>服务器地址：{$trojan_item['address']}<br>
											服务器端口：{$trojan_item['port']}<br></p>
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
											<p><i class="icon icon-lg">desktop_windows</i>&nbsp;<a href="/ssr-download/trojan-win.zip" target="_blank">Windows</a></p>
											<p><i class="icon icon-lg">laptop_mac</i>&nbsp;<a href="/ssr-download/trojan-mac.dmg" target="_blank">Mac OS X</a></p>
											<p><i class="icon icon-lg">laptop_windows</i>&nbsp;<a href="https://github.com/trojan-gfw/trojan/releases/latest" target="_blank">Linux</a></p>
											<p><i class="icon icon-lg">android</i>&nbsp;<a href="/ssr-download/trojan-android.apk" target="_blank">Android</a></p>
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
										<p class="card-heading">配置Json</p>

										<div class="tab-content">
											<textarea class="form-control" rows="6">
{
    "run_type": "client",
    "local_addr": "127.0.0.1",
    "local_port": 1080,
    "remote_addr": "{$trojan_item['address']}",
    "remote_port": {$trojan_item['port']},
    "password": [
        "{$trojan_item['passwd']}"
    ],
    "log_level": 1,
    "ssl": {
        "verify": true,
        "verify_hostname": true,
        "cert": "",
        "cipher": "ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-CHACHA20-POLY1305:ECDHE-RSA-CHACHA20-POLY1305:ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-AES256-SHA:ECDHE-ECDSA-AES128-SHA:ECDHE-RSA-AES128-SHA:ECDHE-RSA-AES256-SHA:DHE-RSA-AES128-SHA:DHE-RSA-AES256-SHA:AES128-SHA:AES256-SHA:DES-CBC3-SHA",
        "cipher_tls13": "TLS_AES_128_GCM_SHA256:TLS_CHACHA20_POLY1305_SHA256:TLS_AES_256_GCM_SHA384",
        "sni": "",
        "alpn": [
            "h2",
            "http/1.1"
        ],
        "reuse_session": {if $trojan_item['reuse_session']==1}true{else}false{/if},
        "session_ticket": {if $trojan_item['session_ticket']==1}true{else}false{/if},
        "curves": ""
    },
    "tcp": {
        "no_delay": {if $trojan_item['no_delay']==1}true{else}false{/if},
        "keep_alive": {if $trojan_item['keep_alive']==1}true{else}false{/if},
        "reuse_port": {if $trojan_item['reuse_port']==1}true{else}false{/if},
        "fast_open": {if $trojan_item['fast_open']==1}true{else}false{/if},
        "fast_open_qlen": {$trojan_item['fast_open_qlen']/10}
    }
}
</textarea>
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
											<p><a href="{URL::getTrojanItemUrl($trojan_item)}"/>手机上用默认浏览器打开点我就可以直接添加了(iOS 给 Shadowrocket, Android 给 igniter)</a></p>
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
											<div id="trojan-qr-n"></div>
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
	var text_qrcode = '{URL::getTrojanItemUrl($trojan_item)}';
	jQuery('#trojan-qr-n').qrcode({
		"text": text_qrcode
	});
</script>
