<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Shopping Mall Direcctory</title>

    <!-- Load Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container-narrow">
        <h2>Shopping Mall Direcctory</h2>
         <br> <br>
        <div style="margin-left:30px;">
            <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Add New Shop</button>
    
            <button id="btn-upload" name="btn-upload" class="btn btn-primary btn-xs">Upload Shops</button>
            <a href="http://localhost/mall-app/public/download" id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Download Shop</a>
        </div>
        <br>
           <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Floor</th>
                        <th>Lot No</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="shop-list" name="shops-list">
                    @foreach ($shops as $shop)
                    <tr id="shop{{$shop->id}}">
                        <td>{{$shop->id}}</td>
                        <td>{{$shop->name}}</td>
                        <td>{{$shop->floor}}</td>
                        <td>{{$shop->lot_no}}</td>
                        <td>{{$shop->created_at}}</td>
                        <td width=50%>
                            <button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$shop->id}}">Edit</button>&nbsp&nbsp
                            <button class="btn btn-danger btn-xs btn-delete delete-shop" value="{{$shop->id}}">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal (Pop up when add/edit button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add/Edit Shop</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmShops" name="frmShops" class="form-horizontal" novalidate="">

                                <div class="form-group error">
                                    <label for="inputShop" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="Shop" value="">
                                    </div>
                                </div>

                                <div class="form-group error">
                                    <label for="inputFloor" class="col-sm-3 control-label">Floor</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="floor" name="floor" placeholder="Floor" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputLotNo" class="col-sm-3 control-label">Lot No</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="lot_no" name="lot_no" placeholder="Lot No" value="">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Add</button>
                            <input type="hidden" id="shop_id" name="shop_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
                  <!-- Modal (Pop up when add/edit button clicked) -->
            <div class="modal fade" id="myModalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Upload Shops</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="http://localhost/mall-app/public/upload"enctype="multipart/form-data" id="UploadShops" name="frmShops" class="form-horizontal" novalidate="">

                                <div class="form-group">
                                    <label for="UploadShops" class="col-sm-3 control-label">Upload Shop</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="file" name="file">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-uploadfrm" value="upload">Upload</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/shopAjax.js')}}"></script>
</body>
</html>