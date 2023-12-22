@extends('layouts.template')

@section('content')
@if (session('succes'))
<div class="alert alert-success">{{session('succes')}}</div>
@endif

@if (session('error'))
<div class="alert alert-danger">{{session('error')}}</div>
@endif

            
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Paiements</h1>
                </div>
                <div class="col-auto">
                     <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="table-search-form row gx-1 align-items-center">
                                    <div class="col-auto">
                                        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>
                                
                            </div><!--//col-->
                            <div class="col-auto">
                                
                                <select class="form-select w-auto" >
                                      <option selected value="option-1">All</option>
                                      <option value="option-2">This week</option>
                                      <option value="option-3">This month</option>
                                      <option value="option-4">Last 3 months</option>
                                      
                                </select>
                            </div>
                            <div class="col-auto">
                                @if ($isPayment)						    
                                <a class="btn app-btn-secondary" href="{{route('payment.make')}}">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
      <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
    </svg>
                                    
                                        Effectuez un nouveau paiements
                                    
                                </a>
                                @endif
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->
           
            
            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Tout les employes</a>
            </nav>
            
            
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">References</th>
                                            <th class="cell">Employes</th>
                                            <th class="cell">Montant Payes</th>
                                            <th class="cell">Date de transaction</th>
                                            <th class="cell">Mois</th>
                                            <th class="cell">Annee</th>
                                            <th class="cell">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($payments as $value)     
                                        <tr>
                                            <td class="cell">{{$value->references}}</td>
                                            <td class="cell">
                                                {{$value->employe->prenom}}
                                                {{$value->employe->nom}}
                                            
                                            </td>
                                            <td class="cell">{{$value->montant}}</td>
                                            <td class="cell">{{$value->launch_date}}</td>
                                            <td class="cell">{{$value->mois}}</td>
                                            <td class="cell">{{$value->annee}}</td>
                                            <td class="cell "><span class="badge bg-success">{{$value->status}}</span></td>
                                            <td class="cell"> </td>
                                
                                           
                                            <td class="cell">
                                                <a  href="{{route('payment.download',$value->id)}}">
                                                <i class="fa fa-download"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <td class="cell" colspan="6">Aucune transaction effectue</td>
                                            
                                        @endforelse

    
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->
                           
                        </div><!--//app-card-body-->		
                    </div><!--//app-card-->
                    <nav class="pagination mt-4 ">
                        {{ $payments->links()}}
                    </nav><!--//app-pagination-->
                    
                </div><!--//tab-pane-->               
            </div><!--//tab-content-->
            
    
@endsection