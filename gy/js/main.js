$(function(){
    $('.del-user').click(function(){
        
        var button = $(this);
        var id = $(this).data('id-user')
        var action = 'user-del';
        
        var url = '/gy/admin/ajax.php?action='+action+'&id-user='+id;
        
        if (typeof id != "undefined"){
            button.hide();
            $.ajax({
                url,
                success: function(res){
                    result = JSON.parse(res);
                    if (result['stat'] == 'ok'){
                        alert('! Пользователь удалён');
                        window.location.replace(document.location.href);
                    } else {
                        button.show();
                    }
                }
            });
        }
    });
});
