<?php

namespace App\Http\Livewire;

use App\Models\InvBranch;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;



class AdmUserController extends Component
{
    // Guarda el id de un Usuario
    public $user_id;
    // Guarda el nombre de un Usuario
    public $user_name;
    // Guarda la lista de Sucursales
    public $list_branches;
    // Guarda la lista de Roles
    public $list_roles;

    public $search;

    public $name, $mail, $password_a, $password_b;

     
    public $role_id;
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->list_branches = InvBranch::where("status","active")->get();
        $this->list_roles = Role::all();
        $this->user_id = 0;
    }
    public function render()
    {
        if (strlen($this->search) == 0)
        {
            $users = User::orderBy("created_at","desc")
            ->paginate(10);
        }
        else
        {
            $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orderBy("created_at","desc")
            ->paginate(10);
        }

        return view('livewire.template.administration.user.user', [
            'users' => $users,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    // Muestra la ventana modal Usuarios (Para Crear o Actualizar)
    public function showModalUser($id)
    {
        // Si el id recibido es igual a cero significa que se va a crear un ususario, caso contrario se actualizará un ususario
        if ($id == 0)
        {
            $this->user_id = 0;
            $this->user_name = "";
        }
        else
        {
            $user = User::find($id);
            // Actualiza la variable global name a travez de la variable user
            $this->name = $user->name;
            $this->mail = $user->email;
            $this->role_id = $user->getRoleObject()->id;
            // $this->password_a = $user->password; bcrypt($this->password_a);

            // Actualiza la variable global user_id a travez de la variable recibida
            $this->user_id = $id;
        }
        // Quita los mensajes de validación
        $this->resetValidation();
        // Lanza el evento para mostrar la ventana modal
        $this->emit("show-modal-user");
    }
    // Crea un nuevo usuario
    public function create_user()
    {
        $rules = [
            'name' => 'required|min:2|max:255|unique:users,name',
            'mail' => 'required|email|unique:users,email',
            'role_id' => 'required|integer|not_in:0',
            'password_a' => 'required|min:6',
            'password_b' => 'required|same:password_a',
        ];
        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'Ya existe un usuario con ese nombre',
            'name.min' => 'El nombre debe tener al menos 2 caracteres',
            'name.max' => 'El nombre no debe pasar los 255 caracteres',
            
            'mail.required' => 'El correo es requerido',
            'mail.email' => 'El correo debe ser una dirección válida',
            'mail.unique' => 'Ya existe un usuario con ese correo',
            
            'role_id.required' => 'El rol es requerido',
            'role_id.integer' => 'El rol debe ser un número entero',
            'role_id.not_in' => 'Debe seleccionar un rol válido',
            
            'password_a.required' => 'La contraseña es requerida',
            'password_a.min' => 'La contraseña debe tener al menos 6 caracteres',
            
            'password_b.required' => 'La confirmación de la contraseña es requerida',
            'password_b.same' => 'Las contraseñas no coinciden',
        ];
        $this->validate($rules, $messages); 
        // Elimina espacios en blanco extras y reemplaza multiples espacios en blanco por un solo espacio
        $this->name = trim(preg_replace('/\s+/', ' ', $this->name));
        $this->mail = trim(preg_replace('/\s+/', ' ', $this->mail));
        // Crea el usuario y guarda el objeto creado en una variable
        $user = User::create([
            'name' => $this->name,
            'email' => $this->mail,
            'password' => bcrypt($this->password_a), // Encriptar la contraseña
        ]);

        $role = Role::find($this->role_id);

        // Asignar el rol al usuario
        $user->assignRole($role);

        // Texto que se verá en el mensaje de tipo toast
        $text = "Usuario '" . $user->name . "' creado exitosamente";

        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);

        // Cierra la ventana modal
        $this->emit("hide-modal-user");
    }
    // actualiza los datos del usuario
    public function update_user()
    {
        $rules = [
            'name' => 'required|min:2|max:255',
            'mail' => 'required|email',
            'role_id' => 'required|integer|not_in:0',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 2 caracteres',
            'name.max' => 'El nombre no debe pasar los 255 caracteres',

            'mail.required' => 'El correo es requerido',
            'mail.email' => 'El correo debe ser una dirección válida',

            'role_id.required' => 'El rol es requerido',
            'role_id.integer' => 'El rol debe ser un número entero',
            'role_id.not_in' => 'Debe seleccionar un rol válido',

            'password_a.min' => 'La contraseña debe tener al menos 6 caracteres',
            'password_b.same' => 'Las contraseñas no coinciden',
            'password_b.required_with' => 'Ambas contraseñas son requeridas si una de ellas está presente',
        ];

        $validator = Validator::make($this->all(), $rules, $messages);

        // Condicionalmente agregar reglas para password_a y password_b
        if (!empty($this->password_a) || !empty($this->password_b)) {
            $validator->sometimes('password_a', 'required|min:6', function ($input) {
                return !empty($input->password_b);
            });

            $validator->sometimes('password_b', 'required|same:password_a', function ($input) {
                return !empty($input->password_a);
            });
        }

        $validator->validate();
        
        


        // Busca el usuario y lo guarda en una variable
        $user = User::find($this->user_id);
        // Actualiza el usuario
        $user->update([
            'name' => $this->name,
            'email' => $this->mail,
        ]);
        if ($this->password_a)
        {
            $user->update([
                'password' => bcrypt($this->password_a),
            ]);
        }
        $user->save();


        // Remover Rol anterior
        $role = $user->getRoleObject();
        $user->removeRole($role);

        
        // Asignar nuevo Rol
        $nameRole = Role::find($this->role_id)->name;
        $user->assignRole($nameRole);


        // Texto que se verá en el mensaje de tipo toast
        $text = 'El usuario: "' . $user->name. '" fue actualizado exitosamente';
        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 3000,
            'icon' => "success"
        ]);
        // Cierra la ventana modal
        $this->emit("hide-modal-user");
    }
    // Escucha eventos JavaScript de la vista para ejecutar métodos en este controlador
    protected $listeners = [
        'deleteUser' => 'delete_user'
    ];
    // Elimina o inactiva una categoría
    public function delete_user($user_id)
    {
        $user = User::find($user_id);
        $name = $user->name;
        $user->delete();
        $text = '¡Usuario: "' . $name . '" eliminado exitósamente!';


        // Emite un mensaje de tipo toast
        $this->emit("toast", [
            'text' => $text,
            'timer' => 5000,
            'icon' => "success"
        ]);
    }
}
