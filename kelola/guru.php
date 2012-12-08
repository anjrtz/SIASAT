<html>
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
		</style>
	
	<script type="text/javascript">
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','Tambah Guru');
			$('#fm').form('clear');
			url = 'kelola/guru_crud.php?crud=save';
		}
		
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Perbaharui Data');
				$('#fm').form('load',row);
				url = 'kelola/guru_crud.php?crud=update&gid='+row.gid;
			}
		}

		function viewUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				alert('Nama : '+row.nama+"\nAlamat : "+row.alamat+'\nUsername : '+row.username+"\nLevel : "+row.level);
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
						$.post('kelola/guru_crud.php?crud=remove',{gid:row.gid},function(result){
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
	
	<table id="dg" title="Data Guru" class="easyui-datagrid" style="min-width:600px;height:370px"
			url="kelola/guru_crud.php?crud=get"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="nama" width="100">Nama</th>
				<th field="jenis">L / P</th>
				<th field="alamat" width="100">Alamat</th>
				<th field="telepon">Telepon</th>
				<th field="username">Username</th>
				<th field="level">Level Akses</th>
			</tr>
		</thead>
	</table>
	
	<div class="demo-info" style="margin-bottom:10px;margin-top:5px; border:1px solid">
		<div class="demo-tip icon-tip">&nbsp;</div>
			<div>Kelola Data Guru di sini. Fungsi detail nanti dengan Dialog.
			</div>
	</div>
	
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" 	plain="true" onclick="newUser()">Tambah</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="viewUser()">Lihat Detail</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit"	plain="true" onclick="editUser()">Ubah</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">Hapus</a>
		<input size="200" class="easyui-searchbox" style=" position:absolute;right:2px;"></input>

	</div>
	
	<!-- dialog form tambah dan update-->
	<div id="dlg" class="easyui-dialog" style="width:400px;height:420px;padding:10px 20px" closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Keterangan</div>
		<form id="fm" method="post" novalidate>
			
			<div class="fitem">
				<label>Nama:</label>
				<input name="nama" class="easyui-validatebox" required="true"/>
			</div>
			
			<div class="fitem">
				<label>Jenis Kelamin:</label>
				<input type="radio" name="jenis" value="L" /> Laki
				<input type="radio" name="jenis" value="P" /> Perempuan
			</div>
			
			<div class="fitem">
				<label>Alamat:</label>
				<textarea name="alamat" cols="20" rows="5"></textarea>
			</div>
			
			<div class="fitem">
				<label>Telepon:</label>
				<input name="telepon">
			</div>
			
			<div class="fitem">
				<label>Username:</label>
				<input name="username">
			</div>
			
			<div class="fitem">
				<label>Password</label>
				<input name="password" type="password">
			</div>
			
			<div class="fitem">
				<label>Level</label>
				<select name="level">
				<option value="guru">Guru</option>
				<option value="wali">Wali</option>
				<option value="admin">Administrator</option>
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