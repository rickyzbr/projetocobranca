<div class="row">
    @include('includes.alerts')
        <div class="col-sm">
            <form method="POST" enctype="multipart/form-data" action="{{ route('agreement.postsimulation') }}">
            @csrf
                <div class="row">
                <div class="col-md-6 form-group">
                        <label for="lastName">Franquia</label>
                        <select class="form-control custom-select d-block w-100" id="client_id" name="client_id">
                            <option value="">Selecione...</option>
                            <option value="{{$client->id}}"
                                    @if( isset($client) && $client->id == $client->id )
                                        selected
                                    @endif
                                    >{{$client->name}}</option> 
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="lastName">Sócio</label>
                        <select class="form-control custom-select d-block w-100" id="partner_id" name="partner_id">
                            <option value="">Selecione...</option>
                            @foreach($partners as $partner)
                            <option value="{{$partner->partner->id}}"
                                    @if( isset($client) && $client->partner_id == $partner->id )
                                        selected
                                    @endif
                                    >{{$partner->partner->name}}</option> 
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="lastName">Valor Devido</label>
                        <input class="form-control" id="agreements_amount" name="agreements_amount" value="{{ number_format($total, 2, '.','')}}" type="text">
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="lastName">Parcelas</label>
                        <input class="form-control" id="installments" name="installments" type="number"  value="{{ old('installments') }}" type="text">
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="lastName">Multa %</label>
                        <input class="form-control" id="amount" name="amount" value="2" type="text">
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="lastName">Juros Mês %</label>
                        <input class="form-control" id="amount" name="amount" value="1" type="text">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Primeiro Vencimento</label>
                        <input class="form-control" id="due_date" name="due_date" value="{{ $date->format('Y-m-d') }}" type="date">
                    </div>
                </div>                
                <button class="btn btn-primary btn-sm" type="submit">Cadastrar</button>
            </form>
        </div>
    </div>