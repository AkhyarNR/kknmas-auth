<?php

namespace App\Http\Controllers;

use DB;
use App\MstrAgama;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    public function index()
    {
        return view('master.Agama');
    }

    public function read()
    {
         
        $items = DB::table('mstr_agama');

        $total = DB::table('mstr_agama')->count();
        if(isset($_GET['take']) || isset($_GET['skip'])){
            $items->skip($_GET['skip'])->take($_GET['take']);

        }
        $data['data'] = $items->get();
        $data['total'] = $total;

        return json_encode($data);
    }

    public function create(Request $request)
    {
        $data = new MstrAgama();

        $data->Agama = $request->input('Agama');

        return json_encode($data->save());
    }

    public function update(Request $request)
    {
        $data = MstrAgama::findOrFail($request->Agama_Id);
        
        $data->Agama = $request->input('Agama');

        return json_encode($data->save());
    }

    public function delete(Request $request)
    {
       $data = MstrAgama::destroy($request->Agama_Id);

        return json_encode($data);
    }
}
