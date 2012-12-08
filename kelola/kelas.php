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
			$('#dlg').dialog('open').dialog('setTitle','Tambah kelas');
			$('#fm').form('clear');
			url = 'kelola/kelas_crud.php?crud=save';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Perbaharui Data');
				$('#fm').form('load',row);
				url = 'kelola/kelas_crud.php?crud=update&kid='+row.kid;
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
						$.post('kelola/kelas_crud.php?crud=remove',{kid:row.kid},function(result){
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
	
	
	<table id="dg" title="Data kelas" class="easyui-datagrid" style="min-width:600px;height:370px"
			url="kelola/kelas_crud.php?crud=get"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="kid">Kode</th>
				<th field="nama" width="50">Nama Kelas</th>
				<th field="id_tingkat">Tingkat</th>
				<th field="id_guru" width="100">Wali Kelas</th>
				<th field="kap"> Maks.(Siswa)</th>
				
			</tr>
		</thead>
	</table>
	
	<div class="demo-info" style="margin-bottom:10px;margin-top:5px;border:1px solid;">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Kelola data Kelas di sini. Selanjutnya <a href="?p=mapel">Kelola Mata Pelajaran</a></div>
	</div>
	
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Tambah</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Ubah</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">Hapus</a>
	</div>
	
	<!-- dialog form tambah dan update-->
	<div id="dlg" class="easyui-dialog" style="width:400px;height:320px;padding:10px 20px" closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Keterangan</div>
		<form id="fm" method="post" novalidate>
			
			<div class="fitem">
				<label>Kode Kelas:</label>
				<input name="kid"/>
			</div>
			
			<div class="fitem">
				<label>Nama Kelas:</label>
				<input name="nama"/>
			</div>
			
			<!--combobox dari tabel-->
			<div class="fitem" style="font-size:10px;">
				<label>Tingkat</label>
				<input class="easyui-combobox" name="id_tingkat"
				data-options=" url:'kelola/kelas_crud.php?crud=tingkat', valueField:'id_tingkat', textField:'tnama'"/>
			</div>
			
			<div class="fitem">
				<label>Kapasitas:</label>
				<input name="kap" size="10">
			</div>
			
			<div class="fitem">
				<label>Wali Kelas:</label>
			<input list="wali" name="id_guru"/>
			<datalist id="wali">
			  <?php	//retrieve data
					//include "include/koneksi.php";
					$q = @mysql_query("select gid, nama from guru where level = 'wali' ");
					while ($h = mysql_fetch_array($q)) {
						echo "<option value='$h[gid]'>".$h[nama]."</option>";
						} ?>
			</datalist>
			</div>
		</form>
	</div>
	
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Simpan</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#dlg').dialog('close');">Nggak Jadi</a>
	</div>
</body>
</html>
