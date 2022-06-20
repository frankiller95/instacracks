<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function config(){
        return view('user.config');
    }

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

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

}
