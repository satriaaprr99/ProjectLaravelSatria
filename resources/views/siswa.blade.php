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
			<div class="form-data-show" id="form-data-show">
				<div class="form-show" id="form-show"></div>

				<div class="form-group float-right" id="form-footer">
					<button type="button" class="btn btn-sm btn-white mr-3" id="form-btn-save"></button>
				</div>

			</div>
			<div class="table-responsive-sm table-data">
				<table class="table table-sm table-bordered" id="datatable" width="100%" cellspacing="0">
					<thead class="text-primary">
						<tr>
							<th>No</th>
							<th>Foto</th>
							<th>Nama Lengkap</th>
							<th>Kelas</th>
							<th>Angkatan</th>
							<th>Created</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						@foreach ($data as $b)
						<tr>
							<th scope="row">{{ $no++ }}</th>
							<td><img src="{{ 'Uploads' }}/{{$b->foto}}" width="50" height="50"></td>
							<td>{{ $b->nama }}</td>
							<td>{{ $b->kelas }}</td>
							<td>{{ $b->angkatan }}</td>
							<td>{{ $b->updated_at }}</td>
							<td>
								<a class="btn btn-primary btn-sm" href="siswaEdit/{{$b->id}}"><i class="fa fa-edit"></i></a>
								<a class="btn btn-danger btn-sm" href="siswaDelete/{{$b->id}}" onclick="return confirm('Anda yakin akan menghapus data ?');" ><i class="fa fa-trash"></i></a> 
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Modal tambah -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data</h5>
				</div>
				<div class="modal-body">
					<form action="siswa/create" method="post" enctype="multipart/form-data">
						@csrf

						<div class="form-group">
							<label for="foto">Upload foto</label>
							<input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" >
							@error('foto')
							<span class="help-error text-danger small"><strong>{{ $message }}</strong></span>
							@enderror
						</div>

						<div class="form-group">
							<label for="nama">Nama Lengkap</label>
							<input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama">
							@error('nama')
							<span class="help-error text-danger small"><strong>{{ $message }}</strong></span>
							@enderror
						</div>

						<div class="form-group">
							<label for="kelas">Kelas</label>
							<input name="kelas" type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas">
							@error('kelas')
							<span class="help-error text-danger small"><strong>{{ $message }}</strong></span>
							@enderror
						</div>

						<div class="form-group">
							<label for="angkatan">Angkatan</label>
							<input name="angkatan" type="text" class="form-control @error('angkatan') is-invalid @enderror" id="angkatan">
							@error('angkatan')
							<span class="help-error text-danger small"><strong>{{ $message }}</strong></span>
							@enderror
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
@endsection