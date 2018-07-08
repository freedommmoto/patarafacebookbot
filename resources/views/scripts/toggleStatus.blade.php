  <script>
    $(document).ready(function(){

      $('.switch').click(function(){
        $(this).toggleClass('checked');
        $('input[name="status"]').not(':checked').prop("checked", true);
      });

        $('#copy-url').click(function() {
          /* Get the text field */
            var copyText = document.getElementById("verify_token_hide");
            copyText.select();
            document.execCommand("copy");
            //copyText.value
            swal ( "Copied the Callback URL" , '' ,  "success" )

        });
    });
  </script>