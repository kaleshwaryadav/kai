<?php
/*
 * Template Name: Message
 */

get_header();

echo"Hello";
 ?>


<!-- main-body section starts here -->

<section class="success-sec">
	<div class="container ">
		<div class="breadcrumb">
			<?php if(function_exists('bcn_display'))
			{
				bcn_display();
			}?>
		</div>
		<div class="head_ttl">
			<h2>Message</h2>
		</div>
		<div id="parentVerticalTab">
			<ul class="resp-tabs-list hor_1">
				<li>
					<div class="media">
						<div class="media-left media-top">
							<a class="" href="#">
								<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat1.jpg" alt="Media Object">
							</a>
						</div>
						<div class="media-body">
							<span class="dot online"></span>
							<span class="mem_name">John Smith</span>
							<p>Consectetur adipiscing elit. Aenean</p>
							<span class="chat_time">9 Mar 2016</span>
						</div>
					</div>
					<a href="#" class="action dlt">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<div class="media">
						<div class="media-left media-top">
							<a class="" href="#">
								<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat2.jpg" alt="Media Object">
							</a>
						</div>
						<div class="media-body">
							<span class="dot "></span>
							<span class="mem_name">Mahir khan</span>
							<p>Consectetur adipiscing elit. Aenean</p>
							<span class="chat_time">9 Mar 2016</span>
						</div>
					</div>
					<a href="#" class="action dlt">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<div class="media">
						<div class="media-left media-top">
							<a class="" href="#">
								<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat3.jpg" alt="Media Object">
							</a>
						</div>
						<div class="media-body">
							<span class="dot online"></span>
							<span class="mem_name">Johny Walker</span>
							<p>Consectetur adipiscing elit. Aenean</p>
							<span class="chat_time">9 Mar 2016</span>
						</div>
					</div>
					<a href="#" class="action dlt">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<div class="media">
						<div class="media-left media-top">
							<a class="" href="#">
								<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat4.jpg" alt="Media Object">
							</a>
						</div>
						<div class="media-body">
							<span class="dot "></span>
							<span class="mem_name">Priyanka Sharma</span>
							<p>Consectetur adipiscing elit. Aenean</p>
							<span class="chat_time">9 Mar 2016</span>
						</div>
					</div>
					<a href="#" class="action dlt">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<div class="media">
						<div class="media-left media-top">
							<a class="" href="#">
								<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat5.jpg" alt="Media Object">
							</a>
						</div>
						<div class="media-body">
							<span class="dot "></span>
							<span class="mem_name">Mrinal</span>
							<p>Consectetur adipiscing elit. Aenean</p>
							<span class="chat_time">9 Mar 2016</span>
						</div>
					</div>
					<a href="#" class="action dlt">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<div class="media">
						<div class="media-left media-top">
							<a class="" href="#">
								<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
							</a>
						</div>
						<div class="media-body">
							<span class="dot "></span>
							<span class="mem_name">Joseph</span>
							<p>Consectetur adipiscing elit. Aenean</p>
							<span class="chat_time">9 Mar 2016</span>
						</div>
					</div>
					<a href="#" class="action dlt">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
					</a>
				</li>



			</ul>
			<div class="resp-tabs-container hor_1">
				<div>
					<div class="chat_widget">
						<div class="chat_mem">
							<div class="row">
								<div class="col-md-6">
									<span class="memname">To: John Smith</span>
								</div>
                    	  <!-- 	<div class="col-md-6 text-right">
                    	  		<span class="">
                    	       <a href="#" class="compose">Compose Message</a>
                    	       <a href="#" class="btn btn_bdr detail_btn">Detail</a>
                    	   </span>
                    	</div> -->
                    </div>
                </div>
                <div class="chat_box">
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, cons ectetur, There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, cons ectetur, There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>ok</p>
                			</div>
                		</div>
                	</div>

                	<div class="form-group">
                		<textarea placeholder="Write your message here......."></textarea>
                	</div>
                	<div class="form-group">
                		<button class="btn">Send</button>
                	</div>
                </div>

            </div>	
        </div>
        <div>
        	<div class="chat_widget">
        		<div class="chat_mem">
        			<div class="row">
        				<div class="col-md-6">
        					<span class="memname">To: mahir khan</span>
        				</div>
                    	  	<!-- <div class="col-md-6 text-right">
                    	  		<span class="">
                    	       <a href="#" class="compose">Compose Message</a>
                    	       <a href="#" class="btn btn_bdr detail_btn">Detail</a>
                    	   </span>
                    	</div> -->
                    </div>
                </div>
                <div class="chat_box">
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, cons ectetur, There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, cons ectetur, There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>ok</p>
                			</div>
                		</div>
                	</div>

                	<div class="form-group">
                		<textarea placeholder="Write your message here......."></textarea>
                	</div>
                	<div class="form-group">
                		<button class="btn">Send</button>
                	</div>
                </div>

            </div>	
        </div>
        <div>
        	<div class="chat_widget">
        		<div class="chat_mem">
        			<div class="row">
        				<div class="col-md-6">
        					<span class="memname">To: Johny </span>
        				</div>
                    	  	<!-- <div class="col-md-6 text-right">
                    	  		<span class="">
                    	       <a href="#" class="compose">Compose Message</a>
                    	       <a href="#" class="btn btn_bdr detail_btn">Detail</a>
                    	   </span>
                    	</div> -->
                    </div>
                </div>
                <div class="chat_box">
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, cons ectetur, There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, cons ectetur, There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>ok</p>
                			</div>
                		</div>
                	</div>

                	<div class="form-group">
                		<textarea placeholder="Write your message here......."></textarea>
                	</div>
                	<div class="form-group">
                		<button class="btn">Send</button>
                	</div>
                </div>

            </div>	
        </div>
        <div>
        	<div class="chat_widget">
        		<div class="chat_mem">
        			<div class="row">
        				<div class="col-md-6">
        					<span class="memname">To: Priyanka Sharma</span>
        				</div>
                    	  	<!-- <div class="col-md-6 text-right">
                    	  		<span class="">
                    	       <a href="#" class="compose">Compose Message</a>
                    	       <a href="#" class="btn btn_bdr detail_btn">Detail</a>
                    	   </span>
                    	</div> -->
                    </div>
                </div>
                <div class="chat_box">
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, cons ectetur, There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, cons ectetur, There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>ok</p>
                			</div>
                		</div>
                	</div>

                	<div class="form-group">
                		<textarea placeholder="Write your message here......."></textarea>
                	</div>
                	<div class="form-group">
                		<button class="btn">Send</button>
                	</div>
                </div>

            </div>	
        </div>
        <div>
        	<div class="chat_widget">
        		<div class="chat_mem">
        			<div class="row">
        				<div class="col-md-6">
        					<span class="memname">To: mrinal</span>
        				</div>
                    	  	<!-- <div class="col-md-6 text-right">
                    	  		<span class="">
                    	       <a href="#" class="compose">Compose Message</a>
                    	       <a href="#" class="btn btn_bdr detail_btn">Detail</a>
                    	   </span>
                    	</div> -->
                    </div>
                </div>
                <div class="chat_box">
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, cons ectetur, There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, cons ectetur, There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>ok</p>
                			</div>
                		</div>
                	</div>

                	<div class="form-group">
                		<textarea placeholder="Write your message here......."></textarea>
                	</div>
                	<div class="form-group">
                		<button class="btn">Send</button>
                	</div>
                </div>

            </div>	
        </div>
        <div>
        	<div class="chat_widget">
        		<div class="chat_mem">
        			<div class="row">
        				<div class="col-md-6">
        					<span class="memname">To: Joseph</span>
        				</div>
                    	  	<!-- <div class="col-md-6 text-right">
                    	  		<span class="">
                    	       <a href="#" class="compose">Compose Message</a>
                    	       <a href="#" class="btn btn_bdr detail_btn">Detail</a>
                    	   </span>
                    	</div> -->
                    </div>
                </div>
                <div class="chat_box">
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, cons ectetur, There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, cons ectetur, There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>There is no one who loves pain itself, who seeks after it and wants to have it. que porro quisquam.</p>
                			</div>
                		</div>
                	</div>
                	<div class="chat_inline">
                		<div class="user_dtls">
                			<div class="media">
                				<div class="media-left media-middle">
                					<img class="media-object" src="<?php bloginfo('template_url') ?>/assets/images/chat6.jpg" alt="Media Object">
                				</div>
                				<div class="media-body media-middle">
                					<span class="mem_name"><span class="dot online "></span>Johnny Smith</span>
                					<span class="chat_time">9 Mar 2016</span>
                				</div>
                			</div>
                		</div>
                		<div class="user_text">
                			<div class="text_fld">
                				<p>ok</p>
                			</div>
                		</div>
                	</div>

                	<div class="form-group">
                		<textarea placeholder="Write your message here......."></textarea>
                	</div>
                	<div class="form-group">
                		<button class="btn">Send</button>
                	</div>
                </div>

            </div>	
        </div>
    </div>

</div>
</div>
</div>	
</section>

<script type="text/javascript" src="<?php bloginfo('template_url') ?>/assets/js/easyResponsiveTabs.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
            	var $tab = $(this);
            	var $info = $('#nested-tabInfo2');
            	var $name = $('span', $info);
            	$name.text($tab.text());
            	$info.show();
            }
        });
	});
</script>
<?php get_footer();
