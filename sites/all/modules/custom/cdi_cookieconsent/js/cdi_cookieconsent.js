var insertedScripts = false,
  revokedConsent = false;
(function ($) {
  Drupal.behaviors.CdiCookieBehavior = {
    attach: function (context, settings) {
      window.addEventListener("load", function () {
        window.cookieconsent.initialise({
          "palette": {
            "popup": {
              "background": "#333"
            },
            "button": {
              "background": "#579ac4",
              "text": "#333",
              "border": "#579ac4"
            },
            "highlight": { background: 'transparent', border: '#579ac4', text: '#579ac4' }
          },
          "position": "top-right",
          "layout": "basic-header",
          "type": "opt-in",
          "content": {
            "header": Drupal.settings.cdicookie.header,
            "message": Drupal.settings.cdicookie.message,
            "dismiss": Drupal.settings.cdicookie.dismiss,
            "allow": Drupal.settings.cdicookie.allow,
            "link": Drupal.settings.cdicookie.link,
            "href": Drupal.settings.cdicookie.href,
          },
          "law": {
            "countryCode": Drupal.settings.cdicookie.country,
          },
          "revokable": true,
          "revokeBtn": '<div class="cc-revoke {{classes}}">' + Drupal.settings.cdicookie.revoke + '</div>',
          onInitialise: function (status) {
            var type = this.options.type;
            var didConsent = this.hasConsented();
            if (type == 'opt-in' && didConsent) {
              if (status == 'allow') {
                allowScripts(Drupal.settings.cdicookie.gtm_id, Drupal.settings.cdicookie.ensighten_url);
              }
            }
          },
          onStatusChange: function (status, chosenBefore) {
            var type = this.options.type;
            var didConsent = this.hasConsented();
            if (type == 'opt-in' && didConsent) {
              callConsentLog(status, Drupal.settings.cdicookie.callUrl);
              if (status == 'allow') {
                allowScripts(Drupal.settings.cdicookie.gtm_id, Drupal.settings.cdicookie.ensighten_url);
              }
            }
          },
          onRevokeChoice: function () {
            var type = this.options.type;
            if (type == 'opt-in') {

            }
          },
        }, function (popup) {
          var law = new window.cookieconsent.Law();
          var hasLaw = law.get(Drupal.settings.cdicookie.country).hasLaw;
          if (!popup.options.enabled && !hasLaw) {

            allowScripts(Drupal.settings.cdicookie.gtm_id, Drupal.settings.cdicookie.ensighten_url);
          }

        }, function (err) {

        })
      });
    }
  };
})(jQuery);

function allowScripts(gtmID, engightenUrl) {
  if (!insertedScripts) {
    insertedScripts = true;

    if (gtmID != '') {
      (function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
          'gtm.start': new Date().getTime(),
          event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s),
          dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', gtmID);

      jQuery('body').prepend('<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' + gtmID + '" height="0" width="0" style="display:none visibility:hidden"></iframe></noscript>');
    }
    if (engightenUrl != '') {
      var s = document.createElement("script");
      s.type = "text/javascript";
      s.src = engightenUrl;
      jQuery('body').append(s);
    }
  }
}

function callConsentLog(status, callUrl) {
  jQuery.ajax({
    type: "POST",
    dataType: 'json',
    url: callUrl,
    data: {
      'consent': status
    },
    success: function (result) {

    }
  });
}
