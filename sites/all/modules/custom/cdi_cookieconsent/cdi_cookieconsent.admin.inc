<?php
/**
 * @file
 */

/**
 * Menu callback; presents the sitemap settings page.
 */
function cdi_cookieconsent_admin_settings_form() {

  $form['tracking_scripts'] = array(
    '#type' => 'fieldset',
    '#title' => t('Tracking scripts config'),
  );

  $form['tracking_scripts']['cdi_cookieconsent_gtm'] = array(
    '#type' => 'textfield',
    '#title' => t('Google tag manager Container ID'),
    '#default_value' => variable_get('cdi_cookieconsent_gtm', FALSE),
    '#description' => t('Example: GTM-XXXXXXX'),
  );

  $form['tracking_scripts']['cdi_cookieconsent_ensighten'] = array(
    '#type' => 'textfield',
    '#title' => t('Ensighten script url'),
    '#default_value' => variable_get('cdi_cookieconsent_ensighten', FALSE),
    '#description' => t('Example: //nexus.ensighten.com/xxxxx'),
  );

  $form['cookie_consent_copies'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#title' => t('Cookie consent Copies'),
  );

  $form['cookie_consent_copies']['cdi_cookieconsent_header'] = array(
    '#type' => 'textfield',
    '#title' => t('Head Consent title'),
    '#default_value' => variable_get('cdi_cookieconsent_header', CDICOOKIE_HEADER),
    '#description' => t('The title on the top of the popup box.'),
  );

  $form['cookie_consent_copies']['cdi_cookieconsent_message'] = array(
    '#type' => 'textarea',
    '#title' => t('Consent messagge'),
    '#default_value' => variable_get('cdi_cookieconsent_message', CDICOOKIE_MESSAGE),
    '#description' => t('A short message requesting consent to use cookies on this site.'),
  );

  $form['cookie_consent_copies']['cdi_cookieconsent_dismiss'] = array(
    '#type' => 'textfield',
    '#title' => t('Dismiss cookie button text'),
    '#default_value' => variable_get('cdi_cookieconsent_dismiss', CDICOOKIE_DISMISS),
  );

  $form['cookie_consent_copies']['cdi_cookieconsent_allow'] = array(
    '#type' => 'textfield',
    '#title' => t('Allow cookie button text'),
    '#default_value' => variable_get('cdi_cookieconsent_allow', CDICOOKIE_ALLOW),
  );

  $form['cookie_consent_copies']['cdi_cookieconsent_revoke'] = array(
    '#type' => 'textfield',
    '#title' => t('Revoke button text'),
    '#default_value' => variable_get('cdi_cookieconsent_revoke', CDICOOKIE_REVOKE),
  );

  $form['cookie_consent_copies']['cdi_cookieconsent_link'] = array(
    '#type' => 'textfield',
    '#title' => t('Read more button text'),
    '#description' => t('The text shown on the link to the cookie policy.'),
    '#default_value' => variable_get('cdi_cookieconsent_link', CDICOOKIE_LINK),
  );

  $form['cookie_consent_copies']['cdi_cookieconsent_href'] = array(
    '#type' => 'textfield',
    '#title' => t('Cookie policy link'),
    '#description' => t('If you already have a cookie policy, link to it here.'),
    '#default_value' => variable_get('cdi_cookieconsent_href', CDICOOKIE_HREF),
  );

  return system_settings_form($form);

}

