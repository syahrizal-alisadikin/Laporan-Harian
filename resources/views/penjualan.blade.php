<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <title>Ropi Zubaed</title>
  </head>
  <body>
    <div class="container mt-4">
        <div class="row">
            
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-center mb-3">Input Data Penjualan <?= date('d-m-Y')?> Ropi Zubaed</h6>
                    <form action="{{route('penjualan.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="name">Nama Barang</label>
                                    <select name="id_barang" id="nama_barang" class="form-control">
                                            <option value="">Pilih Barang</option>
                                                @foreach ($data as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="harga">Harga</label>
                                    <input type="text"  name="harga" id="harga" class="form-control">
                           
                                </div>
                                <div class="col">
                                    <label for="diskon">Diskon</label>
                                    <input type="text" name="diskon" id="diskon" class="form-control">
                            
                                </div>
                                <div class="col">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" name="total"  id="total" class="form-control">
                                </div>
                                
                            </div>
                            
                            <div class="from-group text-center mt-3">
                                <button type="submit" class="btn btn-success"style="border-radius:10px; padding:5px 30px">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                    <h6 class="text-center mb-3"><b>Laporan Penjualan <?= date('d-m-Y')?></b> <a href="{{route('cetak_pdf')}}" class="btn btn-warning">Cetak Pdf</a></h6>
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">Nama Barang</th>
                                <th scope="col" class="text-center">Harga</th>
                                <th scope="col" class="text-center">Diskon</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1?>
                             @forelse ($penjualan as $jual)
                                  <tr>
                                      <td><?= $i?></td>
                                  <td class="text-center">{{$jual->barang->name}}</td>
                                  <td class="text-center">Rp {{number_format($jual->barang->harga)}}</td>
                                  <td class="text-center">{{$jual->diskon}}%</td>
                                  <td class="text-center">{{$jual->quantity}}Pcs</td>
                                  <td class="text-right">Rp {{number_format($jual->total)}}</td>
                                  </tr>
                                  <?php $i++?>
                              
                             @empty
                                <tr>
                                  <td colspan="6" class="text-center" >Belum Ada Penjualan</td>
                              </tr>
                             @endforelse
                              <tr>
                                  <td colspan="6" class="text-right" style="margin-rigt:-100px">Rp {{number_format($total)}}</td>
                              </tr>
                               
                            </tbody>
                            
                        </table>

                            
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
         
        } );

        $(document).ready(function(){
            
               $("#nama_barang").on("change",function(){
                const id = $(this).val();
                const harga = $("#harga").val();

                // alert(harga);
                $.ajax({
                    type : 'get',
                    url : `getBarang/${id}`,
                    data:{id: id},
                    success:function(barang){
                        // console.log(barang[0].harga);
                        $("#harga").html("");
                        barang.map((value, key) => {
                        $("#harga").val(`${value.harga}`);
                        

                        });
                    }
                });
            })

        });
        $(document).ready(function(){
            $("#quantity").on("keyup",function(){
                const harga = $("#harga").val();
                const diskon = $("#diskon").val();
                const quntity = $(this).val();
                const jumlah = (harga - (harga * diskon / 100)) * quntity;
                $("#total").val(`${jumlah}`);
            });
        });
    </script>
</body>
</html>