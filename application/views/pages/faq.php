<div class="row">
	<div class="col-md-9 col-sm-8 col-md-push-3 col-sm-push-4">
		<div class="right-panel">
			<div class="breadcrumb"> <a href="<?php echo base_url()?>" role="link"><?php echo $this->lang->line('principal_accountant_general_A_E'); ?></a> &raquo; FAQ </div>
			<div>
				<h1 class="title"><?php echo $this->lang->line('faq'); ?></h1>
				<div class="page-details">
					<?php
					/*foreach($results as $row){
						echo '<details data-collapse="true">
								<summary>'.$row['question'].'</summary>
								<div>'.$row['answer'].'</div>
							  </details>';
					}*/
					?>
					<div class="faq-accordion">
						<div class="panel-group" id="accordion1">
						<?php
						if(!empty($results)){
							foreach($results as $row){?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"> 
											<a class="collapsed faq_categ" data-toggle="collapse" data-parent="#accordion1" href="#collapse_cate_<?php echo $row['faq_id']?>"><?php echo $row['category']?></a>
										</h4>
									</div>
									<div id="collapse_cate_<?php echo $row['faq_id']?>" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="panel-body">
												<div class="panel-group" id="accordion_cate_<?php echo $row['faq_id']?>">
													<?php
														foreach($row['faqs'] as $faq){?>
															<div class="panel">
																<a class="faq_ques" data-toggle="collapse" data-parent="#accordion_cate_<?php echo $row['faq_id']?>" href="#collapse_faq_<?php echo $faq['faq_id']?>"><?php echo $faq['question']?></a>
																<div id="collapse_faq_<?php echo $faq['faq_id']?>" class="panel-collapse collapse">
																	<div class="panel-body">
																		<div class="txt-content"><?php echo $faq['answer']?></div>
																	</div>
																</div>
															</div>
													<?php		
														}
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
						<?php
							}
						}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-4  col-md-pull-9 col-sm-pull-8">
		<div class="left-panel">
			<?php $this->load->view('layout/left_panel');?>
		</div>
	</div>
</div>