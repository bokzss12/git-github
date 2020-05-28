<?php namespace PHPMaker2020\pantawid2020; ?>
<?php if (!IsExport()) { ?>
<?php if (@!$SkipHeaderFooter) { ?>
		<?php if (isset($DebugTimer)) $DebugTimer->stop() ?>
		</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- ** Note: Only licensed users are allowed to change the copyright statement. ** -->
		<div class="ew-footer-text"><?php echo $Language->projectPhrase("FooterText") ?></div>
		<div class="float-right d-none d-sm-inline-block"></div>
	</footer>
	<script type="text/html" class="ew-js-template" data-name="myDropdown" data-method="prependTo" data-target="#ew-navbar-right" data-seq="10">
		<li class="nav-item dropdown">
			 <a class="nav-link" data-toggle="dropdown" href="#">
				 <i class="fas fa-bell"></i>
				 <span class="badge badge-warning navbar-badge">15</span>
			 </a>
			 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				 <span class="dropdown-item dropdown-header">15 Notifications</span>
				 <div class="dropdown-divider"></div>
				 <a href="#" class="dropdown-item">
					 <i class="fas fa-envelope mr-2"></i> 4 new messages
					 <span class="float-right text-muted text-sm">3 mins</span>
				 </a>
				 <div class="dropdown-divider"></div>
				 <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
			 </div>
		 </li>
	</script> 
</div>
<!-- ./wrapper -->
<?php } ?>
<!-- template upload (for file upload) -->
<script id="template-upload" type="text/html">
{{for files}}
	<tr class="template-upload">
		<td>
			<span class="preview"></span>
		</td>
		<td>
			<p class="name">{{:name}}</p>
			<p class="error text-danger"></p>
		</td>
		<td>
			<div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar bg-success" style="width: 0%;"></div></div>
		</td>
		<td>
			{{if !#index && !~root.options.autoUpload}}
			<button class="btn btn-default btn-sm start" disabled><?php echo $Language->phrase("UploadStart") ?></button>
			{{/if}}
			{{if !#index}}
			<button class="btn btn-default btn-sm cancel"><?php echo $Language->phrase("UploadCancel") ?></button>
			{{/if}}
		</td>
	</tr>
{{/for}}
</script>
<!-- template download (for file upload) -->
<script id="template-download" type="text/html">
{{for files}}
	<tr class="template-download">
		<td>
			<span class="preview">
				{{if !exists}}
				<span class="text-danger"><?php echo $Language->phrase("FileNotFound") ?></span>
				{{else url && extension == "pdf"}}
				<div class="ew-pdfobject" data-url="{{>url}}" style="width: <?php echo Config("UPLOAD_THUMBNAIL_WIDTH") ?>px;"></div>
				{{else url && extension == "mp3"}}
				<audio controls><source type="audio/mpeg" src="{{>url}}"></audio>
				{{else url && extension == "mp4"}}
				<video controls><source type="video/mp4" src="{{>url}}"></video>
				{{else thumbnailUrl}}
				<a href="{{>url}}" title="{{>name}}" download="{{>name}}" class="ew-lightbox"><img src="{{>thumbnailUrl}}"></a>
				{{/if}}
			</span>
		</td>
		<td>
			<p class="name">
				{{if !exists}}
				<span class="text-muted">{{:name}}</span>
				{{else url && thumbnailUrl && extension != "pdf" && extension != "mp3" && extension != "mp4"}}
				<a href="{{>url}}" title="{{>name}}" download="{{>name}}" class="ew-lightbox">{{:name}}</a>
				{{else url}}
				<a href="{{>url}}" title="{{>name}}" download="{{>name}}">{{:name}}</a>
				{{else}}
				<span>{{:name}}</span>
				{{/if}}
			</p>
			{{if error}}
			<div><span class="error text-danger">{{:error}}</span></div>
			{{/if}}
		</td>
		<td>
			<span class="size">{{:~root.formatFileSize(size)}}</span>
		</td>
		<td>
			{{if !~root.options.readOnly && deleteUrl}}
			<button class="btn btn-default btn-sm delete" data-type="{{>deleteType}}" data-url="{{>deleteUrl}}"><?php echo $Language->phrase("UploadDelete") ?></button>
			{{else !~root.options.readOnly}}
			<button class="btn btn-default btn-sm cancel"><?php echo $Language->phrase("UploadCancel") ?></button>
			{{/if}}
		</td>
	</tr>
{{/for}}
</script>
<!-- modal dialog -->
<div id="ew-modal-dialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>
<!-- modal lookup dialog -->
<div id="ew-modal-lookup-dialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>
<!-- email dialog -->
<div id="ew-email-dialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div>
<div class="modal-body">
<?php include_once "ewemail.php"; ?>
</div><div class="modal-footer"><button type="button" class="btn btn-primary ew-btn"><?php echo $Language->phrase("SendEmailBtn") ?></button><button type="button" class="btn btn-default ew-btn" data-dismiss="modal"><?php echo $Language->phrase("CancelBtn") ?></button></div></div></div></div>
<!-- import dialog -->
<div id="ew-import-dialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div>
<div class="modal-body">
<div class="custom-file">
	<input type="file" class="custom-file-input" id="importfiles" title=" " name="importfiles[]" multiple lang="<?php echo CurrentLanguageID() ?>">
	<label class="custom-file-label ew-file-label" for="importfiles"><?php echo $Language->phrase("ChooseFiles") ?></label>
</div>
<div class="message d-none mt-3"></div>
<div class="progress d-none mt-3"><div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div></div>
</div>
<div class="modal-footer"><button type="button" class="btn btn-default ew-close-btn" data-dismiss="modal"><?php echo $Language->phrase("CloseBtn") ?></button></div></div></div></div>
<!-- message box -->
<div id="ew-message-box" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ew-btn" data-dismiss="modal"><?php echo $Language->phrase("MessageOK") ?></button></div></div></div></div>
<!-- prompt -->
<div id="ew-prompt" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ew-btn"><?php echo $Language->phrase("MessageOK") ?></button><button type="button" class="btn btn-default ew-btn" data-dismiss="modal"><?php echo $Language->phrase("CancelBtn") ?></button></div></div></div></div>
<!-- session timer -->
<div id="ew-timer" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ew-btn" data-dismiss="modal"><?php echo $Language->phrase("MessageOK") ?></button></div></div></div></div>
<!-- tooltip -->
<div id="ew-tooltip"></div>
<?php if (@!$DrillDownInPanel) { ?>
<!-- drill down -->
<div id="ew-drilldown-panel"></div>
<?php } ?>
<?php } ?>
<?php if (!IsExport() || IsExport("print")) { ?>
<script>

// User event handlers
ew.ready(ew.bundleIds, "<?php echo $RELATIVE_PATH ?>js/userevt.js", "load", function() {

	// Global startup script
	$(document).ready(function(){$(".main-header").before("<div class='top-logo'><img src='phpimages/dswd.png'></div>"),$(".top-logo").css({position:"relative",top:"0",width:"100%",height:"60px"}),$(".main-sidebar").css({position:"absolute",top:$(".top-logo").outerHeight()}),$(".content-wrapper").css({position:"static",width:"100%"})});
});
</script>
<?php } ?>
</body>
</html>