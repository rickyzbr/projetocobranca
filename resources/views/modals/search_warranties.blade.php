<form method="POST" enctype="multipart/form-data" action="{{ route('warranty.search') }}">

                    {!! csrf_field() !!}

                    <div class="form-group row">  

                        
                    <div class="form-group col-xl-6">
                            <label for="Nome">Pedido</label>
                            <input type="text" name="busca" value="{{ old('busca') }}" class="form-control">
                        </div>
                    <div class="form-group col-xl-6">
                            <label for="Cargo">Estatus</label>
                            <select name="status_id" class="form-control">
                                    <option value="">Escolha o Estatus</option>
                                    @foreach($warrantiesStatus as $status)
                                    <option value="{{$status->id}}"
                                            @if( isset($warranty) && $warranty->status_id == $status->id )
                                                selected
                                            @endif
                                            >{{$status->name}}</option>
                                    @endforeach
                            </select>
                        </div>  
                        <div class="form-group col-xl-6">
                            <label for="Cargo">Cliente</label>
                            <select name="client_id" class="form-control">
                                    <option value="">Escolha o Cliente</option>
                                    @foreach($clients as $client)
                                    <option value="{{$client->id}}"
                                            @if( isset($warranty) && $warranty->client_id == $client->id )
                                                selected
                                            @endif
                                            >{{$client->name}}</option>
                                    @endforeach
                            </select>
                        </div>            

                        <div class="form-group col-xl-6">
                            <label for="Produto">Produto</label>
                            <select name="product_id" class="form-control">
                                    <option value="">Escolha o Produto</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}"
                                            @if( isset($warranty) && $warranty->product == $product->name )
                                                selected
                                            @endif
                                            >{{$product->cod_kgm}} - {{$product->name}}</option>
                                    @endforeach
                            </select>
                        </div> 

                        
                        <div class="form-group col-md-1">
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
                </form>