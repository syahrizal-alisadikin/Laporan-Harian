<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Penjualan;
use PDF;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time = date('Y-m-d');

        $total = Penjualan::where('tanggal', $time)->with('barang')->sum('total');
        $penjualan = Penjualan::where('tanggal', $time)->with('barang')->get();
        // dd($penjualan);
        $data = Barang::all();
        return view('penjualan', compact('data', 'penjualan', 'total'));
    }

    public function getBarang($id)
    {
        $data = Barang::where('id', $id)->get();
        return response()->json($data);
    }

    public function cetak_pdf()
    {
        $time = date('Y-m-d');

        $total = Penjualan::where('tanggal', $time)->with('barang')->sum('total');
        $penjualan = Penjualan::where('tanggal', $time)->with('barang')->get();

        $pdf = PDF::loadview('penjualan_pdf', compact('total', 'penjualan'));
        return $pdf->stream();
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

        $time = date('Y-m-d');
        $data = [
            'id_barang' => $request->id_barang,
            'quantity' => $request->quantity,
            'diskon' => $request->diskon,
            'total' => $request->total,
            'tanggal' => $time,
        ];

        Penjualan::create($data);
        return redirect()->route('penjualan.index');
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
        //
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
        //
    }
}
