$(document).ready(function() {
    var postData = $('#postList').DataTable({
        "lengthChange": false,
        "processing": true,
        "serverSide": true,
        "oreder[]":[],
        "ajax":{
            url: "manage_posts.php",
            type: "POST",
            data:{action:'postListing'},
            dataType: 'json',
        },
        "columnDefs":[
            {
                "targets":[0, 6, 7],
                "orderable":false,
            },
        ],
        "pageLength": 10
    });
    $(document).on('click', '.delete', function(){
        var postId = $(this).attr("id");
        var action = "postDelete";
        if(confirm("Bạn có muốn xóa bài post này?")) {
            $.ajax({
                url:"manage_posts.php",
                method:"POST",
                data:{postId:postId, action:action},
                success:function(data) {
                    postsData.ajax.reload();
                }
            })
        } else {
            return false;
        }
    });
})