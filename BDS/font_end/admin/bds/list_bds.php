<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Danh sách</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Bất động sản</a></li>
                                <li class="breadcrumb-item active">Danh sách bất động sản</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="customerList">
                        <div class="card-header border-bottom-dashed">

                            <div class="row g-4 align-items-center">
                                <div class="col-sm">
                                    <div>
                                        <h5 class="card-title mb-0">Danh sách bất động sản</h5>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"><i class="ri-add-line align-bottom me-1"></i>
                                            <a style="color:#fff" href="index.php?act=addbds">Thêm mới</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-bottom-dashed border-bottom">
                            <form action="index.php?act=listbds" method="POST">
                                <div class="row g-3">
                                    <div class="col-xl-6">
                                        <div class="search-box">
                                            <input type="text" name="kyw" class="form-control search" placeholder="Nhập tên bất động sản cần tìm">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-xl-2">
                                        <div class="search-box">
                                            <select name="loaibds" id="" style="padding-left:18px" class="form-control search">
                                                <option value="0">Chọn loại</option>
                                                <?php foreach ($listloaibds as $index => $dm) : ?>
                                                    <option name="loaibds" value="<?= $dm['id'] ?>"><?= $dm['name'] ?></option>
                                                <?php endforeach ?>

                                            </select>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xl-4">
                                        <div class="row g-3">
                                            <div class="col-sm-4">
                                                <div class="">
                                                    <button type="submit" name="search" class="btn btn-success add-btn">Tìm kiếm</button>
                                                </div>
                                            </div>
                                            <!--end col-->

                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card mb-1">
                                    <table class="table align-middle" id="customerTable">
                                        <thead class="table-light text-muted">
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Ảnh</th>
                                                <th>Giá(VND)</th>
                                                <th>Địa chỉ</th>
                                                <th>Diện tích(m2)</th>
                                                <th>Số phòng</th>
                                                <th>Lượt xem</th>
                                                <th>Loại</th>
                                                <th>Người đăng</th>
                                                <th>Ngày đăng</th>
                                           
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <tr>
                                                <?php
                                                foreach ($listbds as $bds) {
                                                    extract($bds);
                                                    $upbds = "index.php?act=fixbds&id=" . $id;
                                                    $image = "../" . $bds['img'];
                                                    echo  '<tr>
                                                            <td>' . $id . '</td>
                                                            <td>' . $name . '</td>
                                                            <td><img src="' . $image . '" width="60" height="60"></td>
                                                            <td>' . $price . '</td>
                                                            <td>' . $location . '</td>
                                                            <td>' . $dientich . '</td>
                                                            <td>' . $sophong . '</td>
                                                            <td>' . $luotxem . '</td>
                                                            '; ?>
                                                    <?php
                                                    if (isset($bds['id_loaibds'])) {
                                                        $loaibds = loadOne_danhmuc($bds['id_loaibds']);
                                                        extract($loaibds);
                                                        echo '<td>' . $name . '</td>';
                                                    } ?>
                                                    <?php
                                                    if (isset($bds['id_user'])) {
                                                        $user = loadOne_user($bds['id_user']);
                                                        extract($user);
                                                        echo '<td>' . $user . '</td>';
                                                    } ?>
                                                <?php echo '
                                                            <td>' . $ngaydang . '</td>
                                                     
                                                            </tr>';
                                                }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ customer We did not find any customer for you search.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="#">
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <div class="mb-3" id="modal-id" style="display: none;">
                                                    <label for="id-field1" class="form-label">ID</label>
                                                    <input type="text" id="id-field1" class="form-control" placeholder="ID" readonly />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Customer Name</label>
                                                    <input type="text" id="customername-field" class="form-control" placeholder="Enter name" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email-field" class="form-label">Email</label>
                                                    <input type="email" id="email-field" class="form-control" placeholder="Enter email" required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="phone-field" class="form-label">Phone</label>
                                                    <input type="text" id="phone-field" class="form-control" placeholder="Enter phone no." required />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="date-field" class="form-label">Joining Date</label>
                                                    <input type="date" id="date-field" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" required placeholder="Select date" />
                                                </div>

                                                <div>
                                                    <label for="status-field" class="form-label">Status</label>
                                                    <select class="form-control" data-choices data-choices-search-false name="status-field" id="status-field">
                                                        <option value="">Status</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Block">Block</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success" id="add-btn">Add Customer</button>
                                                    <button type="button" class="btn btn-success" id="edit-btn">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" id="deleteRecord-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4>Are you sure ?</h4>
                                                    <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record ?</p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn w-sm btn-danger" id="delete-record">Yes, Delete It!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end modal -->
                        </div>
                    </div>

                </div>
                <!--end col-->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © HPV
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by HPV
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>