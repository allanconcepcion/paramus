var $ = jQuery;
$(document).ready(function() {
  $(".wpcf7").on("mailsent.wpcf7", function(event) {
    if (typeof ga === "function") {
      if (localStorage.getItem("fromAd") == "1") {
        // PPC user form fill goals
        ga("send", "event", "Form - PPC Contact Form", "Submit", "Home");
        ga("send", "pageview", "/goals/PPC-Contact-Form");
      } else {
        var goal = $(this)
          .find("[data-goal]")
          .data("goal");
        ga("send", "pageview", goal);
      }
    }
  });
});

// document.addEventListener(
//   "wpcf7mailsent",
//   function(event) {
//     var inputs = event.detail.inputs;
//     var name = "";
//     var firstName = "";
//     var lastName = "";
//     var email = "";
//     var phone = "";
//     var reason = "";
//     var location = "";
//     var method = "";
//     var time = "";

//     var site = window.location.hostname.replace("www.", "").replace("/", "");

//     for (var i = 0; i < inputs.length; i++) {
//       switch (inputs[i].name) {
//         // Name Fields
//         case "your-name":
//           name = inputs[i].value;
//           break;
//         case "name-first":
//           firstName = inputs[i].value;
//           break;
//         case "first-name":
//           firstName = inputs[i].value;
//           break;
//         case "name-last":
//           lastName = inputs[i].value;
//           break;
//         case "last-name":
//           lastName = inputs[i].value;
//           break;
//         // Email Fields
//         case "email":
//           email = inputs[i].value;
//           break;
//         case "your-email":
//           email = inputs[i].value;
//           break;
//         // Phone Fields
//         case "phone":
//           phone = inputs[i].value;
//           break;
//         case "your-phone":
//           phone = inputs[i].value;
//           break;
//         case "tel-905":
//           phone = inputs[i].value;
//           break;
//         // Comment Fields
//         case "reason":
//           reason = inputs[i].value;
//           break;
//         case "your-message":
//           reason = inputs[i].value;
//           break;
//         case "comment":
//           reason = inputs[i].value;
//           break;
//         case "location":
//           location = inputs[i].value;
//           break;
//         case "contact-method":
//           method = inputs[i].value;
//           break;
//         case "contact-time":
//           time = inputs[i].value;
//           break;
//       }
//     }

//     var data = {
//       action: "pd_receive_lead",
//       name: name,
//       firstName: firstName,
//       lastName: lastName,
//       email: email,
//       phone: phone,
//       reason: reason,
//       location: location,
//       method: method,
//       time: time
//     };
//     var leadSiteUrl = '';
//     $.ajax({
//       url: leadSiteUrl . '/wp-json/wp/v2/pages?per_page=100',
//       data: data,
//       type: "post",
//       success: function(response) {
//         $(".js-sitemap-form").show();
//         $(".progressive-form__success").show();
//         $(".js-sitemap-table-wrap").hide();
//       }
//     });
//   },
//   false
// );

