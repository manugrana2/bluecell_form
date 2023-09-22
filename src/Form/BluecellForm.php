<?php
namespace Drupal\bluecell_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Formulario Bluecell.
 */
class BluecellForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'bluecell_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['nombre'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Nombre'),
      '#required' => TRUE,
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];
    $form['telefono'] = [
      '#type' => 'tel',
      '#title' => $this->t('Teléfono'),
      '#required' => TRUE,
    ];
    $form['mensaje'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Mensaje'),
      '#required' => TRUE,
    ];
    $form['asunto'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Asunto'),
      '#required' => TRUE,
    ];
    $form['aceptacion'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Acepto las políticas'),
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Enviar'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Validación para el campo 'nombre'
    if (strlen($form_state->getValue('nombre')) <= 2) {
        $form_state->setErrorByName('nombre', $this->t('El nombre debe tener más de 2 caracteres.'));
    }

    // Validación para el campo 'email'
    if (!filter_var($form_state->getValue('email'), FILTER_VALIDATE_EMAIL)) {
        $form_state->setErrorByName('email', $this->t('Debes proporcionar una dirección de correo electrónico válida.'));
    }

    // Validación para el campo 'telefono'
    if (!ctype_digit($form_state->getValue('telefono'))) {
        $form_state->setErrorByName('telefono', $this->t('El teléfono solo debe contener números.'));
    }

    // Validación para el campo 'mensaje'
    if (strlen($form_state->getValue('mensaje')) <= 50) {
        $form_state->setErrorByName('mensaje', $this->t('El mensaje debe tener más de 50 caracteres.'));
    }

    // Validación para el campo 'asunto'
    if (strlen($form_state->getValue('asunto')) <= 6) {
        $form_state->setErrorByName('asunto', $this->t('El asunto debe tener más de 6 caracteres.'));
    }

    // Validación para el campo 'aceptacion'
    if (!$form_state->getValue('aceptacion')) {
        $form_state->setErrorByName('aceptacion', $this->t('Debes aceptar las políticas.'));
    }
  }

/**
 * {@inheritdoc}
 */
public function submitForm(array &$form, FormStateInterface $form_state) {
    // Obtener los valores del formulario
    $values = $form_state->getValues();

    // Insertar los valores en la base de datos
    \Drupal::database()->insert('bluecell_form_submissions')
        ->fields([
            'nombre' => $values['nombre'],
            'email' => $values['email'],
            'telefono' => $values['telefono'],
            'mensaje' => $values['mensaje'],
            'asunto' => $values['asunto'],
            'aceptacion' => $values['aceptacion'] ? 1 : 0,
            'fecha' => date('Y-m-d H:i:s'),
        ])
        ->execute();

    // Mensaje para notificar al usuario que el formulario se ha enviado correctamente
    \Drupal::messenger()->addMessage($this->t('Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.'));
}

}
