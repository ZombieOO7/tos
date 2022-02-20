<!-- Main sidebar -->
<div class="sidebar sidebar-main">
	<div class="sidebar-content">
		<!-- Main navigation -->
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">
					<!-- Main -->
					<li <?php echo $page=="home" ? 'class="active"' : ''; ?> ><a href="home.php"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

					<?php if($_SESSION['user_role']=="1") { ?>

						<li <?php echo $page=="view_one_customer" || $page=="edit_customer" ? 'class="active"' : ''; ?> ><a><i class="icon-collaboration"></i> <span>Customers</span></a>
							<ul>
								<li <?php echo $page=="add_customer" ? 'class="active"' : ''; ?> ><a href="add_customer.php"><i class="icon-add"></i><span>Add Customer</span></a></li>
								<li <?php echo $page=="view_customers" ? 'class="active"' : ''; ?> ><a href="view_customers.php"><i class="icon-menu7"></i><span>All Customers</span></a></li>
							</ul>
						</li>

						<li><a><i class="icon-gallery"></i><span>Gallery</span></a>
							<ul>
								<li  <?php echo $page=="add_gallery_images" ? 'class="active"' : ''; ?> ><a href="add_gallery_images.php"><i class="icon-add"></i><span>Upload Images</span></a></li>
								<li <?php echo $page=="view_gallery" ? 'class="active"' : ''; ?> ><a href="view_gallery.php"><i class="icon-menu7"></i><span>Gallery</span></a></li>
							</ul>
						</li>

						<li <?php echo $page=="edit_news" ? 'class="active"' : ''; ?> ><a><i class="icon-certificate"></i><span>News</span></a>
							<ul>
								<li  <?php echo $page=="add_news" ? 'class="active"' : ''; ?> ><a href="add_news.php"><i class="icon-add"></i><span>Add News</span></a></li>
								<li <?php echo $page=="view_news" ? 'class="active"' : ''; ?> ><a href="view_news.php"><i class="icon-menu7"></i><span>All News</span></a></li>
							</ul>
						</li>
					
						<li <?php echo $page=="edit_article" ? 'class="active"' : ''; ?> ><a><i class="icon-magazine"></i><span>Articles</span></a>
							<ul>
								<li  <?php echo $page=="add_article" ? 'class="active"' : ''; ?> ><a href="add_new_blog.php"><i class="icon-add"></i><span>Add Article</span></a></li>
								<li <?php echo $page=="view_articles" ? 'class="active"' : ''; ?> ><a href="view_new_blog.php"><i class="icon-menu7"></i><span>All Articles</span></a></li>
							</ul>
						</li>
					
						<li <?php echo $page=="edit_column" ? 'class="active"' : ''; ?> ><a><i class="icon-magazine"></i><span>Columns</span></a>
							<ul>
								<li  <?php echo $page=="add_column" ? 'class="active"' : ''; ?> ><a href="add_column.php"><i class="icon-add"></i><span>Add Column</span></a></li>
								<li <?php echo $page=="view_columns" ? 'class="active"' : ''; ?> ><a href="view_columns.php"><i class="icon-menu7"></i><span>All Columns</span></a></li>
							</ul>
						</li>
					
						<li <?php echo $page=="edit_review" ? 'class="active"' : ''; ?> ><a><i class="icon-file-text"></i><span>Reviews</span></a>
							<ul>
								<li  <?php echo $page=="add_review" ? 'class="active"' : ''; ?> ><a href="add_post.php"><i class="icon-add"></i><span>Add Review</span></a></li>
								<li <?php echo $page=="view_reviews" ? 'class="active"' : ''; ?> ><a href="view_posts.php"><i class="icon-menu7"></i><span>All Reviews</span></a></li>
							</ul>
						</li>
					
						<li <?php echo $page=="edit_feature" ? 'class="active"' : ''; ?> ><a><i class="icon-blog"></i><span>Features</span></a>
							<ul>
								<li  <?php echo $page=="add_feature" ? 'class="active"' : ''; ?> ><a href="add_blog.php"><i class="icon-add"></i><span>Add Feature</span></a></li>
								<li <?php echo $page=="view_features" ? 'class="active"' : ''; ?> ><a href="view_blog.php"><i class="icon-menu7"></i><span>All Features</span></a></li>
							</ul>
						</li>
					
						<li <?php echo $page=="edit_ev" ? 'class="active"' : ''; ?> ><a><i class="icon-car"></i><span>Electric Vehicles</span></a>
							<ul>
								<li  <?php echo $page=="add_ev" ? 'class="active"' : ''; ?> ><a href="add_ev.php"><i class="icon-add"></i><span>Add EV</span></a></li>
								<li <?php echo $page=="view_evs" ? 'class="active"' : ''; ?> ><a href="view_evs.php"><i class="icon-menu7"></i><span>All EV's</span></a></li>
							</ul>
						</li>

						<li <?php echo $page=="edit_story" ? 'class="active"' : ''; ?> ><a><i class="icon-grid"></i><span>Stories</span></a>
							<ul>
								<li  <?php echo $page=="add_story" ? 'class="active"' : ''; ?> ><a href="add_story.php"><i class="icon-add"></i><span>Add Story</span></a></li>
								<li <?php echo $page=="view_stories" ? 'class="active"' : ''; ?> ><a href="view_stories.php"><i class="icon-menu7"></i><span>All Story</span></a></li>
							</ul>
						</li>
					
						<li><a><i class="icon-comments"></i><span>Comments</span></a>
							<ul>
								<li  <?php echo $page=="add_comment" ? 'class="active"' : ''; ?> ><a href="add_comment.php"><i class="icon-add"></i><span>Add Comment</span></a></li>
								<li <?php echo $page=="view_comments" ? 'class="active"' : ''; ?> ><a href="view_comments.php"><i class="icon-menu7"></i><span>All Comments</span></a></li>
							</ul>
						</li>
					
						<li <?php echo $page=="view_inquiry" ? 'class="active"' : ''; ?> ><a href="view_inquiry.php"><i class="icon-bubble-notification"></i><span>Inquiries</span></a>
						</li>
					
						<li <?php echo $page=="edit_newsletter" || $page=="view_one_newsletter" ? 'class="active"' : ''; ?> ><a href="view_newsletters.php"><i class="icon-newspaper2"></i><span>News-Letter  Subscription</span></a>
							<ul>
								<li <?php echo $page=="view_subscribers" ? 'class="active"' : ''; ?> ><a href="view_subscribers.php"><i class="icon-user-check"></i><span>All Subscribers</span></a></li>
								<li <?php echo $page=="add_newsletter" ? 'class="active"' : ''; ?> ><a href="add_newsletter.php"><i class="icon-add"></i><span>Add News-Letter</span></a></li>
								<li <?php echo $page=="view_newsletters" ? 'class="active"' : ''; ?> ><a href="view_newsletters.php"><i class="icon-add"></i><span>All News-Letter</span></a></li>
							</ul>	
						</li>
					
					    <li <?php echo $page=="add_instagram_post" ? 'class="active"' : ''; ?>><a href="add_instagram_post.php"><i class="icon-instagram"></i><span>Insta Post</span></a></li>
					    
						<li><a href="view_abuse_reports.php"><i class="icon-alert"></i><span>Abuse Reports</span></a></li>
					
						<li <?php echo $page=="edit_video" ? 'class="active"' : ''; ?> ><a><i class="icon-video-camera3"></i><span>Videos</span></a>
							<ul>
								<li  <?php echo $page=="add_video" ? 'class="active"' : ''; ?> ><a href="add_video.php"><i class="icon-add"></i><span>Add Video</span></a></li>
								<li <?php echo $page=="view_videos" ? 'class="active"' : ''; ?> ><a href="view_videos.php"><i class="icon-menu7"></i><span>All Videos</span></a></li>
							</ul>
						</li>

						<li <?php echo $page=="edit_poll" ? 'class="active"' : ''; ?> ><a><i class="icon-stats-bars2"></i><span>Polls</span></a>
							<ul>
								<li  <?php echo $page=="add_poll" ? 'class="active"' : ''; ?> ><a href="add_poll.php"><i class="icon-add"></i><span>Add Poll</span></a></li>
								<li <?php echo $page=="view_polls" ? 'class="active"' : ''; ?> ><a href="view_polls.php"><i class="icon-menu7"></i><span>All Polls</span></a></li>
							</ul>
						</li>

						<li <?php echo $page=="edit_cms" || $page=="view_cms" ? 'class="active"' : ''; ?> ><a href="view_cms.php"><i class="icon-stack-text"></i><span>CMS</span></a></li>
					
						<li>
							<a><i class="icon-gear"></i> <span>Settings</span></a>
							<ul>
								<li <?php echo $page=="view_organization" || $page=="edit_organization" ? 'class="active"' : ''; ?>><a href="view_organization.php"><i class="icon-office"></i><span>Organization Details</span></a></li>
								<li <?php echo $page=="edit_user" ? 'class="active"' : ''; ?> ><a><i class="icon-users"></i><span>Users Management</span></a>
									<ul>
										<li <?php echo $page=="view_users" ? 'class="active"' : ''; ?> ><a href="view_users.php"><i class="icon-menu7"></i><span>All Users</span></a></li>
										<li <?php echo $page=="add_user" ? 'class="active"' : ''; ?> ><a href="add_user.php"><i class="icon-add"></i><span>Add User</span></a></li>
									</ul>	
								</li>
								<li><a><i class="icon-envelope"></i><span>Email Master</span></a>
									<ul>
										<li <?php echo $page=="view_email_log" ? 'class="active"' : ''; ?> ><a href="view_email_log.php"><i class="icon-menu7"></i><span>Email Log</span></a></li>
										<li <?php echo $page=="view_email_templates" || $page=="edit_email_template" ? 'class="active"' : ''; ?> ><a href="view_email_templates.php"><i class="icon-menu7"></i><span>Email Templates</span></a></li>
										<li  <?php echo $page=="view_smtp_settings" ? 'class="active"' : ''; ?> ><a href="view_smtp_settings.php"><i class=" icon-envelop4"></i><span>SMTP Settings</span></a></li>
									</ul>	
								</li>
								<li <?php echo $page=="view_news_category" ? 'class="active"' : ''; ?> ><a href="view_news_category.php"><i class="icon-menu7"></i><span>News Category</span></a></li>
							</ul>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<!-- /main navigation -->
	</div>
</div>
<!-- /main sidebar