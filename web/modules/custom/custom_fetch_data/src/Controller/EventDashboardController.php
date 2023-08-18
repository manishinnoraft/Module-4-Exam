<?php

namespace Drupal\custom_fetch_data\Controller;

use Drupal\Core\Controller\ControllerBase;
use Exception;

class EventDashboardController extends ControllerBase {

  public function dashboard() {
    try {
      $db = \Drupal::database();

      // Fetching data related to user joining date.
      $joining_date_query = $db->select('user__field_year_of_joining', 'uj');
      $joining_date_query->addField('uj', 'entity_id', 'user_id');
      $joining_date_query->addField('uj', 'field_year_of_joining_value', 'joining_date');
      // Add more fields if needed.
      $joining_date_query->condition('uj.bundle', 'user');
      // Add more conditions if needed.
      $joining_date_data = $joining_date_query->execute()->fetchAll();

      // Fetching data related to user passing year.
      $passing_year_query = $db->select('user__field_year_of_passing', 'up');
      $passing_year_query->addField('up', 'entity_id', 'user_id');
      $passing_year_query->addField('up', 'field_year_of_passing_value', 'passing_year');
      // Add more fields if needed.
      $passing_year_query->condition('up.bundle', 'user');
      // Add more conditions if needed.
      $passing_year_data = $passing_year_query->execute()->fetchAll();

      // Fetching display name data from the users_field_data table.
      $display_name_query = $db->select('users_field_data', 'ufd');
      $display_name_query->addField('ufd', 'uid', 'user_id');
      $display_name_query->addField('ufd', 'name', 'display_name');
      // Add more fields if needed.
      $display_name_data = $display_name_query->execute()->fetchAll();

      return [
        '#theme' => 'custom_dashboard',
        '#joining_date_data' => $joining_date_data,
        '#passing_year_data' => $passing_year_data,
        '#display_name_data' => $display_name_data,
      ];
    } catch (Exception $e) {
      // Handle exceptions.
      return [
        '#markup' => 'Error: ' . $e->getMessage(),
      ];
    }
  }

}
