if ($.fn.pagination){
	$.fn.pagination.defaults.beforePageText = 'Halaman';
	$.fn.pagination.defaults.afterPageText = 'dari {pages}';
	$.fn.pagination.defaults.displayMsg = 'Menampilkan {from} s/d {to} dari {total} data';
}
if ($.fn.datagrid){
	$.fn.datagrid.defaults.loadMsg = 'Sedang diproses ...';
}
if ($.fn.treegrid && $.fn.datagrid){
	$.fn.treegrid.defaults.loadMsg = $.fn.datagrid.defaults.loadMsg;
}
if ($.messager){
	$.messager.defaults.ok = 'Ya';
	$.messager.defaults.cancel = 'Nggak Jadi';
}
if ($.fn.validatebox){
	$.fn.validatebox.defaults.missingMessage = 'Harus diisi.';
	$.fn.validatebox.defaults.rules.email.message = 'Harus diisi dengan format email';
	$.fn.validatebox.defaults.rules.url.message = 'Harus diisi dengan alamat website';
	$.fn.validatebox.defaults.rules.length.message = 'Isi nilai antara {0} dan {1}.';
	$.fn.validatebox.defaults.rules.remote.message = 'Isi dengan benar';
}
if ($.fn.numberbox){
	$.fn.numberbox.defaults.missingMessage = 'Harus diisi.';
}
if ($.fn.combobox){
	$.fn.combobox.defaults.missingMessage = 'Harus diisi.';
}
if ($.fn.combotree){
	$.fn.combotree.defaults.missingMessage = 'Harus diisi.';
}
if ($.fn.combogrid){
	$.fn.combogrid.defaults.missingMessage = 'Harus diisi.';
}
if ($.fn.calendar){
	$.fn.calendar.defaults.weeks = ['Mi','Se','Se','Ra','Ka','Ju','Sa'];
	$.fn.calendar.defaults.months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agus', 'Sep', 'Okt', 'Nov', 'Des'];
}
if ($.fn.datebox){
	$.fn.datebox.defaults.currentText = 'Hari ini';
	$.fn.datebox.defaults.closeText = 'Tutup';
	$.fn.datebox.defaults.okText = 'Ya';
	$.fn.datebox.defaults.missingMessage = 'Harus diisi.';
}
if ($.fn.datetimebox && $.fn.datebox){
	$.extend($.fn.datetimebox.defaults,{
		currentText: $.fn.datebox.defaults.currentText,
		closeText: $.fn.datebox.defaults.closeText,
		okText: $.fn.datebox.defaults.okText,
		missingMessage: $.fn.datebox.defaults.missingMessage
	});
}
