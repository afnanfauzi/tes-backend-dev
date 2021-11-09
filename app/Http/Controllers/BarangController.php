<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use App\CustomHelpers\ImageHelper;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $barang = Barang::all();
        if($request->ajax()){
            return datatables()->of($barang)
                        ->addColumn('action', function($data){
                            $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm edit-post" title="Edit Data"><i class="fa fa-edit fa-sm"></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm" title="Hapus Data"><i class="fa fa-trash fa-sm"></i></button>';       
                            return $button;
                        })->addColumn('image', function ($data) {
                            $url= asset('storage/gambar/'.$data->foto);
                            return '<img src="'.$url.'" border="0" width="60" align="center" />';
                        })
                        ->rawColumns(['action', 'image'])
                        ->addIndexColumn()
                        ->make(true);
        }
    
            return view('barang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        //    

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = $request->id;

        $messages = [
            'nama.required' => 'Masukkan nama terlebih dahulu.',
            'kode.required' => 'Masukkan kode terlebih dahulu.',
            'harga_beli.required' => 'Masukkan harga beli terlebih dahulu.',
            'harga_jual.required' => 'Masukkan harga jual terlebih dahulu.',
            'stok.required' => 'Masukkan jumlah stok terlebih dahulu.',
            'harga_beli.numeric' => 'Hanya menerima inputan angka.',
            'harga_jual.numeric' => 'Hanya menerima inputan angka.',
            'stok.numeric' => 'Hanya menerima inputan angka.',
        ];

        //validate data
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kode' => 'required',
            'harga_beli' => 'required | numeric',
            'harga_jual' => 'required | numeric',
            'stok' => 'required | numeric',
            'file' => 'mimes:jpg,png  | max:100'
        ], $messages);


        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => $messages,
                'data'    => $validator->errors()
            ],401);

        }else {

            $old = $request->fotoLama;
        

            if ($request->file('file') && $request->fotoLama == NULL) {
                $imageName = ImageHelper::addImage($request->file('file'));
            }else if($request->file('file') && $request->fotoLama){
                $imageName = ImageHelper::changeImage($request->file('file'), $old);
            }else{
                $imageName = $old;
            } 
            
            // conv ke huruf kapital
            $conv_kode = strtoupper($request->kode);

            $barang   =   Barang::updateOrCreate(['id' => $id],
                        [
                            'nama' => $request->nama,
                            'kode' => $conv_kode,
                            'harga_beli' => $request->harga_beli,
                            'harga_jual' => $request->harga_jual,
                            'stok' => $request->stok,
                            'foto' => $imageName ?? '-',
                        ]); 

        
            
            if ($barang) {

                return response()->json([
                    'success' => true,
                    'message' => 'Barang Berhasil Ditambahkan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Barang Gagal Ditambahkan!',
                ], 401);
            }
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $barang  = Barang::where($where)->first();
     
        return response()->json($barang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::where('id',$id)->get();
        
        // dd($barang[0]->foto);
        ImageHelper::deleteImage($barang[0]->foto);
        $barang->each->delete();
     
        return response()->json($barang);
    }

}
