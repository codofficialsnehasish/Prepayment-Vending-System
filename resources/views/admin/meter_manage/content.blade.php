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
                                            <a href="javascript:void(0);" onclick="get_meter_data();" class="btn btn-primary  dropdown-toggle" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" aria-expanded="false">
                                                <i class="fas fa-plus me-2"></i> New
                                            </a>
                                            <a href="javascript:void(0);" data="" id="editid" onclick="get_meter_data(this.value);" class="btn btn-primary  dropdown-toggle" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" aria-expanded="false">
                                                <i class="fas fa-plus me-2"></i> Edit
                                            </a>
                                            <div class="condel btn btn-danger text-center"><input type="text" onclick="confirmDelete(this.value);" value=""  id="delid"></div>
                                            <!-- <label for="delid" class="btn btn-primary"><i class="fas fa-plus me-2"></i> Delete</label> -->
                                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bs-example-modal-form" aria-expanded="false">
                                                <i class="fas fa-plus me-2"></i> Import Excel
                                            </a>
                                            <a href="{{ asset('download-file/MeterInfo Template.xls') }}" class="btn btn-info">
                                                <i class="mdi mdi-cloud-download"></i> Download Template
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                                <strong>{{ $message }}</strong>
                        </div>
                        @endif

                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form class="custom-validation" style="width:100%;" action="{{url('/meter')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="idedit" value="" id="idedit">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">New</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label" for="meter_no">Meter No.</label>
                                                    <input type="text" class="form-control" name="meter_no" value="" id="meter_no" placeholder="Enter name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <!-- <label class="form-label" for="meter_type">Meter Type</label>
                                                    <input type="text" class="form-control" name="meter_type" value="" id="meter_type" placeholder="Enter address" required> -->
                                                    <label class="form-label">Meter Type</label>
                                                    <select class="form-control" name="meter_type" id="meter_type" required>
                                                        <option>Select</option>
                                                        @foreach($meter_master as $m)
                                                        <option value="{{$m->id}}">{{$m->meter_type_name}}</option>
                                                        @endforeach
                                                    </select>
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
                                    <form class="custom-validation" style="width:100%;" action="{{url('import-meter')}}" method="post" enctype="multipart/form-data">
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
                                                    <th>Meter No</th>
                                                    <th>Meter Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($alldata as $c)
                                                <tr onclick="getrow_data(this.id)" style="background-color:;" id="{{$c->id}}">
                                                    <td>{{$c->meter_no}}</td>
                                                    <td>{{$c->meter_type_name}}</td>
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
                        document.getElementById(id).style.backgroundColor = 'yellow';
                    }
                    function get_meter_data(id){
                        console.log(id);
                        $.ajax({
                            url:'/meter-data/'+id,
                            type:'GET',
                            data:{},
                            success:function(resp){
                                $("#meter_no").val(resp.meter_no);
                                const $select = document.querySelector('#meter_type');
                                $select.value = resp.meter_type;
                                $("#idedit").val(resp.id);
                                $("#delid").val(resp.id);
                            }
                        });
                    }
                    function clear_meter_data(id){
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