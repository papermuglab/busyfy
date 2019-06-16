<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Staff Management - <?php echo isset($staff) ? 'Edit' : 'Add'; ?></h1>
    </div>
    <?php echo $this->session->flashdata('message'); ?>
    <form id="staffSave" action="<?php echo base_url('admin/staff/save'); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="staff_id" id="vendor_id" value="<?php if(isset($staff)){ echo $staff['staff_id']; } ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-12">
                    <!-- Card Header - Accordion -->
                    <a href="#personalDetails" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="personalDetails">
                        <h6 class="m-0 font-weight-bold text-primary">Staff Personal Details</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="personalDetails">
                        <div class="card-body">
                            <?php if(!isset($staff)): ?>
                            <div class="form-group">
                                <label>Select Vendor:</label>
                                <select class="form-control" name="vendor_id" id="vendor_id" required="required">
                                    <?php foreach($vendorList AS $vendor): ?>
                                    <option value="<?php echo $vendor['key']; ?>"><?php echo $vendor['value']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('vendor_id'); ?>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter name" name="name" id="name" value="<?php if(set_value('name')){ echo set_value('name'); }elseif(isset($staff['name'])){ echo $staff['name']; } ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter email" name="email" id="email" value="<?php if(set_value('email')){ echo set_value('email'); }elseif(isset($staff['email'])){ echo $staff['email']; } ?>" <?php if(isset($staff['email'])){ echo 'readonly'; } ?>>
                                <?php echo form_error('email'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter mobile" name="mobile" id="mobile" value="<?php if(set_value('mobile')){ echo set_value('mobile'); }elseif(isset($staff['mobile'])){ echo $staff['mobile']; } ?>" <?php if(isset($staff['mobile'])){ echo 'readonly'; } ?>>
                                <?php echo form_error('mobile'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter address" name="address" id="mobile" value="<?php if(set_value('address')){ echo set_value('address'); }elseif(isset($staff['address'])){ echo $staff['address']; } ?>">
                                <?php echo form_error('address'); ?>
                            </div>
                            <?php $status = getNormalStatus(); ?>
                            <div class="form-group">
                                <label>Select Status:</label>
                                <select class="form-control" name="status" id="status">
                                    <?php foreach($status AS $key => $value): ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($staff)){ if($staff['status'] == $key){ echo 'selected'; } } ?>><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
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