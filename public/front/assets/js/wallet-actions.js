 
    $(document).ready(function () {
      $("#hide_balance").hide();
      $("#hide_wallet").hide();
      $("#show_wallet").on("click", function() {
         $("#hide_wallet").show();
         $("#hide_balance").show();
         $("#show_wallet").hide();
        $("#show_balance").hide();
      });

      $("#hide_wallet").on("click", function() {
        $("#hide_wallet").hide();
         $("#hide_balance").hide();
        $("#show_wallet").show();
        $("#show_balance").show();
      });

   });
   