@extends('layouts.default', ['sidebarSearch' => true])

@section('title', 'Master Kelas')

@section('content')

	<!-- begin panel -->
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Master Kelas</h4>
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			</div>
		</div>
		<div class="panel-body">
			@if(Auth::user()->role == "admin")<div id="gridDeleteSelected"></div>@endif
			<div id="popup"></div>
			<div id="grid-kelas" style="height: 550px; width:100%;"></div>
		</div>
	</div>
	<!-- end panel -->
@endsection


 
@push('scripts')
<script src="/assets/js/masteruser/kelas.js?n=<?php echo rand(); ?>"></script>
@endpush