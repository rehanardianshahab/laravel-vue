@extends('master.master')

@section('header', 'ADD TRANSACTIONS')

@section('css')

@endsection

@section('content')
<a href="/transactions" class="btn btn-sm btn-primary mt-3">Back to Transactions</a>
<div id="controller">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Product Transactions Form</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="{{ url('transactions') }}" method="POST" @submit="submitForm($event)" class="form-label-left input_mask">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Name </label>
                            <div class="col-md-9 col-sm-9 ">
                                <select name="member_id" class="form-control @error('member_id') is-invalid @enderror" id="member_id" required readonly>
                                    <option value="{{ $members->id }}">{{ $members->name }}</option>
                                </select>
                                @error('member_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Purchase Date
                            </label>
                            <div class="col-md-9 col-sm-9 ">
                                <input name="purchase_date" class="date-picker form-control @error('purchase_date') is-invalid @enderror" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" type="date" readonly required="required" >
                                @error('purchase_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Repayment Date
                            </label>
                            <div class="col-md-9 col-sm-9 ">
                                <input name="repayment_date" class="date-picker form-control @error('repayment_date') is-invalid @enderror" value="{{ Carbon\Carbon::now()->addDay(3)->format('Y-m-d') }}" type="date" readonly required="required">
                                @error('repayment_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
            
                        <div class="form-group row" v-for="(list, index) in dataProduct" :key="index">
                            <div class="col-md-6 form-group">
                                <label for="product">Product Name</label>
                                <select class="form-control @error('gundam_product_id') is-invalid @enderror" v-on:change="handleProduct(index)" v-model="list.product" name="gundam_product_id[]" id="product">
                                    <option value="0">-- Select Product --</option>
                                    <option v-on:click="selectProduct(index, indexProduct)" v-for="createData, indexProduct in createDatas" v-bind:value="createData.id" v-bind:key="createData.id">@{{ createData.product_name }}</option>
                                </select>
                                @error('gundam_product_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="price">Price</label>
                                <input class="form-control" v-model="list.price" type="number" id="price" readonly v-on:change="countPrice(index)">
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="quantity">Quantity</label>
                                <input name="purchase_qty[]" v-model="list.quantity" class="form-control @error('purchase_qty') is-invalid @enderror" type="number" id="quantity" v-on:keyup="countTotal()">
                                @error('purchase_qty')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="col-md-auto">
                                <a href="#" class="btn btn-sm btn-info" v-on:click.prevent="addProduct()" style="border: none">Add Product <i class="fa fa-plus-square" style="font-size: 1rem"></i></a>
                            </div> --}}
                        </div>

                        {{-- <div 
                            class="form-group row"
                            is = "input-products"
                            v-for="(inputProduct, index) in inputProducts"
                            v-bind:key="inputProduct.id"
                            v-on:remove="inputProducts.splice(index, 1)">
                        </div> --}}

                        <div class="row">
                            <div class="col-md-auto">
                                <button type="button" class="btn btn-sm btn-info" v-on:click="addProduct()" style="border: none">Add Product <i class="fa fa-plus-square" style="font-size: 1rem"></i></button>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Total Price</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input name="total_price" type="number" class="form-control @error('total_price') is-invalid @enderror" v-model="totalPrice" readonly >
                                @error('total_price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-9 col-sm-9  offset-md-3">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
            
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- Data --}}
<script type="text/javascript">
    var actionUrl = '{{ url('transactions') }}';
    var apiUrl = '{{ url('api/createtrans') }}';
    
    var component = Vue.component('input-products', {
        template: `
        <div class="form-group row">
            <div class="col-md-6 form-group">
                <label for="product">Product Name</label>
                <select class="form-control @error('gundam_product_id') is-invalid @enderror" v-on:change="handleProduct()" v-model="product" name="gundam_product_id" id="product">
                    <option value="0">-- Select Product --</option>
                    <option v-for="createData in createDatas" v-bind:value="createData.id" v-bind:key="createData.id">@{{ createData.product_name }}</option>
                </select>
                @error('gundam_product_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <label for="price">Price</label>
                <input class="form-control" v-model="price" :value="price" type="number" id="price" readonly>
            </div>

            <div class="col-md-2 form-group">
                <label for="quantity">Quantity</label>
                <input name="purchase_qty" v-model="quantity" class="form-control @error('purchase_qty') is-invalid @enderror" type="number" id="quantity">
                @error('purchase_qty')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
            `,
    })

    var controller = new Vue({
        el: "#controller",
        data: {
            actionUrl,
            apiUrl,
            editStatus: false,
            createDatas: [],
            dataPrices: [],
            price: '',
            quantity: '',
            product: 0,
            dataProduct: [
                {
                    product: '',
                    price: 0,
                    quantity: 1
                }
            ],
            totalPrice: 0
        },
        mounted: function () {
            this.getCreate();
            this.getPrice();
            this.countTotal
        },
        methods: {
            getCreate() {
                console.log('getCreate');
                axios.get('/api/createtrans')
                    .then((response) => {
                        console.log(response.data);
                        this.createDatas = response.data;
                    })
                    .catch(response => {
                        console.log('error');
                    })
            },
            getPrice() {
                console.log('getPrice');
                axios.get('/api/prices')
                    .then((response) => {
                        console.log(response.data);
                        this.dataPrices = response.data;
                    })
                    .catch(response => {
                        console.log('error');
                    })
            },
            handleProduct(index) {
                console.log(this.dataProduct[index].product);
                for (let dataPrice of this.dataPrices) {
                    if(this.dataProduct[index].product == 0) {
                        this.dataProduct[index].price = 0;
                    } else if(this.dataProduct[index].product == dataPrice['id']) {
                        this.dataProduct[index].price = dataPrice['price'];
                    }
                }
                this.countTotal()
            },
            addProduct() {
                this.dataProduct.push({
                    product: '',
                    price: 0,
                    quantity: 1
                })
            },
            selectProduct(index, indexProduct) {
                for (let dataPrice of this.dataPrices) {
                    if(this.createDatas[indexProduct].id == 0) {
                        this.dataProduct[index].price = 0;
                    } else if(this.createDatas[indexProduct].id == dataPrice['id']) {
                        this.dataProduct[index].price = dataPrice['price'];
                    }
                }
            },
            countPrice(index) {
                this.dataProduct[index].price = this.dataProduct[index].price * this.dataProduct[index].quantity
                console.log('data count', this.dataProduct[index].price)
            },
            countTotal() {
                let total = 0
                this.dataProduct.map((result) => total += result.price*result.quantity)
                this.totalPrice = total
                console.log('data total',this.totalPrice)
            },
            submitForm(event) {
                axios
                    .post(actionUrl, new FormData($(event.target)[0]))
                    .then((response) => {
                        alert("Data submitted successfully!")
                    });
            },
        },
    });
</script>
@endsection