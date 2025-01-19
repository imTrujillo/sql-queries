<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //
    public function Ex1()
    {
        //Los registros se insertan a las tablas, verificando antes si hay registros duplicados
        $user = DB::table('users')->insertOrIgnore([
            ['name' => 'Picard Lopez', 'email' => 'picard@example.com', 'phone' => '7465-3456',],
            ['name' => 'Jose Roberto', 'email' => 'josejose@example.com', 'phone' => '7453-1234'],
            ['name' => 'stringman', 'email' => 'string@example.com', 'phone' => '8765-3457'],
            ['name' => 'mitsubi takabura', 'email' => 'staywithme@example.com', 'phone' => '7465-3456'],
            ['name' => 'peter parker', 'email' => 'soyspiderman@example.com', 'phone' => '2467-4356']
        ]);
        $pedido = DB::table('pedido')->insert([
            ['producto' => 'licuadora', 'cantidad' => 343, 'total' => 80.34, 'id_usuario' => 1],
            ['producto' => 'queso parmesano', 'cantidad' => 465, 'total' => 10.20, 'id_usuario' => 2],
            ['producto' => 'cohete espacial', 'cantidad' => 8, 'total' => 84563313.45, 'id_usuario' => 5],
            ['producto' => 'trituradora', 'cantidad' => 21, 'total' => 5423.49, 'id_usuario' => 3],
            ['producto' => 'agua cristal', 'cantidad' => 936, 'total' => 2.75, 'id_usuario' => 4]
        ]);

        //Cuando la operación es exitosa, se devuelve un mensaje de confirmación
        return response()->json([
            'message' => 'Datos iniciales insertados correctamente'
        ], 201);
    }
    public function Ex2()
    {
        //Se muestran todos los pedidos del usuario con id = 2
        return Pedido::where('id_usuario', 2)->get();
    }
    public function Ex3()
    {
        //se muestran todos los pedidos, adjuntando detalles del usuario
        return Pedido::select('pedido.producto', 'pedido.cantidad', 'pedido.total', 'users.name as usuario', 'users.email')->join('users', 'pedido.id_usuario', 'users.id')->get();
    }
    public function Ex4()
    {
        //se filtra la tabla de pedidos, los valores del total oscilan entre 100-250
        return Pedido::select('*')->whereBetween('total', [100, 250])->get();
    }
    public function Ex5()
    {
        //se filtra la tabla de usuarios, solo se muestran nombres con letra inicial R.
        return User::where('name', 'like', 'R%')->get();
    }
    public function Ex6()
    {
        //se cuenta la cantidad de registros del usuario con id = 5
        return Pedido::where('id_usuario', 5)->count();
    }
    public function Ex7()
    {
        //se obtienen tanto detalles del producto como del usuario, ordenandose según el precio de forma descedente.
        return Pedido::select('pedido.producto', 'pedido.cantidad', 'pedido.total', 'users.name as usuario', 'users.email', 'users.phone')->join('users', 'pedido.id_usuario', 'users.id')->orderBy('pedido.total', 'desc')->get();
    }
    public function Ex8()
    {
        //se obtiene la suma total de todos los pedidos
        return Pedido::select(DB::raw('sum(total) as sumaTotal'))->get();
    }
    public function Ex9()
    {
        //se filtra la base de datos, obteniendo el pedido mas economico junto al nombre de usuario
        return Pedido::select('pedido.producto', 'pedido.cantidad', 'pedido.total', 'users.name as usuario')->join('users', 'pedido.id_usuario', 'users.id')->orderBy('pedido.total', 'asc')->first();
    }
    public function Ex10()
    {
        //se clasifican los pedidos segun el nombre de usuario. 
        return Pedido::select('users.name as usuario', DB::raw('group_concat(pedido.producto separator ", ") as productos'), DB::raw('sum(pedido.cantidad) as cantidadTotal'), DB::raw('sum(pedido.total) as total'))->join('users', 'pedido.id_usuario', 'users.id')->groupBy('users.name')->get();
    }
}
