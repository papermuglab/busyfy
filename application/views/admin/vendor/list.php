<!-- Begin Page Content -->
<div class="container-fluid">
<?php $method = $this->session->userdata('admin_role') == '1' ? 'correct' : 'edit'; ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Vendor List</h1>
    <span class="message"></span>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Vendors</h6>
        </div>

        <div class="card-body">


            <div class="table-responsive">
                <form>
                    <input type="hidden" name="url" id="url" value="<?php echo base_url('admin/vendor/index/'); ?>">
                    <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>">
                    <div class="row">
                        <div class="col-md-5">
                            <input class="form-control" type="text" name="key_word" id="key_word" placeholder="Name/Email/Mobile" value="<?php if(!empty($keyWord)){ echo $keyWord; } ?>">
                        </div>
                        <div class="col-md-5">
                            <?php $statusTypes = getAccountStatus(); ?>
                            <select class="form-control" name="status" id="status" >
                                <option value="all">All</option>
                                <?php foreach ($statusTypes AS $key => $value): ?>
                                    <option value="<?php echo $key; ?>" <?php if($status != 'all' && $status != ''){ if($key == $status){ echo 'selected'; } } ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" name="filter_button" id="filter_button" class="btn btn-primary">Filter</button>
                            <a class="btn btn-secondary" href="<?php echo base_url('admin/vendor/index/'); ?>">Reset</a>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Owner Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Owner Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($vendors AS $vendor): ?>
                            <tr id="row_<?php echo $vendor['vendor_id']; ?>">
                                <td><?php echo $vendor['owner_name']; ?></td>
                                <td><?php echo $vendor['email']; ?></td>
                                <td><?php echo $vendor['mobile']; ?></td>
                                <td><?php echo getAccountStatusName($vendor['status']); ?></td>
                                <td>
                                    <a href="<?php echo base_url('admin/vendor/'.$method.'/' . encrypt($vendor['vendor_id'])); ?>" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" onclick="deleteRecord('vendor', <?php echo $vendor['vendor_id']; ?>)" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(empty($vendors)): ?>
                            <tr>
                                <td colspan="5">No result found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="text-center pull-right">
                    <ul class="pagination">
                        <?php echo $this->pagination->create_links(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->