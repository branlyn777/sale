<?php
namespace App\Http\Livewire;

use App\Models\AdmUserBranch;
use App\Models\InvBranch;
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
    // Método que recibe un id de usuario y devuelve el id de su sucursal
    public function get_branch_id($user_id)
    {
        $branch = AdmUserBranch::where("user_id", $user_id)->first();
        return $branch->inv_branch_id;
    }
    // Método que devuelve todas las sucursales activas
    public function get_branches()
    {
        $branches = InvBranch::where("status", "active")->get();
        return $branches;
    }
}
