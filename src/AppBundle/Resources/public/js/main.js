 $(document).ready(function () {

        $('.deleteUser').click(function (e) {
            //var getUrl = Routing.generate('delete_user', {'id': $(this).attr('id')});
            //e.preventDefault();
            alert('123');
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
            
        });
 });
