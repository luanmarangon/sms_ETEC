$(function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#cpf').blur(function(){
     var cpf = $(this).val();
     
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'bcadastro.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'cpf=' + cpf, /* dado que será enviado via POST */
                dataType: 'json',
                success: function(pessoa){
                  if (pessoa.codigo == null){
                     $('#inputNome').focus();
                     
                  }
                  else {
                    // console.log(pessoa);
                      // var pessoa = data.split("-");
                       $('#inputCod').val(pessoa.codigo);
                       $('#inputNome').val(pessoa.nome);
                       $('#inputDtNasc').val(pessoa.dt_nasc);
                       $('#inputCel').val(pessoa.cel);
                       $('#inputEmail').val(pessoa.email);
                       $('#cadCurso').focus();
                    // },
                    // error: function(er){
                    //   console.log(er);
                    // }
                  }
                }
              // };
            });  
   });
});