


{include file='admin/main.tpl'}







	<main class="content">
		<div class="content-header ui-content-header">
			<div class="container">
				<h1 class="content-heading">编辑证书 #{$cert->id}</h1>
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
										<label class="floating-label" for="name">证书名称，一般填证书的CN</label>
										<input class="form-control" id="name" type="text" name="name" value="{$cert->name}">
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="cert">证书，如果填地址/路径将会从地址/路径获取</label>
										<textarea class="form-control" id="cert" name="cert" rows="15">{$cert->cert}</textarea>
									</div>

									<div class="form-group form-group-label">
										<label class="floating-label" for="key">私钥，如果填地址/路径将会从地址/路径获取</label>
										<textarea class="form-control" id="key" name="key" rows="15">{$cert->key}</textarea>
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


<script>
	$('#main_form').validate({
{literal}
		rules: {
		  name: {required: true},
		  cert: {required: true},
		  key: {required: true}
		},
{/literal}

		submitHandler: function() {
            $.ajax({
				type: "PUT",
                url: "/admin/cert/{$cert->id}",
                dataType: "json",
                data: {
                    name: $("#name").val(),
                    cert: $("#cert").val(),
					key: $("#key").val(),
                },
                success: function (data) {
                    if (data.ret) {
                        $("#result").modal();
                        $("#msg").html(data.msg);
                        window.setTimeout("location.href='/admin/cert'", {$config['jump_delay']});
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
