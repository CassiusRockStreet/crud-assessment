
function deleteUser(id){
    $.ajax({
        url: "/user/delete-request",
        type:"GET",
        data:{
          user_id:id
          },
        success:function(data){
            if(data.success){
                $('#'+id).remove();
                alert(data.success);
            };
          }
    });
}

function deleteRole(id){
    $.ajax({
        url: "/role/delete-request",
        type:"GET",
        data:{
            role_id:id
          },
        success:function(data){
            if(data.success){
                $('#'+id).remove();
                alert(data.success);
            };
          }
    });
}