<!-- Vertical Nav -->
<nav class="hk-nav hk-nav-light">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item active">
                            <a class="nav-link" href="/dashboard">
                                <i class="ion ion-md-analytics"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-with-badge" href="javascript:void(0);" data-toggle="collapse" data-target="#app_drp">
                                <i class="ion ion-md-appstore"></i>
                                <span class="nav-link-text">Aplicações</span>
                                <span class="badge badge-success badge-pill">Hot</span>
                            </a>
                            <ul id="app_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="chats.html">Chat</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="calendar.html">Calendar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="email.html">Email</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        
                        
                    </ul>
                    <hr class="nav-separator">
                    <div class="nav-header">
                        <span>MENU</span>
                        <span>MU</span>
                    </div>
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#Components_drp">
                                <i class="ion ion-md-outlet"></i>
                                <span class="nav-link-text">Gestão de Clientes</span>
                            </a>
                            <ul id="Components_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('clients.index')}}">Franquias</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('partners.list')}}">Sócios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="statusclientes">Status do Cliente</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="badge.html">Tipos de Vendas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="badge.html">Tipos de Recisão</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="badge.html">Histórico</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#content_drp">
                                <i class="ion ion-md-clipboard"></i>
                                <span class="nav-link-text">Gestão de Cobrança</span>
                            </a>
                            <ul id="content_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('releases.index')}}">Lançamentos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('releases.manager.index')}}">Gerenciar Lançamentos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('releasesuser.index')}}">Minhas Cobranças</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('schedules.index')}}">Agendamentos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('negotiations.index')}}">Negociações</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('agreements.index')}}">Acordos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="media-object.html">Gráficos</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#utilities_drp">
                                <i class="ion ion-md-git-branch"></i>
                                <span class="nav-link-text">Gestão de Projetos</span>
                            </a>
                            <ul id="utilities_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="background.html">Início</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="border.html">Projetos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="colors.html">Equipes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="colors.html">Escritórios</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#forms_drp">
                                <i class="ion ion-md-calculator"></i>
                                <span class="nav-link-text">Produtos</span>
                            </a>
                            <ul id="forms_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('categories.index')}}">Categorias</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="input-groups.html">Sub-Categorias</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="form-layout.html">Especificações</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="form-mask.html">Relações</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="form-mask.html">Variações</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="form-validation.html">Produtos</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#maps_drp">
                                <i class="ion ion-md-map"></i>
                                <span class="nav-link-text">Maps</span>
                            </a>
                            <ul id="maps_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="google-map.html">Google Map</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="vector-map.html">Vector Map</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <hr class="nav-separator">
                    <div class="nav-header">
                        <span>Configuração da Conta</span>
                        <span>CC</span>
                    </div>
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="documentation.html">
                                <i class="ion ion-md-bookmarks"></i>
                                <span class="nav-link-text">Meu Perfil</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="documentation.html">
                                <i class="ion ion-md-bookmarks"></i>
                                <span class="nav-link-text">Minhas Permissões</span>
                            </a>
                        </li>
                    </ul>
                    <hr class="nav-separator">
                    <div class="nav-header">
                        <span>Gerenciamento de Usuários</span>
                        <span>GU</span>
                    </div>
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="documentation.html">
                                <i class="ion ion-md-bookmarks"></i>
                                <span class="nav-link-text">Lista de Usuários</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="documentation.html">
                                <i class="ion ion-md-bookmarks"></i>
                                <span class="nav-link-text">Funções</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="documentation.html">
                                <i class="ion ion-md-bookmarks"></i>
                                <span class="nav-link-text">Funções dos Usuários</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="documentation.html">
                                <i class="ion ion-md-bookmarks"></i>
                                <span class="nav-link-text">Permissões das Funções</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="documentation.html">
                                <i class="ion ion-md-bookmarks"></i>
                                <span class="nav-link-text">Histórico</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>