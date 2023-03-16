$(document).ready(function()
{

    $( '#frm-textForm-text' ).keyup(function()  
    {
        var Search = $('#frm-textForm-text').val();
        
        if(Search!="")
        {
            $.ajax(
                {
                    url: 'http://localhost/keywords/keywords/',
                    method: 'POST',
                    data:{ search:Search },
                    success:function (data) {
                        $('#content').fadeIn();
                        $('#content').html(data);
                    }
                })
        
        }
        else
        {
            $('#content').html('');
        }

    $(document).on('click', 'a', function(){
        $('#frm-textForm-text').val($(this).text());
        $('#content').html('');
    })

    })

});