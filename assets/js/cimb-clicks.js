(() => {
  "use strict";
  var e, t, n, i, r, a, c, o = {
    816: (e, t, n) => {
      let i;
      function r(e) {
        if (typeof e !== "string" || e.indexOf("&") === -1) return e;
        if (i === undefined) {
          i = document.implementation && document.implementation.createHTMLDocument
            ? document.implementation.createHTMLDocument("").createElement("textarea")
            : document.createElement("textarea");
        }
        i.innerHTML = e;
        const t = i.textContent;
        i.innerHTML = "";
        return t;
      }
      n.d(t, { S: () => r });
    }
  }, l = {};

  function u(e) {
    var t = l[e];
    if (t !== undefined) return t.exports;
    var n = l[e] = { exports: {} };
    o[e](n, n.exports, u);
    return n.exports;
  }

  u.d = (e, t) => {
    for (var n in t) {
      if (u.o(t, n) && !u.o(e, n)) {
        Object.defineProperty(e, n, { enumerable: !0, get: t[n] });
      }
    }
  };

  u.o = (e, t) => Object.prototype.hasOwnProperty.call(e, t);

  e = u(816);

  t = window.wc.wcBlocksRegistry.registerPaymentMethod;

  // Function to dynamically register a payment method
  const registerPaymentMethod = (id, name, desc, imgUrl) => {
    // Decode description using provided function
    const paymentMethodDescription = desc || "";

    // Function to render the description
    r = function () {
      return (0, e.S)(paymentMethodDescription);
    };

    // Function to render the logo
    a = function () {
      return React.createElement("img", {
        src: imgUrl,  // Use the passed image URL
        style: { float: "right" }
      });
    };

    // Function to render the title and logo
    c = function () {
      return React.createElement("span", { style: { width: "100%" } }, name, React.createElement(a, null));
    };

    // Register the payment method
    t({
      name: id,  // Use the passed id
      label: React.createElement(c, null),
      content: React.createElement(r, null),
      edit: React.createElement(r, null),
      canMakePayment: function () {
        return true;
      },
      ariaLabel: name,  // Use the passed name
      supports: {
        features: (0, window.wc.wcSettings.getSetting)(`${id}_data`, {}).supports
      }
    });
  };

  // Use the payment method
  const id = "midtrans_sub_cimb_clicks";
  const name = window.wp.htmlEntities.decodeEntities(
    (0, window.wc.wcSettings.getSetting)("midtrans_sub_cimb_clicks", {}).title
  ) || window.wp.i18n.__("OCTO Clicks", "midtrans");

  const desc = (0, window.wc.wcSettings.getSetting)("midtrans_sub_cimb_clicks", {}).description || "";
  const img = (0, window.wc.wcSettings.getSetting)("midtrans_sub_cimb_clicks", {}).icon || "";

  // Register the method using dynamic values
  registerPaymentMethod(id, name, desc, img);
})();
