<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Supplier</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-supplier">
                        <thead>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Telepon</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Opsi</th>
                        </thead>
                        <tbody>
                            @foreach ($supplier as $key => $data)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center">{{ $data->name }}</td>
                                    <td class="text-center">{{ $data->phone_number }}</td>
                                    <td class="text-center">{{ $data->address }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('purchases/'.$data->id.'/create') }}" class="btn btn-info pull-right">
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