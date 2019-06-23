<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Staff Management - <?php echo isset($lead) ? 'Edit' : 'Add'; ?></h1>
    </div>
    <?php echo $this->session->flashdata('message'); ?>
    <form id="leadSave" action="<?php echo base_url('admin/lead/save'); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="lead_id" id="lead_id" value="<?php if(isset($lead)){ echo $lead['lead_id']; }else{ echo 0; } ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#leadDetails" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="leadDetails">
                        <h6 class="m-0 font-weight-bold text-primary">Lead Details</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="leadDetails">
                        <div class="card-body">
                            <?php if(!isset($lead)): ?>
                            <div class="form-group">
                                <label>Select Vendor:</label>
                                <select class="form-control" name="vendor_id" id="task_vendor_id" required="required">
                                    <option value="">Select Vendor</option>
                                    <?php foreach($vendorList AS $vendor): ?>
                                    <option value="<?php echo $vendor['key']; ?>" <?php if(set_value('vendor_id')){ if(set_value('vendor_id') == $vendor['key']){ echo 'selected'; } } ?>><?php echo $vendor['value']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('vendor_id'); ?>
                            </div>
                            <?php else: ?>
                            <input type="hidden" name="vendor_id" id="vendor_id" value="<?php if(isset($lead)){ echo $lead['vendor_id']; } ?>">
                            <?php endif; ?>
                            <?php if(!isset($lead)): ?>
                            <div class="form-group">
                                <label>Select Product:</label>
                                <select class="form-control" name="product_id" id="product_id" required="required">
                                    <?php if(isset($products)): foreach($products AS $row): ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if(set_value('product_id')){ if(set_value('product_id') == $row['id']){ echo 'selected'; } } ?> <?php if(isset($staff)){ if($staff['product_id'] == $row['id']){ echo 'selected'; } } ?>><?php echo $row['name']; ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <?php echo form_error('product_id'); ?>
                            </div>
                            <?php else: ?>
                            <div class="form-group">
                                <label>Product:</label>
                                <input type="text" class="form-control" name="product_id" id="product_id" value="<?php echo $lead['name']; ?>" readonly>
                                <?php echo form_error('product_id'); ?>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter quantity" name="quantity" id="quantity" value="<?php if(set_value('quantity')){ echo set_value('quantity'); }elseif(isset($lead['quantity'])){ echo $lead['quantity']; } ?>">
                                <?php echo form_error('quantity'); ?>
                            </div>
                            <div class="form-group">
                                <label>Select Staff member:</label>
                                <select class="form-control" name="assigned_to" id="staff_id" required="required">
                                    <?php if(isset($staffs)): foreach($staffs AS $row): ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if(set_value('assigned_to')){ if(set_value('assigned_to') == $row['id']){ echo 'selected'; } } ?> <?php if(isset($staff)){ if($staff['assigned_to'] == $row['id']){ echo 'selected'; } } ?>><?php echo $row['name']; ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <?php echo form_error('assigned_to'); ?>
                            </div>
                            <?php $status = getLeadStatus(); ?>
                            <div class="form-group">
                                <label>Select Status:</label>
                                <select class="form-control" name="status" id="status">
                                    <?php foreach($status AS $key => $value): ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($lead)){ if($lead['status'] == $key){ echo 'selected'; } } ?>><?php echo $value; ?></option>
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
                                <input type="text" class="form-control" placeholder="Enter name" name="name" id="name" value="<?php if(set_value('name')){ echo set_value('name'); }elseif(isset($lead['patron_name'])){ echo $lead['patron_name']; } ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter email" name="email" id="email" value="<?php if(set_value('email')){ echo set_value('email'); }elseif(isset($lead['patron_email'])){ echo $lead['patron_email']; } ?>">
                                <?php echo form_error('email'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter mobile" name="mobile" id="mobile" value="<?php if(set_value('mobile')){ echo set_value('mobile'); }elseif(isset($lead['patron_mobile'])){ echo $lead['patron_mobile']; } ?>">
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