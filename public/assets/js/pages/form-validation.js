"use strict";

(function () {
    const bouncer = new Bouncer("[data-validate]", {
        disableSubmit: false,
        customValidations: {
            valueMismatch: function (element) {
                const selector = element.getAttribute("data-bouncer-match");
                if (!selector) return false;
                const matchElement = element.form.querySelector(selector);
                return matchElement && matchElement.value !== element.value;
            },
        },
        messages: {
            valueMismatch: function (element) {
                const message = element.getAttribute("data-bouncer-mismatch-message");
                return message || "Please make sure the fields match.";
            },
        },
    });

    document.addEventListener("bouncerFormInvalid", function (event) {
        window.scrollTo(0, event.detail.errors[0].offsetTop);
    });

})();