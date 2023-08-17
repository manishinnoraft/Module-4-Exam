<?php

namespace Drupal\student_signup\Mail;

use Drupal\Core\Mail\MailInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a mailer for the student_signup module.
 *
 * @Mail(
 *   id = "student_signup",
 *   label = @Translation("Student Signup Mailer"),
 *   description = @Translation("Sends email notifications for student sign-up."),
 *   message_tokens = {
 *     ...
 *   }
 * )
 */
class StudentSignupMail implements MailInterface, ContainerFactoryPluginInterface {

  /**
   * Constructs a StudentSignupMail object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    // Constructor logic if needed.
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition
    );
  }

  /**
   * {@inheritdoc}
   */
  public function format(array $message) {
    // Format the email message.
    return [
      'subject' => $message['subject'],
      'body' => $message['message'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function mail(array $message) {
    // Send the email using the drupal_mail() function.
    $params['body'] = $this->format($message)['body'];
    $params['subject'] = $this->format($message)['subject'];
    $message['result'] = \Drupal::service('plugin.manager.mail')->mail('student_signup', 'student_notification', $message['to'], \Drupal::currentUser(), $params, NULL, TRUE);
  }
}
