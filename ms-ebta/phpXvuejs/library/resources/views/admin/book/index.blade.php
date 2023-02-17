@extends('layouts.app3')

@section('content')
<div id="containerVue">
    {{-- modal detil --}}
    <div class="modal fade" id="modal-detil">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="info-box-text h6 p-3 m-3">
                    <h4 class="modal-title">Data Buku @{{ dataBooks.title }}</h4>
                    <ul>
                        <li>Tahun terbit : @{{ dataBooks.isbn }}</li>
                        <li>Tahun terbit : @{{ dataBooks.year }}</li>
                        <li>Penerbit : @{{ dataPublishers.name }}</li>
                        <li>Penulis : @{{ dataPenulis.name }}</li>
                        <li>Katalog : @{{ dataKatalog.name }}</li>
                        <li>Jumlah : @{{ dataBooks.qty }}</li>
                        <li>Harga : Rp @{{ harga }},-</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" :action="actionUrl" method="post" autocomplete="off" @submit.prevent="submitForm($event, dataBooks.id)">
            <div class="modal-header">
            <h4 class="modal-title">@{{ titleBox }}</h4>
            <button title="close modal v1" type="submit" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="text-danger text-center" id="eror"></div>
            <div class="modal-body">
            {{-- <input type="hidden" name="_method" value="PUT" v-if="statusEdit"> --}}
                @csrf {{-- untuk get token --}}
                <div class="card-body">
                    {{-- notif dan eror --}}
                    <div id="erorDelete"></div>

                    <div class="form-group row">
                        <label for="inputIsbnBook" class="col-sm-2 col-form-label">Isbn</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputIsbnBook"  autocomplete="off" placeholder="Isbn Book" name="isbn"  :value="dataBooks.isbn" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTitleBook" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputTitleBook"  autocomplete="off" placeholder="Title Book" name="title"  :value="dataBooks.title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputTahunBook" class="col-sm-2 col-form-label">Tahun</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputTahunBook"  autocomplete="off" placeholder="Year of Book" name="year"  :value="dataBooks.year" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPublisherBook" class="col-sm-2 col-form-label">Publisher</label>
                        <div class="col-sm-10">
                            <select name="publisher_id" id="inputPublisherBook" class="form-control">
                                <option>Pilih publisher</option>
                                <option v-for="publisher in publishers" :value="publisher.id" v-if="publisher.id == selectedPublishers" selected>@{{ publisher.name }}</option>
                                <option v-for="publisher in publishers" :value="publisher.id" v-else>@{{ publisher.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAuthorBook" class="col-sm-2 col-form-label">Author</label>
                        <div class="col-sm-10">
                            <select name="author_id" id="inputAuthorBook" class="form-control">
                                <option>Pilih author</option>
                                <option v-for="author in authors" :value="author.id" v-if="author.id == selectedAuthors" selected>@{{ author.name }}</option>
                                <option v-for="author in authors" :value="author.id" v-else>@{{ author.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputCatalogBook" class="col-sm-2 col-form-label">Catalog</label>
                        <div class="col-sm-10">
                            <select name="catalog_id" id="inputCatalogBook" class="form-control">
                                <option>Pilih Katalog</option>
                                <option v-for="catalog in catalogs" :value="catalog.id" v-if="catalog.id == selectedCatalogs" selected>@{{ catalog.name }}</option>
                                <option v-for="catalog in catalogs" :value="catalog.id" v-else>@{{ catalog.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputQtyBook" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputQtyBook"  autocomplete="off" placeholder="Jumlah Book" name="qty"  :value="dataBooks.qty" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPriceBook" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPriceBook"  autocomplete="off" placeholder="Price Book" name="price"  :value="dataBooks.price" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            <!-- /.card-footer -->
            </div>
            <div class="modal-footer justify-content-between">
            <button title="close modal" type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
            <button title="submit data" type="submit" class="btn btn-info">@{{  tombol  }}</button>
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <div class="row justify-content-center p-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Books') }}</div>

                <div class="card-body">
                    <div id="notif"></div>
                </div>

                <div class="card-body justify-content-center row">
                    <div class="input-group-mb-3 col-md-8 mb-5">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" autocomplete="off" placeholder="Search by title" v-model="search">
                        </div>
                    </div>
                    @can('mengelola peminjaman')
                        <div class="col-md-3">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default" @click="addData()">Creat New Book</button>
                        </div>
                    @endcan
                </div>

            </div>
        </div>

        <div class="col col-lg-5 col-md-6 coll-xs-12" v-for="book in filtered" id="dataLaman">
            <div class="info-box">
                <div class="info-box-content">
                    <span class="info-box-text h3">@{{ book.title }}</span>
                    <span class="info-box-number">Rp @{{ pricing(book.price) }},- <small></small> </span>
                </div>
                <div class="info-box-content col-3">
                    <a type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-detil" @click="detilData( book.id)">Detil</a>
                    @can('mengelola peminjaman')
                        <a type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default" @click="editData(book.id)">Edit</a>
                        <a type="button" class="btn btn-danger" @click="deletData($event, book.id)">Delete</a>
                    @endcan
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scriptLink')
    {{-- axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    {{-- vuejs --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
@endsection
@section('js')
    <script type="text/javascript">
        let actionUrl = '{{ url('books') }}';
        let apiUrl = '{{ url('api/books') }}';
        let titleBox = '';
        let dataBooks = '';
        let dataPublishers = '';
        let dataPenulis = '';
        let dataKatalog = '';
        let harga = '';

        var app = new Vue({
            el: '#containerVue',
            data: {
                harga,
                actionUrl,
                titleBox,
                books: [],
                publishers: [],
                authors: [],
                catalogs: [],
                dataBooks: [],
                dataPublishers: [],
                dataPenulis: [],
                dataKatalog: [],
                search: '',
                tombol: '',
                selectedPublishers: '',
                selectedAuthors: '',
                selectedCatalogs: '',
            },
            mounted: function () {
                this.get_books();
            },
            methods: {
                get_books() {
                    const _this = this;
                    // data books
                    $.ajax({
                        url: apiUrl,
                        method: 'GET',
                        success: function (data) {
                            _this.books = JSON.parse(data);
                            // console.log(_this.books);
                        },
                        error: function (error) {
                            // console.log(error);
                        }
                    });
                    // data publishers
                    axios.get('{{ url('api/publishers') }}')
                    .then(function (response) {
                        this.publishers = response.data.data;
                        // console.log(this.publishers);
                    }.bind(this)) //You need to put .bind(this) to keep the scoped variable
                    // data author
                    axios.get('{{ url('api/authors') }}')
                    .then(function (response) {
                        this.authors = response.data.data;
                        // console.log(this.authors);
                    }.bind(this)) //You need to put .bind(this) to keep the scoped variable
                    // data catalog
                    axios.get('{{ url('api/catalogs') }}')
                    .then(function (response) {
                        this.catalogs = response.data.data;
                        // console.log(this.catalogs);
                    }.bind(this)) //You need to put .bind(this) to keep the scoped variable
                    
                },
                pricing(price) {
                    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },

                // crud
                addData() {
                    this.titleBox = 'Tambah Data';
                    this.dataBooks = '';
                    this.tombol = 'Tambah';
                    this.actionUrl = '{{ url('books') }}',
                    this.statusEdit = false;
                    this.notstatusEdit = true;
                    this.eror = '';
                    this.selectedPublishers = '';
                    this.selectedAuthors = '';
                    this.selectedCatalogs = '';
                },
                editData( id ) {
                    // console.log(id);
                    this.dataBooks = this.books.find(x => x.id === id);
                    this.selectedPublishers = this.dataBooks.publisher_id;
                    this.selectedAuthors = this.dataBooks.author_id;
                    this.selectedCatalogs = this.dataBooks.catalog_id;
                    this.dataPublishers = this.publishers.find(x => x.id === this.selectedPublishers);
                    this.dataPenulis = this.authors.find(x => x.id === this.selectedAuthors);
                    this.dataKatalog = this.catalogs.find(x => x.id === this.selectedCatalogs);
                    this.titleBox = 'Edit Data';
                    this.tombol = 'Edit';
                    this.actionUrl = '{{ url('books') }}'+'/'+id+'/update';
                    this.statusEdit = true;
                    this.notstatusEdit = false;
                    this.eror = '';
                },
                detilData( id ) {
                    this.books;
                    this.dataBooks = this.books.find(x => x.id === id);
                    // console.log(this.dataBooks);
                    this.harga = this.dataBooks.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    this.selectedPublishers = this.dataBooks.publisher_id;
                    this.selectedAuthors = this.dataBooks.author_id;
                    this.selectedCatalogs = this.dataBooks.catalog_id;
                    this.dataPublishers = this.publishers.find(x => x.id === this.selectedPublishers);
                    this.dataPenulis = this.authors.find(x => x.id === this.selectedAuthors);
                    this.dataKatalog = this.catalogs.find(x => x.id === this.selectedCatalogs);
                    // console.log(this.dataPublishers);
                },
                submitForm(event, id){
                    // console.log(event);
                    const _this = this;
                    var actionUrl = !this.editStatus ? this.actionUrl : this.actionUrl+'/'+id+'/update';
                    event.preventDefault();
                    axios.post(actionUrl, new FormData($(event.target)[0]))
                    .then((response) => {
                        // kosongkan value input
                        $('#inputIsbnBook').val("");
                        $('#inputTitleBook').val("");
                        $('#inputTahunBook').val("");
                        $('#publisher_id').val("");
                        $('#inputAuthorBook').val("");
                        $('#inputCatalogBook').val("");
                        $('#inputQtyBook').val("");
                        $('#inputPriceBook').val("");
                        // // hilangkan modal
                        $('.modal').removeClass('in');
                        $('.modal').attr("aria-hidden","true");
                        $('.modal').css("display", "none");
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        // menambah notifikasi suksesfull (set session)
                        if (this.statusEdit) {
                        $("#notif").html("<div class='alert alert-success alert-dismissible fade show' role='alert'"+">"+
                                    "Anda berhasil mengedit data"+
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button"+">"+
                                "</div>");
                        } else {
                        $("#notif").html("<div class='alert alert-success alert-dismissible fade show' role='alert'"+">"+
                                    "Anda berhasil menambahkan data"+
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button"+">"+
                                "</div>");
                        }
                        // remove notif error
                        $("#eror").html('');
                        // reset action link
                        this.actionUrl = '{{ url('books') }}';

                        // console.log(this.statusEdit);
                        this.get_books()
                    }).catch(
                        function (error) {
                            let pesan = error.response.data.message;
                            this.eror = pesan;
                            // console.log(eror);
                            $("#eror").html(eror);
                        }
                    )
                },
                deletData( event, id ) {
                    // console.log(id);
                    event.preventDefault();
                    var actionUrl = this.actionUrl+'/delete/'+id;
                    if (confirm('are you sure?')) {
                        axios.post(actionUrl,{_method: 'delete'}).then(response => {
                        $("#notif").html("<div class='alert alert-success alert-dismissible fade show' role='alert'"+">"+
                            "Anda berhasil menghapus data"+
                            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button"+">"+
                            "</div>");
                        this.get_books()
                        }).catch(
                        function (error) {
                            let pesan = error.response.data;
                            this.eror = pesan.message;
                            $("#notif").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'"+">"+
                                    eror+
                                    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button"+">"+
                                    "</div>");
                        });
                    }
                },
            },
            computed: {
                filtered () {
                    return this.books.filter((book) => {
                        return book.title.toLowerCase().includes(this.search.toLowerCase());
                    });
                },
            },
        })
    </script>
@endsection