<!-- Modal -->
<div class="modal fade" id="newCategories" tabindex="-1" role="dialog" aria-labelledby="newCategories" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nova Categoria !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('category.store') }}" >
                @csrf

                <div class="form-group">
                    <label for="Endereco">Nome : </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                </div>

                <div class="form-group">
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="form-control text-truncate" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                        <span class="input-group-append">
                                <span class=" btn btn-primary btn-file"><span class="fileinput-new">Arquivo</span><span class="fileinput-exists">Change</span>
                        <input type="file" name="image">
                        </span>
                        <a href="#" class="btn btn-secondary fileinput-exists" data-dismiss="fileinput">Remover</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit"  class="btn btn-primary">Cadastrar</button>
            </div>
            </form>
        </div>
    </div>
</div>