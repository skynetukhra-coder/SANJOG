<div class="row-fluid">
  <div class="span12" id="content">
    <div class="block">
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Administration-II Wing - Overview</div>
      </div>
      <div class="block-content collapse in">
        <div class="span12">
          <div class="alert alert-info" style="margin-bottom: 20px;">
            <h4><i class="icon-info-sign"></i> Administration-II Wing Dashboard</h4>
            <p>Welcome to the Administration-II Wing management portal. Use the navigation sidebar to manage notices, circulars, employee records, and approvals.</p>
          </div>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 50px;">#</th>
                <th>Page / Content Name</th>
                <th>URL</th>
                <th>Type</th>
                <th>Status</th>
                <th style="width: 150px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(isset($results) && count($results) > 0){
                $sl = 1;
                foreach($results as $row){ ?>
                  <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo isset($row['page_name']) ? html_escape($row['page_name']) : '-'; ?></td>
                    <td><?php echo (!empty($row['page_url'])) ? '<a href="'.AGAE_BASE_URL.'page/'.$row['page_url'].'" target="_blank">'.AGAE_BASE_URL.'page/'.$row['page_url'].'</a>' : '-'; ?></td>
                    <td><?php echo isset($row['type']) ? html_escape($row['type']) : '-'; ?></td>
                    <td><?php echo isset($row['status']) ? html_escape($row['status']) : '-'; ?></td>
                    <td>
                      <?php if(isset($row['page_id'])){ ?>
                        <button class="btn btn-mini btn-primary" onclick="goEdit('<?php echo $row['page_id']; ?>','<?php echo isset($row['type']) ? $row['type'] : ''; ?>')"><i class="icon-pencil icon-white"></i> Edit</button>
                      <?php } ?>
                    </td>
                  </tr>
              <?php }
              } else { ?>
                <tr>
                  <td colspan="6" style="text-align: center; color: #777;">Please select an action from the navigation menu.</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>