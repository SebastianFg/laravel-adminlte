<?php

namespace App\Http\Controllers\elementos;
use App\modelos\elementos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dotenv\Validator;
//laravel
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
//Modelos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Image;
use File;
use Response;

//pdf
use Barryvdh\DomPDF\Facade as PDF;

class ElementosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $Request){
        if (Auth::User()->primer_logeo == null) {
            return redirect('admin/primerIngreso');
        }

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }
        $data = elementos::orderBy('id')->get();
        return view('elementos.alta_elementos', compact('data'));
        
    }

    
    public function getMensaje($mensaje,$destino,$desicion){
        if (!$desicion) {
            alert()->error('Error',$mensaje);
            return  redirect()->route($destino);
        }else{
            alert()->success( $mensaje);
            return  redirect()->route($destino);  
        }

    }

//funcion que utilizamos para crear o editar
private function ElementoCreacionEdicion($datos,$elemento,$accion){

    $elemento->descripcion = $datos->descripcion;
    $elemento->fecha = $datos->fecha;
    $elemento->modelo = $datos->modelo;
    $elemento->marca = $datos->marca;
    $elemento->serial = $datos->serial;

    if ($accion == 0 ) {
       
    }else if($accion == 1){
      
    }
    

   //return $datos;
    switch ($accion) {
        // case 0: //creacion --> alta
        //     $elemento->save();
        //     $images = $datos->file('foto');

        //     Storage::disk('public')->makeDirectory('imagenes/'.$datos->dominio);
        //     foreach($images as $image){
        //         $imagenvehiculo = new imagen_vehiculo;

        //         $nombre_archivo_nuevo = time().$image->getClientOriginalName();

        //         Image::make($image)->resize(300, 500);
               
        //         Storage::disk("public")->put($nombre_archivo_nuevo, file_get_contents($image));
        //         Storage::move("public/".$nombre_archivo_nuevo, "public/imagenes/".$datos->dominio.'/'.$nombre_archivo_nuevo);
                
        //         $imagenvehiculo->id_vehiculo = $vehiculo->id_vehiculo;
        //         $imagenvehiculo->nombre_imagen = $nombre_archivo_nuevo;
        //         $imagenvehiculo->fecha =  $datos->fecha;
        //         $imagenvehiculo->save();
        //     }
         
            // alert()->success( 'Creacion con exito');
            // return  redirect()->route('listaVehiculos');
            // break;
        case 1: // edicion
            $elemento->update();
            // if($datos->fotoEdit == null){
            //     $vehiculo->foto_id = $vehiculo->foto_id;
            // }else{ 
            //    $vehiculo_delete_imagen = imagen_vehiculo::where('id_vehiculo','=',$datos->vehiculo)->get();

            //    foreach ($vehiculo_delete_imagen as $item) {
            //         unlink(storage_path('app/public/imagenes/'.$datos->dominio.'/'.$item->nombre_imagen));
            //         $item->delete();
            //     }     

            //     Storage::disk('public')->makeDirectory('imagenes/'.$datos->dominio);

            //     $images = $datos->file('fotoEdit');

            //     foreach($images as $image){
            //         $imagenvehiculo = new imagen_vehiculo;

            //         $nombre_archivo_nuevo = time().$image->getClientOriginalName();

            //         Image::make($image)->resize(300, 500);
                   
            //         Storage::disk("public")->put($nombre_archivo_nuevo, file_get_contents($image));
            //         Storage::move("public/".$nombre_archivo_nuevo, "public/imagenes/".$datos->dominio.'/'.$nombre_archivo_nuevo);
                    
            //         $imagenvehiculo->id_vehiculo = $datos->vehiculo;
            //         $imagenvehiculo->nombre_imagen = $nombre_archivo_nuevo;
            //         $imagenvehiculo->fecha =  $datos->fecha;
            //         $imagenvehiculo->save();
            //     }
            // }
            return $this->getMensaje('Actualizado con exito','listaElementos',true);
            break;
         default:
             return $this->getMensaje('Intente nuevamente','listaElementos',false);
    }
}
     //alta nuevo elementos
     public function crearElementos(Request $Request ){
        // return $Request;
         
        $Validar = \Validator::make($Request->all(), [
            'descripcion' => 'required|max:255',
            'modelo' => 'required|max:255',
            'marca' => 'required|max:255',
            'serial' => 'required|max:255'
            
           
        ]);

        if ($Validar->fails()){
            alert()->error('Error','Intente nuevamente ...');
           return  back()->withInput()->withErrors($Validar->errors());
        }
        elementos::create($Request->all());
         alert()->success( 'Creacion con exito');
         return  redirect()->route('listaElementos');
       
     }
        
     public function updateElementos(Request $Request){
        // return $Request;
        $Validar = \Validator::make($Request->all(), [
              
            'serial' => ['required',
                             Rule::unique('elementos')->ignore($Request->serial,'serial')],
            'descripcion' => 'required|max:255',
            'modelo' => 'required|max:255',
            'marca' => 'required|max:255',
        ]);
        if ($Validar->fails()){
            alert()->error('Error','Agrege nuevamente...no');
            return  back()->withInput()->withErrors($Validar->errors());
        }
        $vehiculo_en_actualizacion= elementos::findorfail($Request->elemento);
       return  $this->ElementoCreacionEdicion($Request,$vehiculo_en_actualizacion,1);//1 edicioN
      
    }
  
    public function fueraDeServicio(Request $Request){
            // return $Request;
       

        $elementoEliminado= elementos::findorfail($Request->elemento);
       
    
        $elementoEliminado->delete();
      

   
   
            return $this->getMensaje('Dado de baja definitivamente exitosamente','listaElementos',true);           

            
     
    }
}
