<div class="modal fade" id="modal-product" tabindex="-1" role="dialog" aria-labelledby="modal-product">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Produk</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-product">
                        <thead>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Harga Beli</th>
                            <th class="text-center">Opsi</th>
                        </thead>
                        <tbody>
                            @foreach ($product as $key => $data)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center"><span class="badge badge-success">{{ $data->product_code }}</span></td>
                                    <td class="text-center">{{ $data->name_product }}</td>
                                    <td class="text-center">{{ $data->purchase_price }}</td>
                                    <td class="text-center">
                                        <a href="#" onclick="selectProduct('{{ $data->id }}', '{{ $data->product_code }}')" class="btn btn-info pull-right">
                                            <i class="fa-regular fa-circle-check"></i>&nbsp; 
                                            Pilih
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>