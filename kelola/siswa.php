<head>
	<style type="text/css">
		#fm{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			color:#666;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:100px;
		}
		textarea{font-family:arial;}
	</style>
	<script type="text/javascript">
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','Tambah Siswa');
			$('#fm').form('clear');
			url = 'kelola/siswa_crud.php?crud=save';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Perbaharui Data');
				$('#fm').form('load',row);
				url = 'kelola/siswa_crud.php?crud=update&nis='+row.nis;
			}
		}
		function saveUser(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Kesalahan',
							msg: result.msg
						});
					}
				}
			});
		}
		function removeUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Konfirmasi','Yakin mau dihapus?',function(r){
					if (r){
						$.post('kelola/siswa_crud.php?crud=remove',{nis:row.nis},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Kesalahan',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		}
	</script>
</head>
<body>
		
	<table id="dg" title="Master Data Siswa" class="easyui-datagrid" style="min-width:600px;height:370px"
			url="kelola/siswa_crud.php?crud=get" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="nis" >No. Induk</th>
				<th field="nama" width="100">Nama siswa</th>
				<th field="jenis">L / P</th>
				<th field="alamat" width="100">Alamat Lengkap</th>
				<th field="telepon" width="50">Telepon</th>
				<th field="masuk_kelas">Diterima di kelas</th>
				<th field="tahun_masuk">Tahun Masuk</th>
			</tr>
		</thead>
	</table>
	
	<div class="demo-info" style="margin-bottom:10px;margin-top:5px; border:1px solid">
		<div class="demo-tip icon-tip">&nbsp;</div>
			<div>Kelola Data Siswa di sini. Selanjutnya. Fungsi Hapus tidak diizinkan. Fungsi Ubah diizinkan untuk siswa.
			</div>
	</div>
	
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Tambah</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Ubah</a>
		<!--a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">Hapus</a-->
	</div>
	
	<!-- dialog form tambah dan update-->
	<div id="dlg" class="easyui-dialog" style="width:450px;height:300px;padding:10px 20px" closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Keterangan</div>
		<form id="fm" method="post" novalidate>
			
			<div class="fitem">
				<label>NIS :</label>
				<input name="nis" class="easyui-validatebox" required="true"/>
			</div>
			
			<div class="fitem">
				<label>Nama siswa :</label>
				<input name="nama" size="35"/>
			</div>
			
			<div class="fitem">
				<label>Telepon :</label>
				<input name="telepon">
			</div>
			<div class="fitem">
				<label>Tahun Masuk :</label>
				<input name="tahun_masuk" placeholder=" <?php echo date('Y');?> "> 
			</div>
			
			<div class="fitem">
				<label>Diterima di kelas :</label>
				<input name="masuk_kelas" size="10"> <code>Contoh: 7a, 8b, 9c</code>
			</div>
			
		</form>
	</div>
	
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Simpan</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Nggak Jadi</a>
	</div>
</body>