 $(document).ready(function () {

        $('.deleteUser').click(function (e) {
            //var getUrl = Routing.generate('delete_user', {'id': $(this).attr('id')});
            //e.preventDefault();
            var id = $(this).attr("data-playgroup-id");
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
        });
 });