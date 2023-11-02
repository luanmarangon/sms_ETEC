$(function(){

	$("#add").click(function(){
		var html = '<div class="col-md-5">';
		html += '<label for="selCurso">Selecione o Curso:</label>';
		html += '<select name="curso[]" id="selCurso" class="form-control">';
		html += '<option value="">Selecione</option>';
		html += '<option value="1">Administração</option>';
		html += '<option value="2">Contabilidade</option>';
		html += '<option value="3">Informática para Internet</option>';
		html += '<option value="4">Marketing</option>';
		html += '<option value="5">Redes</option>';
		html += '<option value="6">Serviços Jurídicos</option>';
		html += '</select>';
		html += '</div>';
		html += '<div class="col-md-5">';
		html += '<label for="selModulo">Selecione o Módulo:</label>';
		html += '<select name="modulo[]" id="selModulo" class="form-control">';
		html += '<option value="">Selecione</option>';
		html += '<option value="1">1º Módulo</option>';
		html += '<option value="2">2º Módulo</option>';
		html += '<option value="3">3º Módulo</option>';
		html += '</select>';
		html += '<br>';

		$("#select").append(html);
	});
});