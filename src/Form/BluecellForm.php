<?php

namespace Drupal\bluecell_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Define el formulario Bluecell.
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
    // Aquí se añadirán validaciones personalizadas si es necesario.
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Aquí se guardará  información en la base de datos.
  }
}
