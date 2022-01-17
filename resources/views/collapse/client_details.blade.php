<div class="collapse" id="clientDetails">
                        <br>
                        <div class="card card-body">
                        <h5>Informações básicas para cobrança</h5>
                        <p>{{ $client->razao_social }} - {{ $client->state }}</p>
                        <hr>
                        <table class="table table-striped table-border mb-0">
                        <thead>
                            <tr>
                                <th class="w-35">Responsável</th>
                                <th>Telefones</th>
                                <th>Email</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>                                    
                                <td>{{$client->responsavel_tecnico}}</td>
                                <td>{{$client->phone01}} / {{$client->phone02}}</td>
                                <td>{{$client->email_site}}</td>
                                <td><a href="{{route('releases.manager.list_partner', $client->id)}}" class="btn btn-danger btn-icon-style-4 btn-sm"><i class="far fa-eye"></i></a> </td>
                            </tr>
                        </tbody>
                        </table>
                <hr>
                <div class="invoice-details">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-striped table-border mb-0">
                                <thead>
                                    <tr>
                                        <th class="w-30">Sócios</th>
                                        <th>CPF</th>
                                        <th>Fone</th>
                                        <th>Email</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($partners = $client->partnersClient)
                                    @foreach($partners as $partner)
                                    <tr>
                                    @if($partner->partner_id)
                                        <td>{{$partner->partner->id}} - {{$partner->partner->name}} </td>
                                        <td>{{$partner->partner->cpf}}</td>
                                        <td>{{$partner->partner->phone}}</td>
                                        <td>{{$partner->partner->email}}</td>
                                        <td> @if ($partner->partner->releases->count())
                                            <a href="{{route('releases.manager.list_partner', $partner->partner->id)}}" class="btn btn-danger btn-icon-style-4 btn-sm"><i class="far fa-eye"></i></a>
                                        @else
                                            <a href="" class="btn btn-success btn-icon-style-4 btn-sm"><i class="far fa-check-circle"></i></a>
                                        @endif</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>