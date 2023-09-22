<?php

namespace Drupal\bluecell_form\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controlador administrativo para ver las respuestas del formulario Bluecell.
 */
class BluecellFormAdminController extends ControllerBase {

  /**
   * Página de resumen para ver las respuestas del formulario.
   */
  public function overview() {
    $header = [
      'id' => $this->t('ID'),
      'nombre' => $this->t('Nombre'),
      'email' => $this->t('Email'),
      'telefono' => $this->t('Teléfono'),
      'mensaje' => $this->t('Mensaje'),
      'asunto' => $this->t('Asunto'),
      'aceptacion' => $this->t('Aceptación'),
      'fecha' => $this->t('Fecha'),
    ];

    $query = \Drupal::database()->select('bluecell_form_submissions', 'bfs')
      ->fields('bfs', ['id', 'nombre', 'email', 'telefono', 'mensaje', 'asunto', 'aceptacion', 'fecha'])
      ->orderBy('fecha', 'DESC');
    $result = $query->execute()->fetchAll();

    $rows = [];
    foreach ($result as $row) {
      $rows[] = [
        'id' => $row->id,
        'nombre' => $row->nombre,
        'email' => $row->email,
        'telefono' => $row->telefono,
        'mensaje' => $row->mensaje,
        'asunto' => $row->asunto,
        'aceptacion' => $row->aceptacion ? $this->t('Sí') : $this->t('No'),
        'fecha' => date('d/m/Y H:i', strtotime($row->fecha)),
      ];
    }

    $build = [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];

    return $build;
  }
}
