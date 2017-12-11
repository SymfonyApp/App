 $(document).ready(function () {

      //  $('.deleteUser').click(function (e) {
        $(document).on('click','.deleteUser',function(e){
            var id = $(this).attr("data-playgroup-id");
            if(confirm("Are you sure you want to delete this Record?")){
                $.ajax({
                    type: 'delete',
                    url:  '../user/delete/'+ id,
                    data: $(this).serialize(),
                    success: function (response) {
                        location.reload();
                        console.log("borrado");
                    },
                    error: function (response) {
                        console.log("no borrado");
                    }
                });
            }
            
        })
        $(document).on('click','#btn_search',function(e){

            var q = $("input[name='_search']").val();
             alert(q);
            $.ajax({
                    type: 'POST',
                    url:  '../user/search',
                    datatype: 'json',
                    data: {"_search": q},
                    success: function (response) {
                       // location.reload();
                       $("#table_id").html(response);
                        console.log("borrado");
                    },
                    error: function (response) {
                        console.log("no borrado");
                    }
                });
            
        })
                       

 });
