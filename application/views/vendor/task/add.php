<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Staff Management - <?php echo isset($task) ? 'Edit' : 'Add'; ?></h1>
    </div>
    <?php echo $this->session->flashdata('message'); ?>
    <form id="taskSave" action="<?php echo base_url('vendor/task/save'); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="task_id" id="task_id" value="<?php if(isset($task)){ echo $task['task_id']; }else{ echo 0; } ?>">
        <input type="hidden" name="patron_id" id="patron_id" value="<?php if(isset($task)){ echo $task['patron_id']; }else{ echo 0; } ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#taskDetails" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="taskDetails">
                        <h6 class="m-0 font-weight-bold text-primary">Task Details</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="taskDetails">
                        <div class="card-body">
                            <input type="hidden" name="vendor_id" id="task_vendor_id" value="<?php echo $this->session->userdata('vendor_id'); ?>">
                            <?php if(!isset($task)): ?>
                            <div class="form-group">
                                <label>Select Product:</label>
                                <select class="form-control" name="product_id" id="product_id" required="required">
                                    <option value="">Select Product</option>
                                    <?php foreach($products AS $row): ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if(set_value('product_id')){ if(set_value('product_id') == $row['id']){ echo 'selected'; } } ?> <?php if(isset($staff)){ if($staff['product_id'] == $row['id']){ echo 'selected'; } } ?>><?php echo $row['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('product_id'); ?>
                            </div>
                            <?php else: ?>
                            <div class="form-group">
                                <label>Product:</label>
                                <input type="text" class="form-control" name="product_id" id="product_id" value="<?php echo $task['name']; ?>" readonly>
                                <?php echo form_error('product_id'); ?>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label>Single Cost</label>
                                <input type="text" class="form-control" placeholder="Enter Single cost" name="single_cost" id="single_cost" value="<?php if(set_value('single_cost')){ echo set_value('single_cost'); }elseif(isset($task['single_cost'])){ echo $task['single_cost']; } ?>" readonly>
                                <?php echo form_error('single_cost'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter quantity" name="quantity" id="quantity" value="<?php if(set_value('quantity')){ echo set_value('quantity'); }elseif(isset($task['quantity'])){ echo $task['quantity']; } ?>">
                                <?php echo form_error('quantity'); ?>
                            </div>
                            <div class="form-group">
                                <label>Total Cost</label>
                                <input type="text" class="form-control" placeholder="Enter Single cost" name="total_cost" id="total_cost" value="<?php if(set_value('total_cost')){ echo set_value('total_cost'); }elseif(isset($task['total_cost'])){ echo $task['total_cost']; } ?>" readonly>
                                <?php echo form_error('total_cost'); ?>
                            </div>
                            <div class="form-group">
                                <label>Select Staff member:</label>
                                <select class="form-control" name="assigned_to" id="staff_id" required="required">
                                    <?php foreach($staffs AS $row): ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if(set_value('assigned_to')){ if(set_value('assigned_to') == $row['id']){ echo 'selected'; } } ?> <?php if(isset($staff)){ if($staff['assigned_to'] == $row['id']){ echo 'selected'; } } ?>><?php echo $row['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('assigned_to'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter pickup location" name="pickup_location" id="pickup_location" value="<?php if(set_value('pickup_location')){ echo set_value('pickup_location'); }elseif(isset($task['pickup_location'])){ echo $task['pickup_location']; } ?>">
                                <?php echo form_error('pickup_location'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Select pickup datatime" name="pickup_datetime" id="datetimepicker" value="<?php if(set_value('pickup_datetime')){ echo set_value('pickup_datetime'); }elseif(isset($task['pickup_datetime'])){ echo $task['pickup_datetime']; } ?>">
                                <?php echo form_error('pickup_datetime'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter drop location" name="drop_location" id="drop_location" value="<?php if(set_value('drop_location')){ echo set_value('drop_location'); }elseif(isset($task['drop_location'])){ echo $task['drop_location']; } ?>">
                                <?php echo form_error('drop_location'); ?>
                            </div>
                            <div class="form-group">
                                <label>Paid:</label>
                                <select class="form-control" name="is_paid" id="is_paid">
                                    <option value="0" <?php if(isset($task)){ if($task['is_paid'] == 0){ echo 'selected'; } } ?>>No</option>
                                    <option value="1" <?php if(isset($task)){ if($task['is_paid'] == 1){ echo 'selected'; } } ?>>Yes</option>
                                </select>
                                <?php echo form_error('is_paid'); ?>
                            </div>
                            <?php $paymentModes = getPaymentModes(); ?>
                            <div class="form-group">
                                <label>Select payment mode:</label>
                                <select class="form-control" name="payment_mode" id="payment_mode">
                                    <option value="">Select payment mode if is paid.</option>
                                    <?php foreach($paymentModes AS $key => $value): ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($task)){ if($task['payment_mode'] == $key){ echo 'selected'; } } ?>><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('payment_mode'); ?>
                            </div>
                            <?php $status = getTaskStatus(); ?>
                            <div class="form-group">
                                <label>Select Status:</label>
                                <select class="form-control" name="status" id="status">
                                    <?php foreach($status AS $key => $value): ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($task)){ if($task['status'] == $key){ echo 'selected'; } } ?>><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#personalDetails" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="personalDetails">
                        <h6 class="m-0 font-weight-bold text-primary">Patron Details</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="personalDetails">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter name" name="name" id="name" value="<?php if(set_value('name')){ echo set_value('name'); }elseif(isset($patron['name'])){ echo $patron['name']; } ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter email" name="email" id="email" value="<?php if(set_value('email')){ echo set_value('email'); }elseif(isset($patron['email'])){ echo $patron['email']; } ?>">
                                <?php echo form_error('email'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter mobile" name="mobile" id="mobile" value="<?php if(set_value('mobile')){ echo set_value('mobile'); }elseif(isset($patron['mobile'])){ echo $patron['mobile']; } ?>">
                                <?php echo form_error('mobile'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <a href="#" class="btn btn-primary btn-icon-split" onclick="history.back();">
                            <span class="text">Cancel</span>
                        </a>
                        <button class="btn btn-success btn-icon-split" type="submit">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Save</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->