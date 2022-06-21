<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * metodos y funciones
     * 
     **/

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('user.index', ['users' => $users]);
    }

    public function config(){
        return view('user.config');
    }

    public function edit(request $request){
        // obtenemos el id del ajax
        $id = $request->id;
        // obtenemos el usuario data
        $user = User::find($id);
        // retornamos el usuario en formato json
        return response()->json(['user' => $user]);
    }

    // update user authenticated

    public function update(Request $request){

        
        //obtenemos el id del usuario autenticado
        $user = Auth::user();
        $id = $user->id;

        //creamos las reglas de validacion
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);
        
        //recogemos los datos del formulario
        $name = $request->name;
        $surname = $request->surname;
        $nick = $request->nick;
        $email = $request->email;

        // asignar nuevos valores al usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //subir la imagen
        $image = $request->file('image_path');
        if($image){
            //poner nombre unico a la imagen
            $image_path = time().'_'.$image->getClientOriginalName();
            /*
            $image->move(public_path().'/images/users/', $image_path);
            $user->image_path = $image_path;
            */
            //guardar la imagen en storage/app/users/
            Storage::disk('users')->put($image_path, file_get_contents($image->getRealPath()));
            $user->image = $image_path;
        }

        //guardar los cambios
        $user->update();

        return redirect()->route('config')
        ->with(['message' => 'Usuario actualizado correctamente']);

    }

    // update all users
    public function updates(Request $request){
        //obtenemos el id del usuario autenticado
        $id = $request->user_id;

        //obtenemos los datos del usuario identificado
        $user = User::find($id);

        //creamos las reglas de validacion
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);
        
        //recogemos los datos del formulario
        $name = $request->name;
        $surname = $request->surname;
        $nick = $request->nick;
        $email = $request->email;

        // asignar nuevos valores al usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //guardar los cambios
        $user->update();

        return response()->json(['status' => 200]);
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    /**
     * handle fetch all users
     */

    public function fetchAll(){
        $users = User::orderBy('id', 'desc')->paginate(10);
        $output = '';
        if($users->count() > 0){
            $output .= '<table class="table table-striped table-sm text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nick</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';
            foreach($users as $user){
                $output .= '
                <tr>
                    <td>'.$user->id.'</td>
                    <td>'.$user->name.'</td>
                    <td>'.$user->surname.'</td>
                    <td>'.$user->nick.'</td>
                    <td>'.$user->email.'</td>
                    <td>
                        <a href="#" id="'.$user->id.'" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="bi-pencil-square h4"></i></a>
                        <a href="#" id="'.$user->id.'" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                    </td>
                </tr>
                ';
            }
            $output .= '</tbody></table>';
            
        }else{
            $output .= '<div class="alert alert-warning">No hay usuarios registrados</div>';
        }
        echo $output;
    }

}
