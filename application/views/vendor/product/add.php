<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Product Management - <?php echo isset($product) ? 'Edit' : 'Add'; ?></h1>
    </div>
    <?php echo $this->session->flashdata('message'); ?>
    <form id="productSave" action="<?php echo base_url('vendor/product/save'); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="product_id" id="vendor_id" value="<?php if(isset($product)){ echo $product['product_id']; } ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-12">
                    <!-- Card Header - Accordion -->
                    <a href="#personalDetails" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="personalDetails">
                        <h6 class="m-0 font-weight-bold text-primary">Product Personal Details</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="personalDetails">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter name" name="name" id="name" value="<?php if(set_value('name')){ echo set_value('name'); }elseif(isset($product['name'])){ echo $product['name']; } ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter sku" name="sku" id="sku" value="<?php if(isset($product['sku'])){ echo $product['sku']; } ?>" <?php if(isset($product['sku'])){ echo 'readonly'; } ?>>
                                <?php echo form_error('sku'); ?>
                            </div>
                            <?php $types = getProductTypes(); ?>
                            <div class="form-group">
                                <label>Select Type:</label>
                                <select class="form-control" name="type" id="type">
                                    <?php foreach($types AS $key => $value): ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($product)){ if($product['type'] == $key){ echo 'selected'; } } ?>><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter cost" name="cost" id="cost" value="<?php if(isset($product['cost'])){ echo $product['cost']; } ?>">
                                <?php echo form_error('cost'); ?>
                            </div>
                            <?php $status = getNormalStatus(); ?>
                            <div class="form-group">
                                <label>Select Status:</label>
                                <select class="form-control" name="status" id="status">
                                    <?php foreach($status AS $key => $value): ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($product)){ if($product['status'] == $key){ echo 'selected'; } } ?>><?php echo $value; ?></option>
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