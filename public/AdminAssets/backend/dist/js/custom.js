$(document).ready(function(){
    $("#old_password").keyup(function(){
        var old_password = $("#old_password").val();
        // alert(old_password);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/check-admin-password',
            data:{ old_password : old_password},
            success:function(resp){
                // alert(resp);
                if(resp == "true"){
                    $("#check_password").html("<font color='green'>Current Password is correct! </font>");
                }else if(resp == "false"){
                    $("#check_password").html("<font color='red'>Current Password is Incorrect! </font>");
                }
            },error:function(){
                //alert('Error');
            }
        });
    });
});
