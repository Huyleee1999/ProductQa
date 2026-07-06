define(["uiComponent", "ko", "jquery", "mage/url", "mage/cookies"], function (
  Component,
  ko,
  $,
  urlBuilder,
) {
  "use strict";
  console.log("=== question-form.js LOADED ===");

  return Component.extend({
    defaults: {
      template: "Training_ProductQa/question-form",
    },

    initialize: function () {
      this._super();
      this.questionText = ko.observable("");
      this.message = ko.observable("");
      this.messageType = ko.observable("");
      this.isLoading = ko.observable(false);

      return this;
    },

    submit: function () {
      var self = this;

      self.message("");
      self.isLoading(true);

      $.ajax({
        url: urlBuilder.build("productqa/index/submit"),
        type: "POST",
        data: {
          form_key: $.mage.cookies.get("form_key"),
          product_id: self.productId,
          question_text: self.questionText(),
        },
      })
        .done(function (response) {
          console.log(response);

          self.message(response.message);

          if (response.success) {
            self.messageType("success");
            self.questionText("");
          } else {
            self.messageType("error");
          }
        })
        .always(function () {
          self.isLoading(false);
        });
    },
  });
});
