<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet">
<div class="row-fluid">
    <div class="span12" id="content">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Multi Upload - File Management</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <?php if($this->session->flashdata('success')){ ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>
                    <?php if($this->session->flashdata('error')){ ?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>

                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Upload File</legend>
                            <div class="control-group">
                                <label class="control-label" for="wing">Wing <span class="required" style="color:red;">*</span></label>
                                <div class="controls">
                                    <select name="wing" id="wing" required>
                                        <option value="">-- Select Wing --</option>
                                        <option value="AGAE" <?php echo (isset($row['wing']) && $row['wing'] == 'AGAE') ? 'selected' : ''; ?>>AG (A&E)</option>
                                        <option value="Accounts" <?php echo (isset($row['wing']) && $row['wing'] == 'Accounts') ? 'selected' : ''; ?>>Accounts</option>
                                        <option value="Pension" <?php echo (isset($row['wing']) && $row['wing'] == 'Pension') ? 'selected' : ''; ?>>Pension</option>
                                        <option value="GPF" <?php echo (isset($row['wing']) && $row['wing'] == 'GPF') ? 'selected' : ''; ?>>GPF</option>
                                        <option value="Administration" <?php echo (isset($row['wing']) && $row['wing'] == 'Administration') ? 'selected' : ''; ?>>Administration</option>
                                        <option value="Record" <?php echo (isset($row['wing']) && $row['wing'] == 'Record') ? 'selected' : ''; ?>>Record</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="upload_dt">Upload Date <span class="required" style="color:red;">*</span></label>
                                <div class="controls">
                                    <input type="text" name="upload_dt" id="upload_dt" class="datepicker" data-provide="datepicker" value="<?php echo isset($row['upload_dt']) ? date('d-m-Y', strtotime($row['upload_dt'])) : date('d-m-Y'); ?>" required autocomplete="off" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="file_name">Choose File <span class="required" style="color:red;">*</span></label>
                                <div class="controls">
                                    <input type="file" name="file_name" id="file_name" <?php echo empty($row) ? 'required' : ''; ?> />
                                    <?php if(isset($row['file_name']) && !empty($row['file_name'])){ ?>
                                        <span class="help-inline"><a href="<?php echo base_url().'files/'.$row['file_name']; ?>" target="_blank">View current file</a></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" />
                                <button type="submit" class="btn btn-primary"><i class="icon-upload icon-white"></i> Submit</button>
                                <a href="<?php echo ADMIN_BASE_URL; ?>administration/multi_upload" class="btn">Cancel</a>
                            </div>
                        </fieldset>
                    </form>

                    <legend>Uploaded Files List</legend>
                    <div class="table-scroll">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">Sl No.</th>
                                    <th>Wing</th>
                                    <th>Office</th>
                                    <th>Upload Date</th>
                                    <th>File</th>
                                    <th style="width: 100px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($results) && count($results) > 0){ 
                                    $sl = intval($this->input->get('per_page', true)) + 1;
                                    foreach($results as $item){ ?>
                                        <tr>
                                            <td><?php echo $sl++; ?></td>
                                            <td><?php echo html_escape($item['wing']); ?></td>
                                            <td><?php echo html_escape($item['office']); ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($item['upload_dt'])); ?></td>
                                            <td>
                                                <?php if(!empty($item['file_name'])){ ?>
                                                    <a href="<?php echo base_url().'files/'.$item['file_name']; ?>" target="_blank" class="btn btn-mini btn-info"><i class="icon-download-alt icon-white"></i> View / Download</a>
                                                <?php } else { echo '-'; } ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo ADMIN_BASE_URL.'administration/multi_upload_delete/'.$item['id']; ?>" class="btn btn-mini btn-danger" onclick="return confirm('Are you sure you want to delete this file?');"><i class="icon-trash icon-white"></i> Delete</a>
                                            </td>
                                        </tr>
                                <?php } } else { ?>
                                    <tr>
                                        <td colspan="6" style="text-align: center;">No records found.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
