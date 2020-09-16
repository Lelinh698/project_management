<button type="button" id="student-create" class="btn btn-primary" data-toggle="modal" 
    data-target="#create_student_modal" style="float: right; bottom: 10px;">Thêm sinh viên</button>
<div class="modal fade" id="create_student_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Thêm học sinh</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<form id="createstudent" name="createstudent" class="form-horizontal">
						<input type="hidden" name="student_id" id="student_id">
						<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="hoten">Tên sinh viên</label>
									<input type="text" class="form-control" id="hoten" name="hoten" placeholder="Tên sinh viên" maxlength="255" required />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="mssv">MSSV</label>
									<input type="text" class="form-control" id="mssv" name="mssv" placeholder="MSSV" maxlength="15" required />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="username">Username</label>
									<input type="username" class="form-control" id="username" name="username" placeholder="Username" maxlength="255" required />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="255" required autocomplete="current-password"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="255" required />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="sodienthoai">Số điện thoại</label>
									<input type="text" class="form-control" id="sodienthoai"  name="sodienthoai" placeholder="Số điện thoại" maxlength="15" required />
								</div>	
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="khoa">Khoa</label>
									<input type="text" class="form-control" id="khoa" name="khoa" placeholder="Khoa" maxlength="255" required />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lop">Lớp</label>
									<input type="text" class="form-control" id="lop" name="lop" placeholder="Lớp" maxlength="255" required />
								</div>	
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="ngaysinh">Ngày sinh</label>
									<input type="date" class="form-control" id="ngaysinh" name="ngaysinh" placeholder="Ngày sinh" maxlength="255" required />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="quequan">Quê quán</label>
									<input type="text" class="form-control" id="quequan" name="quequan" placeholder="Quê quán" maxlength="255" required />
								</div>		
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<button type="submit" id="btn-save" class="btn btn-primary" form="createstudent">Lưu lại</button>
			</div>
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>
</br>
</br>