<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Task List</h1>
    <span class="message"></span>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Task</h6>
        </div>

        <div class="card-body">


            <div class="table-responsive">
                <form>
                    <input type="hidden" name="url" id="url" value="<?php echo base_url('admin/task/index/'); ?>">
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
                            <input class="form-control" type="text" name="key_word" id="key_word" placeholder="Product Name/Staff Name/Email" value="<?php if(!empty($keyWord)){ echo $keyWord; } ?>">
                        </div>
                        <div class="col-md-2">
                            <?php $statusTypes = getTaskStatus(); ?>
                            <select class="form-control" name="status" id="status" >
                                <option value="all">All</option>
                                <?php foreach ($statusTypes AS $key => $value): ?>
                                    <option value="<?php echo $key; ?>" <?php if($status != 'all' && $status != ''){ if($key == $status){ echo 'selected'; } } ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" name="second_filter_button" id="second_filter_button" class="btn btn-primary">Filter</button>
                            <a class="btn btn-secondary" href="<?php echo base_url('admin/task/index/'); ?>">Reset</a>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Pickup Location</th>
                            <th>Pickup DateTime</th>
                            <th>Drop Location</th>
                            <th>Assign To</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Product Name</th>
                            <th>Pickup Location</th>
                            <th>Pickup DateTime</th>
                            <th>Drop Location</th>
                            <th>Assign To</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($tasks AS $task): ?>
                            <tr id="row_<?php echo $task['task_id']; ?>">
                                <td><?php echo $task['name']; ?></td>
                                <td><?php echo $task['pickup_location']; ?></td>
                                <td><?php echo $task['pickup_datetime']; ?></td>
                                <td><?php echo $task['drop_location']; ?></td>
                                <td><?php echo $task['staff_name']; ?></td>
                                <td><?php echo getTaskStatusName($task['status']); ?></td>
                                <td>
                                    <a title="Edit" href="<?php echo base_url('admin/task/edit/' . encrypt($task['task_id'])); ?>" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                                    <a title="Track Task" href="<?php echo base_url('admin/task/track/' . encrypt($task['task_id'])); ?>" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" onclick="deleteRecord('task', <?php echo $task['task_id']; ?>)" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                    <a title="Download Invoice" href="#" class="">Download Invoice</a> | 
                                    <a title="Send Invoice" href="#" class="">Send Invoice</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(empty($tasks)): ?>
                            <tr>
                                <td colspan="7">No result found.</td>
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