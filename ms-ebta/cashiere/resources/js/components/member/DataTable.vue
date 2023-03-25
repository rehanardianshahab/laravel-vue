<script>
// import member from './member.vue';
export default {
  // components: { member },
  data() {
    return {
      // for datatables
        columns: [
          {data: 'select_all', searchable: false, sortable: false},
          {data: 'DT_RowIndex', searchable: false, sortable: true},
          {data: 'code'},
          {data: 'name'},
          {data: 'address'},
          {data: 'phone'},
          {data: 'action', searchable: false, sortable: false}
        ],
      // data member
        member : {
          'selected' : 'one',
          'data' : {
            'name' : "data member",
            'data':[]
          }
        },
      // for api url
        url: import.meta.env.VITE_APP_URL,
        getApi: import.meta.env.VITE_APP_API+'/member',
      // for post sata
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      // for confirm box
        confirm:'',
        pesanErr: ''
    }
  },
  methods: {
    cetakMember(url) {
      if ($('input:checked').length < 1) {
        alert('Pilih data yang akan dicetak');
        return;
      } else {
        $('.form-member')
        .attr('action', this.url+'member/'+url)
        .attr('target', '_blank')
        .attr('method', 'post')
        .submit();
      }
    },
    closeNotif() {
        // reset alert
        if ($( "#notif" ).hasClass('d-none')) {

        } else {
            $( "#notif" ).addClass( 'd-none');
        }
        // reset alert
        if ($( "#notif-utama" ).hasClass('d-none')) {

        } else {
            $( "#notif-utama" ).addClass( 'd-none');
        }
    },
    getMember() {
      // get data member
      $.get(this.url+"api/member")
            .done((response) => {
              this.member.data = response.data;
            })
            .fail((error) => {
                // set alert dan munculkan alert
                $("#notif").attr('class', '');
                $( "#notif" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
                // isi tulisan
                $('#notif .text').html( error.responseJSON.message );
                return;
            })
    },
    addForm() {
        $('#FormModal').modal('show');
        $('#FormModal .modal-title').text('Add New member');

        // // action
        $('#FormModal form').attr('action', this.getApi)

        // // method form
        $('#FormModal [name=_method]').val('post');

        // // input form
        $('#FormModal [name=name]').focus();

        // close notif
        this.closeNotif();
    },
    editForm(id) {
        $('#FormModal').modal('show');
        $('#FormModal .modal-title').text('Edit member');

        // // action
        $('#FormModal form').attr('action', this.getApi+"/"+id);

        // // method form
        $('#FormModal [name=_method]').val('put');

        // // input form
        $('#FormModal [name=name]').focus();

        $.get(this.getApi+"/"+id)
            .done((response) => {
                $('#FormModal [name=name]').val(response.data[0].name);
                $('#FormModal [name=phone]').val(response.data[0].telp);
                $('#FormModal [name=address]').val(response.data[0].address);
            })
            .fail((error) => {
                // set alert dan munculkan alert
                $("#notif").attr('class', '');
                $( "#notif" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
                // membuat pesan error
                this.pesanErr = error.responseJSON;
                return;
            })
        
        // close notif
        this.closeNotif();
    },
    deleteForm (id) {
      // munculkan modal
      $('#modalConfirm').modal('show');
      // ganti judul
      $('#modalConfirm .modal-title').text('Confirm delete data');
      // confirm
      $('#modalConfirm .modal-body').text(`
          Apakan yakin mau menghapus data?
      `);
      // ganti rule
      this.confirm = id;
    },
    resetForm () {
      // reset form
      $('#FormModal form')[0].reset();
      this.closeNotif();
      this.member.selected = "one";
    },
    // get data in datatable
    datatable() {
      $('#table').DataTable({
        ajax: {
          url: this.getApi,
          type: 'GET',
        },//memanggil data dari data api dengan ajax, disimpan di DataTable
        columns: this.columns,
        dom: 'Bfrtip',
        buttons: [
            'pageLength',
            'colvis',
            'spacer',
            'copyHtml5',
            'pdfHtml5',
            'print',
            'csvHtml5',
            {
              extend: 'excel',
              text: 'exel',
              exportOptions: {
                  modifier: {
                    page: 'current'
                  }
              }
            },
        ]
      });
    },
    submitForm() {
        $.ajax({
            url: $('#FormModal form').attr('action'),
            type: $('#FormModal [name=_method]').val(),
            data: $('#FormModal form').serialize()
        }).done((response) => {
            // hilangkan modal
            $('#FormModal').modal('hide');
            // reload table
            $('#table').DataTable().ajax.reload();
            // set alert dan munculkan alert
            $("#notif-utama").attr('class', '');
            $( "#notif-utama" ).addClass( 'alert alert-success alert-dismissible mb-3 show');
            // reset form
            $('#FormModal form')[0].reset();
            // isi tulisan
            if ( $('[name=_method]').val() == 'put' ) {
                $('#notif-utama .text').text("Updated data success");
            } else if ( $('[name=_method]').val() == 'post' ) {
                $('#notif-utama .text').text("Add new data success");
            }
        }).fail((error) => {
            // set alert dan munculkan alert
            $("#notif").attr('class', '');
            $( "#notif" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
            // membuat pesan error
            this.pesanErr = error.responseJSON;
            console.log(error.responseJSON.message);
            return;
        });
    },
    deleteData(id) {
        let urlApi = this.getApi+"/"+id;
        $.ajax({
            url: urlApi,
            type: 'delete',
        }).done((response) => {
            // hilangkan modal
            $('#modalConfirm').modal('hide');
            // reload table
            $('#table').DataTable().ajax.reload();
            // set alert dan munculkan alert
            $("#notif-utama").attr('class', '');
            $( "#notif-utama" ).addClass( 'alert alert-success alert-dismissible mb-3 show');
            /// isi tulisan
            $('#notif-utama .text').text("Data deleted");
        }).fail((error) => {
            // set alert dan munculkan alert
            $("#notif").attr('class', '');
            $( "#notif" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
            // membuat pesan error
            this.pesanErr = error.responseJSON;
            return;
        });
    },
    deleteSelected(url) {
      if ($('input:checked').length > 1) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
          // $.post(this.getApi+url, $('.form-member').serialize())
          $.ajax({
            url: this.getApi+url,
            type: 'post',
            data: $('.form-member').serialize()
          }).done( (response) => {
              // reload table
              $('#table').DataTable().ajax.reload();
              // set alert dan munculkan alert
              $("#notif-utama").attr('class', '');
              $( "#notif-utama" ).addClass( 'alert alert-success alert-dismissible mb-3 show');
              // isi tulisan
              $('#notif-utama .text').text("Delete data success");
              // hide button
              if ($( "#multipledelete" ).hasClass('d-none')) {
                $('#multipledelete').removeClass( "d-none" );
                $('#multipledelete').addClass( "d-block" );
              } else {
                $( "#multipledelete" ).addClass( 'd-block');
                $( "#multipledelete" ).addClass( 'd-none');
              }
          }).fail( (error) => {
            console.log(error);
            // set alert dan munculkan alert
            $("#notif-utama").attr('class', '');
            $( "#notif-utama" ).addClass( 'alert alert-danger alert-dismissible mb-3 show');
            // isi tulisan
            $('#notif-utama .text').html( 'Cannot deleting the data' );
            return;
          });
        }
      } else {
        alert('Pilih data yang akan dihapus sehingga lebih dari 1');
      }
    },
  },
  mounted() {
    this.datatable();

    let edit = this.editForm;
    let deleteForm = this.deleteForm;
    let deleteData = this.deleteData;

    // const self = this
    $('tbody', this.$refs.table).on( 'click', '.editData', function(){
        let theid = $(this).attr('data-idedit');
        edit(theid);
    });
    // open delete form
    $('tbody', this.$refs.table).on( 'click', '.deleteData', function(){
        let theid = $(this).attr('data-iddelete');
        deleteForm(theid);
    });
    // deleting data
    $('#confirm').on('click', function(){
      let theid = $('#confirm').attr('data-term');
      deleteData(theid);
    });
    this.getMember();
    // select all
    $('#select_all').on('click', function () {
      // check all and un check all
      $(':checkbox').prop('checked', this.checked);

      // jika ada yang di check
      if ($('.checking').is(':checked')) {
        if ($( "#multipledelete" ).hasClass('d-none')) {
          $('#multipledelete').removeClass( "d-none" );
          $('#multipledelete').addClass( "d-block" );
        } else {
          // none
        }
        if ($( "#cetak" ).hasClass('d-none')) {
          $('#cetak').removeClass( "d-none" );
          $('#cetak').addClass( "d-block" );
        } else {
          // none
        }
      } else {
        // multiple delete
        if ($( "#multipledelete" ).hasClass('d-none')) {
          $('#multipledelete').removeClass( "d-none" );
          $('#multipledelete').addClass( "d-block" );
        } else {
          $( "#multipledelete" ).addClass( 'd-block');
          $( "#multipledelete" ).addClass( 'd-none');
        }
        $('#multipledelete').addClass( "d-none" );
        // cetak
        if ($( "#cetak" ).hasClass('d-none')) {
          $('#cetak').removeClass( "d-none" );
          $('#cetak').addClass( "d-block" );
        } else {
          $( "#cetak" ).addClass( 'd-block');
          $( "#cetak" ).addClass( 'd-none');
        }
        $('#cetak').addClass( "d-none" );
        $(':checkbox').prop('checked', this.checked);
      }
    });
    // show hide button
    $('tbody', this.$refs.table).on( 'click', '.checking', function(){
      if ($('.checking').is(':checked')) {
        if ($( "#multipledelete" ).hasClass('d-none')) {
          $('#multipledelete').removeClass( "d-none" );
          $('#multipledelete').addClass( "d-block" );
        }
        if ($( "#cetak" ).hasClass('d-none')) {
          $('#cetak').removeClass( "d-none" );
          $('#cetak').addClass( "d-block" );
        }
      } else {
        $('#multipledelete').addClass( "d-none" );
        $('#cetak').addClass( "d-none" );
        $(':checkbox').prop('checked', this.checked);
      }
    });
  }
}
</script>

<template>
  <section class="content">
    <!-- modal box for form -->
    <div class="modal fade" id="FormModal" tabindex="-1" aria-labelledby="FormModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form action="" method="post" class="form-horizontal" @submit.prevent="submitForm()">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="FormModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Alert -->
            <div class="d-none" id="notif" data-not="1" role="alert">
              <span class="text">
                <span v-for="(value, key) in pesanErr" class="d-block" :key="key">
                  {{ value[0] }}
                </span>
              </span>
              <button type="button" class="btn-close" @click="closeNotif()"></button>
            </div>
            <!-- /.alert -->
            <div class="modal-body">
              <!-- csrf token dan method -->
              <input type="hidden" name="_token" :value="csrf">
              <input type="hidden" name="_method" value="post">
              <!-- end csrf token dan method -->
              <div class="form-group row">
                <label for="name" class="col-md-4 control-label">member Name</label>
                <div class="col-md-8">
                  <input type="text" name="name" id="name" class="form-control" placeholder="add name of member" autocomplete="off">
                  <span class="help-block with-errors"></span>
                </div>
              </div>
              <div class="form-group row mt-1">
                <label for="phone" class="col-md-4 control-label">Phone</label>
                <div class="col-md-8">
                  <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input type="number" name="phone" id="phone" class="form-control" placeholder="add phone number" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="form-group row mt-1">
                <label for="address" class="col-md-4 control-label">Address</label>
                <div class="col-md-8">
                    <textarea name="address" id="address" class="form-control" required autocomplete="off" placeholder="Address of Live"></textarea>
                    <span class="help-block with-errors"></span>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetForm()">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- confirm box -->
    <!-- modal box for delete form -->
    <div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="modalConfirmLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fs-5" id="modalConfirmLabel">Konfirmasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <span :data-term="confirm" id="confirm" class="btn confirm btn-primary">Yes</span>
          </div>
        </div>
      </div>
    </div>

    <!-- main page -->
    <div class="container-fluid pb-5">

      <div class="row">
        <div class="col-md-12">

            <!-- Alert -->
            <div class="d-none" id="notif-utama" role="alert">
                <span class="text"></span>
                <button type="button" class="btn-close" @click="closeNotif()"></button>
            </div>
            <!-- /.alert -->

          <div class="card">
            <!-- card-header -->
            <div class="card-header">
              <div class="btn-group">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary xs btn-flat rounded" @click="addForm()"><i class="bi bi-patch-plus"></i> Add</button>
                <button id="multipledelete" class="btn btn-danger xs btn-flat rounded mx-1 d-none" @click="deleteSelected('/delete-selected')"><i class="bi bi-trash"></i> Delete</button>
                <button id="cetak" class="btn btn-secondary xs btn-flat rounded mx-1 d-none" @click="cetakMember('cetak-member')"><i class="bi bi-printer"></i> Cetak Kartu Member</button>
              </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive">
              <form action="" class="form-member">
                <input type="hidden" name="_token" :value="csrf">
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                    <tr role="row">
                      <th>
                        <div class="mx-3">
                          <input type="checkbox" name="select_all" id="select_all">
                        </div>
                      </th>
                      <th width="5%">No</th>
                      <th>Code</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Telp</th>
                      <th width="15%" class="fs-4"><i class="bi bi-gear-wide-connected"></i></th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </form>
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </div><!--/. container-fluid -->
  </section>
</template>