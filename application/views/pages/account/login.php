<div class="col-md-4 col-md-offset-4">
	<?php if ($this->session->flashdata('error')):?>
		<div class="alert alert-danger" style="margin-top: 30px; margin-bottom: 0px;">
			<a class="close" data-dismiss="alert">×</a>
			<?php echo $this->session->flashdata('error');?>
		</div>
	<?php endif;?>
	<?php echo form_open('account/login', 'class="form-signin"'); ?>
		<fieldset>
			<h3 class="sign-up-title" style="color:dimgray;">Đăng nhập</h3>
			<input class="form-control email-title" placeholder="Tên đăng nhập" name="email" type="text">
			<input class="form-control bottom" placeholder="Mật khẩu" name="password" type="password" value="">
			<div class="checkbox">
				<label><input name="remember" type="checkbox" value="Remember Me"> Remember Me</label>
			</div>
			<input class="btn btn-lg btn-success btn-block" type="submit" value="Đăng nhập">
			<br>
			<p class="text-center"><a href="http://nhabuon.vn/register">Đăng ký tài khoản</a></p>
		</fieldset>
		<input type="hidden" value="submitted" name="submitted"/>
	</form>
</div>