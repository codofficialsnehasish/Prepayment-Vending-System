<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->
<style>
    .condel {
        position: relative;
    }

    .condel:after {
        /* content: "Delete";
        position: absolute;
        left: 5px;
        top: 4px; */
        content: "Remove";
        position: absolute;
        left: 0px;
        top: 4px;
        width: 100%;
        line-height: 28px;
    }

    input#delid {
        position: relative;
        z-index: 99;
        border: none;
        width: 90px!important;
        background: transparent;
        text-indent: -99999999px;
        outline:0;
    }
</style>
            <!-- ========== Left Sidebar Start ========== -->
            @include("admin/dash/left_side_bar")
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h6 class="page-title">{{$title}}</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All {{$title}}</li>
                                    </ol>
                                </div>
                                <div class="col-md-8">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" onclick="get_customer_data();" class="btn btn-primary  dropdown-toggle" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" aria-expanded="false">
                                                <i class="fas fa-plus me-2"></i> New
                                            </a>
                                            <a href="javascript:void(0);" data="" id="editid" onclick="get_customer_data(this.value);" class="btn btn-primary  dropdown-toggle" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" aria-expanded="false">
                                                <i class="fas fa-plus me-2"></i> Edit
                                            </a>
                                            <div class="condel btn btn-danger text-center"><input type="text" onclick="confirmDelete(this.value);" value=""  id="delid"></div>
                                            <!-- <label for="delid" class="btn btn-primary"><i class="fas fa-plus me-2"></i> Delete</label> -->
                                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bs-example-modal-form" aria-expanded="false">
                                                <i class="fas fa-plus me-2"></i> Import Excel
                                            </a>
                                            <a href="{{ asset('download-file/Customer Info Template.xls') }}" class="btn btn-info">
                                                <i class="mdi mdi-cloud-download"></i> Download Template
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        @if(Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                                <strong>{{ Session::put($message) }}</strong>
                        </div>
                        @endif

                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form class="custom-validation" style="width:100%;" action="{{url('/customer')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="idedit" value="" id="idedit">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">New</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label" for="name">Name</label>
                                                    <input type="text" class="form-control" name="name" value="" id="name" placeholder="Enter name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="address">Address</label>
                                                    <input type="text" class="form-control" name="address" value="" id="address" placeholder="Enter address" required>
                                                </div>
                                                <div class="mb-3 mt-3">
                                                    <label class="form-label" for="phone">Phone No.</label>
                                                    <div>
                                                        <input data-parsley-type="number" type="text" name="phone" value="" id="phone" class="form-control" required placeholder="Enter phone number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success"><i class="mdi mdi-check-bold"></i> Save</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        </div>

                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="modal fade bs-example-modal-form" tabindex="-1" role="dialog"
                                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form class="custom-validation" style="width:100%;" action="{{url('/import-customer')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="idedit" value="" id="idedit">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">New</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <!-- <label class="form-label">Default file input</label> -->
                                                    <input type="file" name="select_file" class="filestyle" data-buttonname="btn-secondary">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success"><i class="mdi mdi-check-bold"></i> Import</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        </div>
                        
                        <!-- show data -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sl. No</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Mobile</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach($alldata as $c)
                                                <tr onclick="getrow_data(this.id)" style="background-color:;" id="{{$c->id}}">
                                                    <td>@php echo $i++ @endphp</td>
                                                    <td>{{$c->name}}</td>
                                                    <td>{{$c->address}}</td>
                                                    <td>{{$c->phone}}</td>
                                                </tr>
                                               
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end show data -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <script>
                    function getrow_data(id){
                        $("#editid").val(id);
                        $("#delid").val(id);
                        // $("#idedit").val(id);
                        // $("#"+id).style.backgroundColor = "yellow";
                        document.getElementById(id).style.backgroundColor = 'yellow';
                    }
                    function get_customer_data(id){
                        console.log(id);
                        $.ajax({
                            url:'/customar-data/'+id,
                            type:'GET',
                            data:{},
                            success:function(resp){
                                // alert(resp.name);
                                // console.log(resp);
                                $("#name").val(resp.name);
                                $("#address").val(resp.address);
                                $("#phone").val(resp.phone);
                                $("#idedit").val(resp.id);
                                $("#delid").val(resp.id);
                            }
                        });
                    }
                    function clear_customer_data(id){
                        $("#name").val('');
                        $("#address").val('');
                        $("#phone").val('');
                        $("#idedit").val('');
                    }
                    // function label(){
                    //     let a = $("#delid").val;
                    //     alert(a);
                    // }
                </script>
                
                @include("admin/dash/footer")