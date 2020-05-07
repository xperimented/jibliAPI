<?php
 
namespace App\Http\Controllers;
 
use App\Colis;
use Illuminate\Http\Request;
 
class ColisController extends Controller
{
    public function index()
    {
        $colis = auth()->user()->colis;
 
        return response()->json([
            'success' => true,
            'data' => $colis
        ]);
    }
 
    public function show($id)
    {
        $colis = auth()->user()->colis()->find($id);
 
        if (!$colis) {
            return response()->json([
                'success' => false,
                'message' => 'colis with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $colis->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'v_depart' => 'required',
            'v_arrive' => 'required',
            'd_depart' => 'required',
            't_depart' => 'required',
            
        ]);
 
        $colis = new Colis();
        $colis->type = $request->type;
        $colis->v_depart = $request->v_depart;
        $colis->v_arrive = $request->v_arrive;
        $colis->d_depart = $request->d_depart;
        $colis->t_depart = $request->t_depart;
 
        if (auth()->user()->colis()->save($colis))
            return response()->json([
                'success' => true,
                'data' => $colis->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Product could not be added'
                
            ], 500);
    }
    public function update(Request $request, $id)
    {
        $colis = auth()->user()->colis()->find($id);
 
        if (!$colis) {
            return response()->json([
                'success' => false,
                'message' => 'Colis with id ' . $id . ' not found'
            ], 400);
        }
 
        $updated = $colis->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Colis could not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $colis = auth()->user()->colis()->find($id);
 
        if (!$colis) {
            return response()->json([
                'success' => false,
                'message' => 'colis with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($colis->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'colis could not be deleted'
            ], 500);
        }
    }
    
}