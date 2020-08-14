 <script type="text/javascript">
    //---JPaiva-23-10-2019----------------GRABAR-----------------------------
    $(function () {
        var $Input, $myForm;
        
        $Input = $('#inputClientes');
        $myForm = $('#frmClientes');     

        
        $('#importClientes').on('click', function () {
                        
            var formData = new FormData();
            formData.append('clientesXLS', $Input[0].files[0]);

            $.ajax({
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                url: "{{ url('herramientas/importarClientes') }}" + '?' + $myForm.serialize(),
                method: 'POST',               
                data: formData,
                processData: false,
                contentType: false,

                success: function(data){
                  
                  setTimeout(function() {
                    M.toast({ html: '<span>Importación de clientes exitoso.</span>'});
                  }, 2000); 

                },
                error:function(){ 
                    alert("error!!!!");
                }
            })
        });
    });
   
  </script>
    