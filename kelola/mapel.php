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
			$('#dlg').dialog('open').dialog('setTitle','Tambah Mata Pelajaran');
			$('#fm').form('clear');
			url = 'kelola/mapel_crud.php?crud=save';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Perbaharui Data');
				$('#fm').form('load',row);
				url = 'kelola/mapel_crud.php?crud=update&mid='+row.mid;
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
						$.post('kelola/mapel_crud.php?crud=remove',{mid:row.mid},function(result){
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
	
	
	<table id="dg" title="Data Mata Pelajaran" class="easyui-datagrid" style="min-width:600px;height:370px"
			url="kelola/mapel_crud.php?crud=get" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="singkatan" >Kode</th>
				<th field="nama" width='100'>Nama mapel</th>
				<th field="kkm">Nilai KKM</th>
				<th field="kategori">Kategori</th>
			</tr>
		</thead>
	</table>
	
	<div class="demo-info" style="margin-bottom:10px">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Kelola Mata Pelajaran di sini. Selanjutnya <a href="?p=siswa">Kelola Siswa</a></div>
	</div>
	
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Tambah</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Ubah</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">Hapus</a>
		<input size="200" class="easyui-searchbox" data-options="prompt:'Kotak Pencarian ...', searcher:function(value,name){alert('Maaf, Belum berfungsi bro')}" style=" position:absolute;right:2px;"></input>

	</div>
	
	<!-- dialog form tambah dan update-->
	<div id="dlg" class="easyui-dialog" style="width:400px;height:300px;padding:10px 20px" closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Keterangan</div>
		<form id="fm" method="post" novalidate>
			
			<div class="fitem">
				<label>Kode Mapel:</label>
				<input name="singkatan" class="easyui-validatebox" required="true"/>
			</div>
			
			<div class="fitem">
				<label>Nama mapel:</label>
				<input name="nama"/>
			</div>
			
			<div class="fitem">
				<label>Nilai KKM</label>
				<input name="kkm">
			</div>
			<div class="fitem">
				<label>Kategori</label>
				<select name="kategori">
				<option value="umum">Umum</option>
				<option value="mulok">Mulok</option>
				</select>
			</div>
			
		</form>
	</div>
	
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Simpan</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Nggak Jadi</a>
	</div>
</body>
</html>
