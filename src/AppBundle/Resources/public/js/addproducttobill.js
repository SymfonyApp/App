 $(document).ready(function () {

        $(document).on('click','#btn_add_product',function(e){
            var idsp = $("select[name='_sanpham']").val();
            var sl = $("input[name='_sl']").val();
            if(sl > 0){
                $.ajax({
                    type: 'POST',
                    url:  '../hoadon/add',
                    datatype: 'json',
                    data: {"_sl": sl, "_idsp":idsp},
                    success: function (response) {
                       // location.reload();
                       $("#table_cthd").html(response);
                        console.log("borrado");
                        console.log(idsp);
                        console.log(sl);
                    },
                    error: function (response) {
                        console.log("no borrado");
                    }
                });
            }
            else
            {
                alert('Số lượng từ 1 trở lên');
            }

        })
        $(document).on('click','.deleteCTHD',function(e){
            var id = $(this).attr("data-playgroup-id");
            if(confirm("Are you sure you want to delete this Record?")){
                $.ajax({
                    type: 'delete',
                    url:  '../hoadon/deletecthd/'+ id,
                    data: $(this).serialize(),
                    success: function (response) {
                        $("#table_cthd").html(response);
                        console.log("borrado");
                    },
                    error: function (response) {
                        console.log("no borrado");
                    }
                });
            }
            
        })
 });
