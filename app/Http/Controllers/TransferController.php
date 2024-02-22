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

use function Laravel\Prompts\select;

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
                    'transfer2s.lokasi_transit',
                    'material_update.material_description as material_update'
                ])
                ->where('transfer2s.pengirim_id', '=', $maping->plan_id)
                ->get();

        return view('TransferKeluarList',compact(['transfer']));
    }

    public function indexPengganti(){
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
                'transfer2s.matdoc_pengganti',
                'transfer2s.status',
                'transfer2s.status_pengiriman',
                'transfer2s.diterima_oleh',
                'transfer2s.estimate_time_arrival',
                'material_update.material_description as material_update'
            ])
            ->where('transfer2s.penerima_id', '=', $maping->plan_id)
            ->where('transfer2s.pengganti', '=', 'yes')
            ->get();

        return view('TransferPenggantiList',compact(['transfer']));
    }

    public function TransferGanti(){
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
            ->where('transfer2s.status', '=', 'open')
            ->get();

        return view('TransferPenggantiKeluarList',compact(['transfer']));
        // $maping = mapinguser::where('user_id',Auth::user()->id)
        //             ->first();
        // $transfer = DB::table('transfer2s')
        //         ->join('plans as plan_pengirim', 'plan_pengirim.id', '=', 'transfer2s.pengirim_id')
        //         ->join('plans as plan_penerima', 'plan_penerima.id', '=', 'transfer2s.penerima_id')
        //         ->join('materials', 'materials.id', '=', 'transfer2s.material_id')
        //         ->leftJoin('materials as material_update', 'material_update.id', '=', 'transfer2s.material_update_id')
        //         ->join('transfers', 'transfers.id', '=', 'transfer2s.transfer_id')
        //         ->join('users', 'users.id', '=', 'transfers.user_id')
        //         ->select([
        //             'users.id as id_user',
        //             'transfer2s.id as id',
        //             'transfer2s.transfer_id as tf',
        //             'plan_pengirim.name as plan_pengirim_name',
        //             'plan_penerima.name as plan_penerima_name',
        //             'materials.material_code as materials',
        //             'materials.material_description',
        //             'materials.mnemonic',
        //             'materials.part_number',
        //             'transfer2s.material_dokumen',
        //             'transfer2s.item',
        //             'users.name as pic',
        //             'transfer2s.pengganti',
        //             'transfer2s.status',
        //             'transfer2s.status_pengiriman',
        //             'transfer2s.diterima_oleh',
        //             'transfer2s.estimate_time_arrival',
        //             'material_update.material_description as material_update'
        //         ])
        //         ->where('transfer2s.pengirim_id', '=', $maping->plan_id)
        //         ->get();

        // return view('TransferKeluarList',compact(['transfer']));
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
                'transfer2s.matdoc_pengganti',
                'transfer2s.item',
                'users.name as pic',
                'transfer2s.pengganti',
                'transfer2s.status',
                'transfer2s.status_pengiriman',
                'transfer2s.lokasi_transit',
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
                'transfer2s.matdoc_pengganti',
                'transfer2s.lokasi_transit',
                'transfer2s.diterima_oleh'
            ])
            ->where('transfer2s.penerima_id', '=', $maping->plan_id)
            ->where('transfer2s.status_pengiriman', '=', 'diterima')
            ->get();

        return view('TransferMasukListDiterima',compact(['transfer']));
    }

    public function TransferPenggantiGet(){
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
                'transfer2s.matdoc_pengganti',
                'transfer2s.item',
                'users.name as pic',
                'transfer2s.pengganti',
                'transfer2s.status',
                'transfer2s.status_pengiriman',
                'transfer2s.diterima_oleh'
            ])
            ->where('transfer2s.penerima_id', '=', $maping->plan_id)
            ->where('transfer2s.status_pengiriman', '=', 'diterima')
            ->where('transfer2s.status', '=', 'open')
            ->get();

        return view('TransferMasukListDiterima2',compact(['transfer']));
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
            'nama_pengirim'=> 'required'
        ]);

        
        try {
            DB::beginTransaction();

            if($request->pengganti == "yes"){
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
                    'pengganti' => "yes",
                    'status' => "open",
                    'status_pengiriman' => "belum",
                    'lokasi_transit' => $request->lokasi_transit,
                    'nama_pengirim' => $request->nama_pengirim
                ]);

            } else {
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
                    'pengganti' => "no",
                    'status' => "close",
                    'status_pengiriman' => "belum",
                    'lokasi_transit' => $request->lokasi_transit,
                    'nama_pengirim' => $request->nama_pengirim
                ]);

                
            }

            DB::commit();
            return redirect()->route('transfer.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollback();
        }
        
    }

    public function InsertPengganti(Request $request){
       
        $request->validate([
            'user_id'=>'required',
            'pengirim_id' => 'required',
            'material_id' => 'required',
            'penerima_id' => 'required',
            'material_dokumen' => 'required',
            'item' => 'required',
            'matdoc_pengganti' => 'required',
            'parent_id' =>'required'
        ]);
       
        
        try {
            DB::beginTransaction();
                $transfer2 = Transfer2::find($request->parent_id);
                $transfer2->material_update_id = $request->material_update_id;
                $transfer2->item = $request->item;
                $transfer2->pengganti = 'no';
                $transfer2->status = 'close';
                $transfer2->save();

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
                    'pengganti' => 'no',
                    'status' => 'close',
                    'status_pengiriman' => "belum",
                    'parent_id' => $request->parent_id,
                    'nama_pengirim' => $request->nama_pengirim,
                    'matdoc_pengganti' => $request->matdoc_pengganti
                ]);

            

            DB::commit();
            return redirect()->route('transfer.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            dd($th);
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
                'plan_pengirim.id as plan_pengirim_id',
                'plan_pengirim.name as plan_pengirim_name',
                'plan_penerima.id as plan_penerima_name_id',
                'plan_penerima.name as plan_penerima_name',
                'materials.material_code as materials',
                'transfer2s.material_id',
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
                'transfer2s.parent_id'
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
                'transfer2s.matdoc_pengganti',
                'transfer2s.item',
                'users.name as pic',
                'transfer2s.pengganti',
                'transfer2s.status',
                'transfer2s.status_pengiriman',
                'transfer2s.diterima_oleh',
                'transfer2s.matdoc_pengganti',
                'transfer2s.lokasi_transit',
                'transfer2s.nama_pengirim',
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

    public function BuktiPenerimaan($id){
        $penerimaan = DB::table('transfer2s')
        ->join('files', 'files.transfer2_id', '=', 'transfer2s.transfer_id')
        ->join('materials', 'materials.id', '=', 'transfer2s.material_id')
        ->select([
            'transfer2s.diterima_oleh',
            'transfer2s.pr_pengganti',
            'transfer2s.estimate_time_arrival',
            'transfer2s.lokasi_transit',
            'transfer2s.material_dokumen',
            'transfer2s.matdoc_pengganti',
            'files.created_at',
            'files.path',
            'transfer2s.item',
            'materials.material_code',
            'materials.material_description'
        ])
        ->where('transfer2s.id', '=', $id)
        ->first();

        return view('TransferBuktiDIterima',compact(['penerimaan']));
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
   //dd($request);
        $request->validate([
            // 'status'=>'required',
            'diterima_oleh' => 'required',
            // 'path_image' => 'required',
            // 'path_image.*' => 'jpg,jpeg,pg|max:2000'
            'path_image' => 'required|file|mimes:jpg,jpeg,png|max:2000' // 2MB
        ]);

        try {
            //dd($transfer);
             DB::beginTransaction();
             $tgl = $request->input('tanggal');
             $tgl_str = date('Y-m-d',strtotime($tgl));
            $transfer->update([
                'status_pengiriman' => 'diterima',
                'diterima_oleh' => $request->input('diterima_oleh'),
                'estimate_time_arrival' => $tgl_str,
                'pr_pengganti' => $request->input('pr_pengganti')
            ]);
            //dd($transfer);
            // $image = $request->file('path_image');
            // $path = $image->store('Images');
            // Storage::move(storage_path($path), public_path('Images'));
            $imageName = time().'.'.$request->path_image->extension();
            $uploadedImage = $request->path_image->move(public_path('Images'), $imageName);
            $imagePath = 'Images/' . $imageName;
            
           // dd($imagePath);
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
            return redirect()->route('transfer.terima');
        } catch (\Throwable $th) {
            DB::rollback();
        }
       


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

    public function update2(Request $request, Transfer2 $transfer)
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
                'path2' => $imagePath,
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
        // dd($request);
        $request->validate([
            'material_update_id'=>'required',
            'item' => 'required',
        ]);
        //dd($request);


        $transfer->update([
            'material_update_id' => $request->input('material_update_id'),
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

    public function Bukti_null(){
        return view('bukti_null');
    }
}
