<?php
namespace App\Http\Livewire;

use Livewire\Component;

class MethodsController extends Component
{
    // Método que devuelve un array asociativo para un alert de sweetalert2 (Mensaje de Alerta)
    public function update_alert($title, $text, $icon, $confirmButtonText, $cancelButtonText)
    {
        $alert = [
            'title' => $title,
            'text' => $text,
            'icon' => $icon,
            'confirmButtonText' => $confirmButtonText,
            'cancelButtonText' => $cancelButtonText,
        ];
        return $alert;
    }
    // Método que devuelve un array asociativo para un mensaje de tipo toast de sweetalert2 (Mensaje Toast en la parte superior derecha de la pantalla)
    public function update_toast($text, $timer, $icon)
    {
        $toast = [
            'text' => $text,
            'timer' => $timer,
            'icon' => $icon
        ];
        return $toast;
    }
}
