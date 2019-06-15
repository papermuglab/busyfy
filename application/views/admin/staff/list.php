<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Staff List</h1>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Staff</h6>
        </div>

        <div class="card-body">


            <div class="table-responsive">
                <form>
                    <input type="hidden" name="url" id="url" value="<?php echo base_url('admin/staff/index/'); ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" name="vendor_id" id="vendor_id" >
                                <option value="all">All</option>
                                <?php foreach ($vendorList AS $vendor): ?>
                                    <option value="<?php echo $vendor['key']; ?>" <?php if($selectedVendor != 'all' && $selectedVendor != ''){ if($vendor['key'] == $selectedVendor){ echo 'selected'; } } ?>><?php echo $vendor['value']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" type="text" name="key_word" id="key_word" placeholder="Name/Email/Mobile" value="<?php if(!empty($keyWord)){ echo $keyWord; } ?>">
                        </div>
                        <div class="col-md-2">
                            <?php $statusTypes = getNormalStatus(); ?>
                            <select class="form-control" name="status" id="status" >
                                <option value="all">All</option>
                                <?php foreach ($statusTypes AS $key => $value): ?>
                                    <option value="<?php echo $key; ?>" <?php if($status != 'all' && $status != ''){ if($key == $status){ echo 'selected'; } } ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" name="second_filter_button" id="second_filter_button" class="btn btn-primary">Filter</button>
                            <a class="btn btn-secondary" href="<?php echo base_url('admin/staff/index/'); ?>">Reset</a>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Owner Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Current Assigned Task</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Owner Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Current Assigned Task</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($staffs AS $staff): ?>
                            <tr id="row_<?php echo $staff['staff_id']; ?>">
                                <td><?php echo $staff['name']; ?></td>
                                <td><?php echo $staff['email']; ?></td>
                                <td><?php echo $staff['mobile']; ?></td>
                                <td><?php echo $staff['total_task']; ?></td>
                                <td><?php echo getNormalStatusName($staff['status']); ?></td>
                                <td>
                                    <a href="<?php echo base_url('admin/staff/edit/' . encrypt($staff['staff_id'])); ?>" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" onclick="deleteRecord('staff', <?php echo $staff['staff_id']; ?>)" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(empty($staffs)): ?>
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