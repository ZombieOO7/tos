(function($){

$("#poll_before").show();
$("#poll_after").hide(); 

 function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


$("input[name=poll_ans]").click(function(e){
        e.preventDefault();

        if(document.cookie.indexOf("voted=")==-1)
        {
            var opt_id=$(this).data("id");
            var poll=$("#poll_id").val();

            $.ajax({
                type:'POST',
                url:'<?=ROOT_URL; ?>models/submit_poll_response.php',
                data:{'poll':poll,'opt_id':opt_id},
                dataType:'json',
                success: function(resp2) {
                    $.each(resp2, function () 
                    {
                        $("#poll_before").hide();
                        $("#poll_after").show();
                        $("#poll_"+this.id).html(this.per);
                    });

                    setCookie("voted","yes",365);
                }
            });
        }
        else
        {
            swal({
                    title: "You have already Voted !!!",
                    confirmButtonColor: "#2196F3",
                    type: "info",
                    confirmButton:true,
                    timer:3500
                });
            console.log(document.cookie.indexOf("voted"));

        } 
        
    });

})(jQuery);	

