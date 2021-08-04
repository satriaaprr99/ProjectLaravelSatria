@extends('_master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header bg-primary py-3">
			<div class="row">
				<div class="col-sm-12 text-left">
					<h6 id="header-user" class="m-0  font-weight-bold form-title text-white">Selamat Datang, {{ Auth::user()->name }}</h6>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
