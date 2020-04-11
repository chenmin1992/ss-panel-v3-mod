


{include file='user/header_info.tpl'}




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

                                            <nav class="tab-nav margin-top-no">
                                                <ul class="nav nav-list" id="inbounds-nav">
                                                    {foreach from=$node->v2conf|json_decode key=index item=inbound}
                                                    <li {if $index==0}class="active"{/if}>
                                                        <a class="waves-attach waves-effect" data-toggle="tab" href="#info-{$index}"><i class="icon icon-lg">vertical_align_bottom</i>&nbsp;in-{$index}</a>
                                                    </li>
                                                    {/foreach}
                                                </ul>
                                            </nav>
                                            <div class="tab-content">
                                                {foreach from=$node->v2conf|json_decode key=index item=inbound}
                                                <div class="tab-pane fade {if $index==0}active in{/if}" id="info-{$index}">
                                                    {$v2ray_item = URL::getV2rayItem($user, $node, $inbound, 2)}
                                                    <p>服务器地址：{$v2ray_item['add']}<br>
                                                    服务器端口：{$v2ray_item['port']}<br>
                                                    UUID：{$v2ray_item['id']}<br>
                                                    额外ID：{$v2ray_item['aid']}<br>
                                                    传输类型：{$v2ray_item['net']}<br>
                                                    TLS：{$v2ray_item['tls']}<br></p>
                                                </div>
                                                {/foreach}
                                            </div>
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

										<div class="tab-pane fade active in" id="v2ray_download">
                                            <p><i class="icon icon-lg">desktop_windows</i>&nbsp;<a href="/ssr-download/v2ray-win.7z">Windows</a></p>
                                            <p><i class="icon icon-lg">laptop_mac</i>&nbsp;<a href="/ssr-download/v2ray-mac.dmg">Mac OS X</a></p>
                                            <p><i class="icon icon-lg">laptop_windows</i>&nbsp;<a href="https://github.com/v2ray/v2ray-core/releases">Linux</a></p>
                                            <p><i class="icon icon-lg">android</i>&nbsp;<a href="/ssr-download/v2ray-android.apk">Android</a></p>
                                            <p><i class="icon icon-lg">phone_iphone</i>&nbsp;<a href="https://itunes.apple.com/us/app/shadowrocket/id932747118">iOS</a></p>
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

                                        <nav class="tab-nav margin-top-no">
                                            <ul class="nav nav-list" id="inbounds-nav">
                                                {foreach from=$node->v2conf|json_decode key=index item=inbound}
                                                <li {if $index==0}class="active"{/if}>
                                                    <a class="waves-attach waves-effect" data-toggle="tab" href="#json-{$index}"><i class="icon icon-lg">vertical_align_bottom</i>&nbsp;in-{$index}</a>
                                                </li>
                                                {/foreach}
                                            </ul>
                                        </nav>
                                        <div class="tab-content" id="v2ray_json">
                                            {foreach from=$node->v2conf|json_decode key=index item=inbound}
                                            <div class="tab-pane fade {if $index==0}active in{/if}" id="json-{$index}">
                                                <textarea class="form-control" rows="15">{json_encode(URL::genV2rayClientJson(URL::getV2rayItem($user, $node, $inbound, 1)), JSON_PRETTY_PRINT)}</textarea>
                                            </div>
                                            {/foreach}
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

                                        <nav class="tab-nav margin-top-no">
                                            <ul class="nav nav-list" id="inbounds-nav">
                                                {foreach from=$node->v2conf|json_decode key=index item=inbound}
                                                <li {if $index==0}class="active"{/if}>
                                                    <a class="waves-attach waves-effect" data-toggle="tab" href="#link-{$index}"><i class="icon icon-lg">vertical_align_bottom</i>&nbsp;in-{$index}</a>
                                                </li>
                                                {/foreach}
                                            </ul>
                                        </nav>
                                        <div class="tab-content" id="v2ray_url">
                                            {foreach from=$node->v2conf|json_decode key=index item=inbound}
                                            <div class="tab-pane fade {if $index==0}active in{/if}" id="link-{$index}">
                                                <p><a href="{URL::getV2RayItemUrl(URL::getV2rayItem($user, $node, $inbound, 2), 2)}"/>Android 手机上用默认浏览器打开点我就可以直接添加了(给 V2Ray APP)</a></p>
                                                <p><a href="{URL::getV2RayItemUrl(URL::getV2rayItem($user, $node, $inbound, 1), 1)}"/>iOS 上用 Safari 打开点我就可以直接添加了(给 Shadowrocket)</a></p>
                                            </div>
                                            {/foreach}
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

                                        <nav class="tab-nav margin-top-no">
                                            <ul class="nav nav-list" id="inbounds-nav">
                                                {foreach from=$node->v2conf|json_decode key=index item=inbound}
                                                <li {if $index==0}class="active"{/if}>
                                                    <a class="waves-attach waves-effect" data-toggle="tab" href="#qr-{$index}"><i class="icon icon-lg">vertical_align_bottom</i>&nbsp;in-{$index}</a>
                                                </li>
                                                {/foreach}
                                            </ul>
                                        </nav>
                                        <div class="tab-content" id="v2ray_qrcode">
                                            {foreach from=$node->v2conf|json_decode key=index item=inbound}
                                            <div class="tab-pane fade {if $index==0}active in{/if}" id="qr-{$index}">
                                                <nav class="tab-nav margin-top-no">
                                                    <ul class="nav nav-list">
                                                        <li class="active">
                                                            <a class="waves-attach" data-toggle="tab" href="#qr-{$index}-v2"><i class="icon icon-lg">devices_other</i>&nbsp;其他平台</a>
                                                        </li>
                                                        <li>
                                                            <a class="waves-attach" data-toggle="tab" href="#qr-{$index}-v1"><i class="icon icon-lg">phone_iphone</i>&nbsp;iOS</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                                <div class="tab-pane fade active in" id="qr-{$index}-v2">
                                                    <div class="text-center">
                                                        <div data="{URL::getV2RayItemUrl(URL::getV2rayItem($user, $node, $inbound, 2), 2)}" id="v2ray-qr"></div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="qr-{$index}-v1">
                                                    <div class="text-center">
                                                        <div data="{URL::getV2RayItemUrl(URL::getV2rayItem($user, $node, $inbound, 1), 1)}" id="v2ray-qr"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            {/foreach}
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
    $('#v2ray_qrcode').children('div.tab-pane.fade').each(function() {
        $(this).find('div#v2ray-qr').qrcode({
            "text": $(this).find('div#v2ray-qr').attr('data')
        });
    });

</script>
