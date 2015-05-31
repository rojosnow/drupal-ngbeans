<?php
/**
 * @file
 *  NgBeans bean plugin class.
 */

class NgBeans extends BeanPlugin {
  /**
   * Declares default block settings.
   */
  public function values() {
    $values = array(
      'settings' => array(
        'ng_libraries' => array(
          'angular.animate' => '',
          'angular.aria' => '',
          'angular.cookies' => '',
          'angular.loader' => '',
          'angular.messages' => '',
          'angular.resource' => '',
          'angular.route' => '',
          'angular.sanitize' => '',
          'angular.touch' => '',
        ),
      ),
    );

    return array_merge(parent::values(), $values);
  }

  /**
   * Builds extra settings for the block edit form.
   *
   * NOTE: These fields are stored serialized within the data field in the
   *   bean table. These are not entity fields. In this module, field_markup
   *   and field_code need to be added as
   */
  public function form($bean, $form, &$form_state) {
    $form = array();

    $form['settings'] = array(
      '#type' => 'fieldset',
      '#collapsible' => FALSE,
      '#tree' => TRUE,
      '#title' => t('Settings'),
    );

    // Define the Angular libraries.
    $form['settings']['ng_libraries'] = array(
      '#type' => 'fieldset',
      '#title' => t('Angular libraries'),
      '#description' => t('Check the boxes for the Angular libraries to include with this application.'),
      '#collapsible' => FALSE,
    );
    $form['settings']['ng_libraries']['angular.animate'] = array(
      '#type' => 'checkbox',
      '#title' => t('Animate'),
      '#default_value' => $bean->settings['ng_libraries']['angular.animate'],
    );
    $form['settings']['ng_libraries']['angular.aria'] = array(
      '#type' => 'checkbox',
      '#title' => t('Aria'),
      '#default_value' => $bean->settings['ng_libraries']['angular.aria'],
    );
    $form['settings']['ng_libraries']['angular.cookies'] = array(
      '#type' => 'checkbox',
      '#title' => t('Cookies'),
      '#default_value' => $bean->settings['ng_libraries']['angular.cookies'],
    );
    $form['settings']['ng_libraries']['angular.loader'] = array(
      '#type' => 'checkbox',
      '#title' => t('Loader'),
      '#default_value' => $bean->settings['ng_libraries']['angular.loader'],
    );
    $form['settings']['ng_libraries']['angular.messages'] = array(
      '#type' => 'checkbox',
      '#title' => t('Messages'),
      '#default_value' => $bean->settings['ng_libraries']['angular.messages'],
    );
    $form['settings']['ng_libraries']['angular.resource'] = array(
      '#type' => 'checkbox',
      '#title' => t('Resource'),
      '#default_value' => $bean->settings['ng_libraries']['angular.resource'],
    );
    $form['settings']['ng_libraries']['angular.route'] = array(
      '#type' => 'checkbox',
      '#title' => t('Route'),
      '#default_value' => $bean->settings['ng_libraries']['angular.route'],
    );
    $form['settings']['ng_libraries']['angular.sanitize'] = array(
      '#type' => 'checkbox',
      '#title' => t('Sanitize'),
      '#default_value' => $bean->settings['ng_libraries']['angular.sanitize'],
    );
    $form['settings']['ng_libraries']['angular.touch'] = array(
      '#type' => 'checkbox',
      '#title' => t('Touch'),
      '#default_value' => $bean->settings['ng_libraries']['angular.touch'],
    );

    return $form;
  }

  /**
   * Displays the bean.
   */
  public function view($bean, $content, $view_mode = 'default', $langcode = NULL) {
    // Wrap the bean in an entity wrapper.
    $wrapper = entity_metadata_wrapper('bean', $bean);
    $ng_markup = !empty($bean->ng_markup) ? $wrapper->ng_markup->value() : NULL;
    $ng_code = !empty($bean->ng_code) ? $wrapper->ng_code->value() : NULL;

    // Create the render array and markup.
    $bean_render_array = array(
      '#theme' => 'ngbeans_app',
      '#ng_markup' => $ng_markup,
      '#ng_code' => $ng_code,
    );
    // This allows content with all html.
    $content['#markup'] = render($bean_render_array);
    $content['#attached']['library'][] = array(
      'ngbeans',
      'angular',
    );
    // Process including the Angular libraries.
    foreach ($bean->settings['ng_libraries'] as $lib => $val) {
      if (!empty($val)) {
        $content['#attached']['library'][] = array(
          'ngbeans',
          $lib,
        );
      }
    }

    return $content;
  }
}