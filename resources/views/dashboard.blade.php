@extends('layouts.template')
@section('content')
    
<h1 class="app-page-title">Dashboard</h1>
			    
<div class="row mt-2 mb-2">
@if ($notification)
    <div class="alert alert-warning"><b>Attention:</b> {{$notification}}</div>
@endif

</div>
    
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Departement</h4>
                <div class="stats-figure">{{$totalDepartements}}</div>

            </div><!--//app-card-body-->
            <a class="app-card-link-mask" href="{{route('departement.index')}}"></a>
        </div><!--//app-card-->
    </div><!--//col-->
    
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Employes</h4>
                <div class="stats-figure">{{$totalEmployes}}</div>

            </div><!--//app-card-body-->
            <a class="app-card-link-mask" href="{{route('employe.index')}}"></a>
        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Administraterus</h4>
                <div class="stats-figure">{{$totalAdministrateurs}}</div>

            </div><!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Retard de paiement</h4>
                <div class="stats-figure">0</div>
            </div><!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div><!--//app-card-->
    </div><!--//col-->
</div><!--//row-->

@endsection