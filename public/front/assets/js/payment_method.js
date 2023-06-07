$(document).ready(function () {
    $("#paypal").hide();
    $("#debit_card").hide();
    $("#card_button").hide()
    $("#wallet_button").show()
    $("#paypal_button").hide()
    $("#wallet").hide();
    $(".another_card").hide();

    $("#add_debitCard").on("click", function() {
      $("#wallet").hide();
        $("#debit_card").show();
        $("#card_button").show()
        $("#wallet_button").hide()
        $("#paypal_button").hide()
        $("#paypal").hide();
        $("#info").hide();
        

        $(".card_bg").css({
            'background':'#F8FAFE'
          });
          $(".wallet_bg").css({
            'background':'none'
          });
          $(".paypal_bg").css({
            'background':'none'
          });
    });

    $("#with_paypal").on("click", function() {
      $("#wallet").hide();
        $("#debit_card").hide();
        $("#card_button").hide()
        $("#wallet_button").hide()
        $("#paypal_button").show()
        $("#paypal").show();
        $(".another_card").hide();

        $(".card_bg").css({
            'background':'none'
          });
          $(".wallet_bg").css({
            'background':'none'
          });
          $(".paypal_bg").css({
            'background':'#F8FAFE'
          });
    });

    $("#with_wallet").on("click", function() {
      $("#debit_card").hide();
      $("#card_button").hide()
      $("#wallet_button").show()
      $("#paypal_button").hide()
      $("#wallet").show();
      $("#paypal").hide();
      $(".another_card").hide();
      $("#info").show();

      $(".card_bg").css({
          'background':'none'
        });
        $(".paypal_bg").css({
          'background':'none'
        });
        $(".wallet_bg").css({
          'background':'#F8FAFE'
        });
  });

  $("#add_card_btn").on("click", function() {
     $(".another_card").show();
  });

});