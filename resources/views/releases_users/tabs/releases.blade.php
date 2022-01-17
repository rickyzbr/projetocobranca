                    @if($countPartners != 0)
                    <div class="alert alert-warning alert-wth-icon alert-dismissible fade show" role="alert">
                        <span class="alert-icon-wrap"><i class="zmdi zmdi-alert-circle-o"></i></span> Existem {{$countPartners}} Lancamentos Sem CPF Vinculado !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="table-wrap">
                        <table id="list_1" class="table table-hover w-100 display pb-30">
                            <thead >
                                <tr>
                                    <th class="w-30">Tipo de Cobrança</th>
                                    <th>Devedor</th>
                                    <th>Status</th>
                                    <th>Vencimento</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                            <div style="display: none">
                                {{ $totalnew = 0 }}
                            </div>
                                @foreach($releases as $release)
                                <tr>
                                    <td>{{$release->type->name}}</td>
                                    <td>@if($release->partner_id) <span class="badge badge-soft-success badge-pill">{{$release->partner->name}}</span> @else <span class="badge badge-danger badge-pill">Sem CPF Vinculado @endif</span></small></td>
                                    <td><span class="badge badge-{{$release->status->color}} badge-pill">{{$release->status->name}}</span></td>
                                    
                                    <td>{{ date( 'd/m/Y' , strtotime($release->due_date))}}</td>
                                    <td>R$ {{ number_format($release->newAmount(), 2, ',','.') }}</td>
                                    <td></td>                                        
                                </tr>
                                <div style="display: none">{{$totalnew += $release->newAmount()}}</div>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-right font-weight-600">Total :</th>
                                    <th class="text-left font-weight-600">R$ {{number_format($totalnew, 2, ',','.')}}</th>
                                   
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>  
                </div>   