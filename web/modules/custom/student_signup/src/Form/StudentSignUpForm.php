<?php

namespace Drupal\student_signup\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements the student sign-up form.
 */
class StudentSignUpForm extends FormBase {

  /**
   * The messenger service.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Constructs a StudentSignUpForm object.
   *
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   */
  public function __construct(MessengerInterface $messenger) {
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('messenger')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'student_signup_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Build the form elements.
    $form['full_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email Address'),
      '#required' => TRUE,
    ];

    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#required' => TRUE,
    ];

    $form['mobile_number'] = [
      '#type' => 'tel',
      '#title' => $this->t('Mobile Number'),
      '#required' => TRUE,
    ];

    $form['stream'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Stream'),
      '#required' => TRUE,
    ];

    $form['joining_year'] = [
      '#type' => 'number',
      '#title' => $this->t('Joining Year'),
      '#required' => TRUE,
    ];

    $form['passing_year'] = [
      '#type' => 'number',
      '#title' => $this->t('Passing Year'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Sign Up'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Implement form validation if needed.
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Implement form submission logic.

    // Add a debug message indicating that the form is submitted.
    $this->messenger->addMessage($this->t('Your form is submitted.'), 'status');

    // For sending notifications, you'll add code here.
    // ...

    // Display a success message.
    $this->messenger->addMessage($this->t('Thank you for signing up. You will receive notifications shortly.'), 'status');
  }
}
