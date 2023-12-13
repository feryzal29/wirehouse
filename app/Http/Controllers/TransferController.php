<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\mapinguser;
use App\Models\Material;
use App\Models\plan;
use App\Models\Transfer;
use App\Models\Transfer2;
use App\Models\transfer3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maping = mapinguser::where('user_id',Auth::user()->id)
                    ->first();
        $transfer = DB::table('transfer2s')
                ->join('plans as plan_pengirim', 'plan_pengirim.id', '=', 'transfer2s.pengirim_id')
                ->join('plans as plan_penerima', 'plan_penerima.id', '=', 'transfer2s.penerima_id')
                ->join('materials', 'materials.id', '=', 'transfer2s.material_id')
                ->leftJoin('materials as material_update', 'material_update.id', '=', 'transfer2s.material_update_id')
                ->join('transfers', 'transfers.id', '=', 'transfer2s.transfer_id')
                ->join('users', 'users.id', '=', 'transfers.user_id')
                ->select([
                    'users.id as id_user',
                    'transfer2s.id as id',
                    'transfer2s.transfer_id as tf',
                    'plan_pengirim.name as plan_pengirim_name',
                    'plan_penerima.name as plan_penerima_name',
                    'materials.material_code as materials',
                    'materials.material_description',
                    'materials.mnemonic',
                    'materials.part_number',
                    'transfer2s.material_dokumen',
                    'transfer2s.item',
                    'users.name as pic',
                    'transfer2s.pengganti',
                    'transfer2s.status',
                    'transfer2s.status_pengiriman',
                    'transfer2s.diterima_oleh',
                    'transfer2s.estimate_time_arrival',
                    'material_update.material_description as material_update'
                ])
                ->where('transfer2s.pengirim_id', '=', $maping->plan_id)
                ->get();

        return view('TransferKeluarList',compact(['transfer']));
    }

    public function TransferMasukGet(){
        $maping = mapinguser::where('user_id',Auth::user()->id)
        ->first();
    
        $transfer = DB::table('transfer2s')
            ->join('plans as plan_pengirim', 'plan_pengirim.id', '=', 'transfer2s.pengirim_id')
            ->join('plans as plan_penerima', 'plan_penerima.id', '=', 'transfer2s.penerima_id')
            ->join('materials', 'materials.id', '=', 'transfer2s.material_id')
            ->join('transfers', 'transfers.id', '=', 'transfer2s.transfer_id')
            ->join('users', 'users.id', '=', 'transfers.user_id')
            ->select([
                'transfer2s.id as id',
                'transfer2s.transfer_id as tf',
                'plan_pengirim.name as plan_pengirim_name',
                'plan_penerima.name as plan_penerima_name',
                'materials.material_code as materials',
                'materials.material_description',
                'materials.mnemonic',
                'materials.part_number',
                'transfer2s.material_dokumen',
                'transfer2s.item',
                'users.name as pic',
                'transfer2s.pengganti',
                'transfer2s.status',
                'transfer2s.status_pengiriman',
                'transfer2s.diterima_oleh'
            ])
            ->where('transfer2s.penerima_id', '=', $maping->plan_id)
            ->where('transfer2s.status_pengiriman', '=', 'belum')
            ->get();

        return view('TransferMasukList',compact(['transfer']));
    }

    public function TransferMasukGetDiterima(){
        $maping = mapinguser::where('user_id',Auth::user()->id)
        ->first();
    
        $transfer = DB::table('transfer2s')
            ->join('plans as plan_pengirim', 'plan_pengirim.id', '=', 'transfer2s.pengirim_id')
            ->join('plans as plan_penerima', 'plan_penerima.id', '=', 'transfer2s.penerima_id')
            ->join('materials', 'materials.id', '=', 'transfer2s.material_id')
            ->join('transfers', 'transfers.id', '=', 'transfer2s.transfer_id')
            ->join('users', 'users.id', '=', 'transfers.user_id')
            ->select([
                'transfer2s.id as id',
                'transfer2s.transfer_id as tf',
                'plan_pengirim.name as plan_pengirim_name',
                'plan_penerima.name as plan_penerima_name',
                'materials.material_code as materials',
                'materials.material_description',
                'materials.mnemonic',
                'materials.part_number',
                'transfer2s.material_dokumen',
                'transfer2s.item',
                'users.name as pic',
                'transfer2s.pengganti',
                'transfer2s.status',
                'transfer2s.status_pengiriman',
                'transfer2s.diterima_oleh'
            ])
            ->where('transfer2s.penerima_id', '=', $maping->plan_id)
            ->where('transfer2s.status_pengiriman', '=', 'diterima')
            ->get();

        return view('TransferMasukListDiterima',compact(['transfer']));
    }

    public function TransferKeluarPost(){
        $maping = DB::table('mapingusers')
            ->join('users', 'users.id', '=', 'mapingusers.user_id')
            ->join('plans', 'plans.id', '=', 'mapingusers.plan_id')
            ->select('users.name as namee', 'plans.name as planename', 'mapingusers.*')
            ->where('user_id', '=',Auth::user()->id)
            ->get();

        $plan = plan::all();

        $material = Material::all();


        return view('TransferKeluarPost',compact(['maping','plan','material']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'user_id'=>'required',
            'pengirim_id' => 'required',
            'material_id' => 'required',
            'penerima_id' => 'required',
            'material_dokumen' => 'required',
            'item' => 'required',
            'pengganti' => 'required',
            'status' => 'required',
        ]);

        
        try {
            DB::beginTransaction();
            $tgl = $request->tanggal;
            $tgl_str = date('Y-m-d',strtotime($tgl));
            if($tgl_str == null){
                $trasnfer = Transfer::create([
                    'user_id' => $request->user_id
                ]);
    
                $transfer2 = Transfer2::create([
                    'transfer_id' => $trasnfer->id,
                    'pengirim_id' => $request->pengirim_id,
                    'material_id' => $request->material_id,
                    'penerima_id' => $request->penerima_id,
                    'material_dokumen' => $request->material_dokumen,
                    'item' => $request->item,
                    'pengganti' => $request->pengganti,
                    'status' => $request->status,
                    'status_pengiriman' => "belum"
                ]);

            } else {
                $trasnfer = Transfer::create([
                    'user_id' => $request->user_id
                ]);
                $tgl = $request->tanggal;
                $tgl_str = date('Y-m-d',strtotime($tgl));
                $transfer2 = Transfer2::create([
                    'transfer_id' => $trasnfer->id,
                    'pengirim_id' => $request->pengirim_id,
                    'material_id' => $request->material_id,
                    'penerima_id' => $request->penerima_id,
                    'material_dokumen' => $request->material_dokumen,
                    'item' => $request->item,
                    'pengganti' => $request->pengganti,
                    'status' => $request->status,
                    'status_pengiriman' => "belum",
                    'estimate_time_arrival' => $tgl_str
                ]);

                
            }

            
            
            DB::commit();
            return redirect()->route('transfer.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollback();
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $maping = mapinguser::where('user_id',Auth::user()->id)
        ->first();
    
        $transfer = DB::table('transfer2s')
            ->join('plans as plan_pengirim', 'plan_pengirim.id', '=', 'transfer2s.pengirim_id')
            ->join('plans as plan_penerima', 'plan_penerima.id', '=', 'transfer2s.penerima_id')
            ->join('materials', 'materials.id', '=', 'transfer2s.material_id')
            ->join('transfers', 'transfers.id', '=', 'transfer2s.transfer_id')
            ->join('users', 'users.id', '=', 'transfers.user_id')
            ->select([
                'transfer2s.id as id',
                'transfer2s.transfer_id as id_2',
                'plan_pengirim.name as plan_pengirim_name',
                'plan_penerima.name as plan_penerima_name',
                'materials.material_code as materials',
                'materials.material_description',
                'materials.mnemonic',
                'materials.part_number',
                'transfer2s.material_dokumen',
                'transfer2s.item',
                'users.name as pic',
                'transfer2s.pengganti',
                'transfer2s.status',
                'transfer2s.status_pengiriman',
                'transfer2s.diterima_oleh'
            ])
            ->where('transfer2s.id', '=', $id)
            ->first();

            $maping = DB::table('mapingusers')
            ->join('users', 'users.id', '=', 'mapingusers.user_id')
            ->join('plans', 'plans.id', '=', 'mapingusers.plan_id')
            ->select('users.name as namee', 'plans.name as planename', 'mapingusers.*')
            ->where('user_id', '=',Auth::user()->id)
            ->get();

        $plan = plan::all();

        $material = Material::all();
       
        return view('TransferKeluarEdit',compact(['transfer','maping','plan','material']));
    }

    public function Penerimaan($id){
        $maping = mapinguser::where('user_id',Auth::user()->id)
        ->first();
    
        $transfer = DB::table('transfer2s')
            ->join('plans as plan_pengirim', 'plan_pengirim.id', '=', 'transfer2s.pengirim_id')
            ->join('plans as plan_penerima', 'plan_penerima.id', '=', 'transfer2s.penerima_id')
            ->join('materials', 'materials.id', '=', 'transfer2s.material_id')
            ->join('transfers', 'transfers.id', '=', 'transfer2s.transfer_id')
            ->join('users', 'users.id', '=', 'transfers.user_id')
            ->select([
                'transfer2s.id as id',
                'transfer2s.transfer_id as id_2',
                'plan_pengirim.name as plan_pengirim_name',
                'plan_penerima.name as plan_penerima_name',
                'materials.material_code as materials',
                'materials.material_description',
                'materials.mnemonic',
                'materials.part_number',
                'transfer2s.material_dokumen',
                'transfer2s.item',
                'users.name as pic',
                'transfer2s.pengganti',
                'transfer2s.status',
                'transfer2s.status_pengiriman',
                'transfer2s.diterima_oleh'
            ])
            ->where('transfer2s.id', '=', $id)
            ->first();

            $maping = DB::table('mapingusers')
            ->join('users', 'users.id', '=', 'mapingusers.user_id')
            ->join('plans', 'plans.id', '=', 'mapingusers.plan_id')
            ->select('users.name as namee', 'plans.name as planename', 'mapingusers.*')
            ->where('user_id', '=',Auth::user()->id)
            ->get();

        $plan = plan::all();

        $material = Material::all();
       
        return view('TransferDiterima',compact(['transfer','maping','plan','material']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transfer2 $transfer)
    {
    //dd($transfer);
        $request->validate([
            // 'status'=>'required',
            'diterima_oleh' => 'required',
            // 'path_image' => 'required',
            // 'path_image.*' => 'jpg,jpeg,png|max:2000'
            'path_image' => 'required|file|mimes:jpg,jpeg,png|max:2000' // 2MB
        ]);
        try {
            //dd($transfer);
             DB::beginTransaction();
            
            $transfer->update([
                'status_pengiriman' => 'diterima',
                'diterima_oleh' => $request->input('diterima_oleh'),
            ]);
            //dd($transfer);
            // $image = $request->file('path_image');
            // $path = $image->store('Images');
            // Storage::move(storage_path($path), public_path('Images'));
            $imageName = time().'.'.$request->path_image->extension();
            $uploadedImage = $request->path_image->move(public_path('Images'), $imageName);
            $imagePath = 'Images/' . $imageName;
            
            //dd($imagePath);
             // file
            // dd($image);

            // if ($image) {
            //   $path = $image->store('Images'); // Images/[nama otomatis ke generate].[extensi]

              File::create([
                'transfer2_id' => $transfer->id,
                'path' => $imagePath,
              ]);
           // }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
       

        return redirect()->back()->with(['success'=>'Data Berhasil ditambah']);

        // dd($request);
        // $request->validate([
        //     'status_pengiriman'=>'required',
        //     'diterima_oleh' => 'required',
        //     'path_image' => 'required',
        //     'path_image.*' => 'jpg,jpeg,png|max:2000'
        // ]);

        // try {
        //      DB::beginTransaction();
             
        //     $transfer->update([
        //         'status_pengiriman' => $request->input('status'),
        //         'diterima_oleh' => $request->input('diterima_oleh'),
        //     ]);

        //     $imageName = time().'.'.$request->path_image->extension();
        //     $uploadedImage = $request->path_image->move(public_path('Images'), $imageName);
        //     $imagePath = 'Images/' . $imageName;

        //     $file = File::create([
        //         'transfer2_id' => $transfer->id,
        //         'path' => $imagePath,
        //     ]);

        //     DB::commit();
        // } catch (\Throwable $th) {
        //     DB::rollback();
        // }
       

        // return redirect()->back()->with(['success'=>'Data Berhasil ditambah']);
    }

    public function Pengganti(Request $request, Transfer2 $transfer)
    {
        $request->validate([
            'material_update'=>'required',
            'item' => 'required',
            'pengganti' => 'required',
            'status' => 'required',
        ]);

        $transfer->update([
            'material_update' => $request->input('material_update'),
            'item' => $request->input('item'),
            'pengganti' => 'no',
            'status' => 'close',
        ]);
        

        return redirect()->route('transfer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Transfer $transfer)
    // {
    //     //
    // }

    public function destroy($id)
    {
        $data2 = Transfer2::findOrfail($id);
        $data2->delete();
        $data = Transfer::findOrfail($id);
        $data->delete();
        return redirect()->back();
    }
}
