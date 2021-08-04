@extends('_master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
				<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
					<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
					<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
				</ol>
			</nav>
		</div>
		<div class="col-lg-6">
			<ul class="nav nav-pills mb-3 float-right mt-2" id="pills-tab" role="tablist">
				<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
					<i class="fa fa-plus"></i> Tambah Data
				</button>
			</ul>
		</div>
	</div>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header bg-primary py-3">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h6 class="m-0 font-weight-bold form-title text-white">Data Siswa</h6>
				</div>
			</div>
		</div>
		<div class="card-body">
			<form action="/siswaUpdate/{{ $data->id }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-sm-2">
						<img class="ml-4" src="{{ asset("Uploads/$data->foto") }}" width="100" height="80">
					</div>
					<div class="col-sm-10">
						<div class="form-group">
							<label for="foto">Upload foto</label>
							<input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" value="{{ $data->foto }}">
							@error('foto')
							<span class="help-error text-danger small"><strong>{{ $message }}</strong></span>
							@enderror
						</div>	
					</div>	
				</div>

				<div class="form-group">
					<label for="nama">Nama Lengkap</label>
					<input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ $data->nama }}">
					@error('nama')
					<span class="help-error text-danger small"><strong>{{ $message }}</strong></span>
					@enderror
				</div>

				<div class="form-group">
					<label for="kelas">Kelas</label>
					<input name="kelas" type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" value="{{ $data->kelas }}">
					@error('kelas')
					<span class="help-error text-danger small"><strong>{{ $message }}</strong></span>
					@enderror
				</div>

				<div class="form-group">
					<label for="angkatan">Angkatan</label>
					<input name="angkatan" type="text" class="form-control @error('angkatan') is-invalid @enderror" id="angkatan" value="{{ $data->angkatan }}">
					@error('angkatan')
					<span class="help-error text-danger small"><strong>{{ $message }}</strong></span>
					@enderror
				</div>

			</div>
			<div class="modal-footer">
				<a href="siswa" class="btn btn-secondary" >Kembali</a>
				<button type="submit" class="btn btn-primary">Update</button>
			</div>
		</form>
	</div>
</div>
@endsection