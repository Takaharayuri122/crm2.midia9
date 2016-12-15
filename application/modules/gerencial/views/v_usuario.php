<div class="page-content hidden" ng-controller="Usuario">
		
		<div class="container-fluid fade in col-md-12" ng-show="view">
			<section class="card card-blue-fill">
				<header class="card-header">
					Usuário Detalhe
					<button ng-click="cancelVisualizar()" type="button" class="modal-close">
						<i class="font-icon-close-2"></i>
					</button>
				</header>
				<div class="card-block">
					<div class="row">
						<div class="col-md-2 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Nome</label>
								<input type="text" class="form-control" value="{{detalhes.usuarios.USR_Nome}}" disabled="">
							</fieldset>
						</div>
						<div class="col-md-2 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Email</label>
								<input type="text" class="form-control" value="{{detalhes.usuarios.USR_Email}}" disabled="">
							</fieldset>
						</div>
						<div class="col-md-2 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Celular</label>
								<input type="text" class="form-control" value="{{detalhes.usuarios.USR_Celular}}" disabled="">
							</fieldset>
						</div>
						<div class="col-md-2 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Status</label>
								<span ng-show="detalhes.usuarios.USR_Status == 1" class="label label-danger">Desbloqueado</span>	
								<span ng-show="detalhes.usuarios.USR_Status == 0" class="label label-success">Bloqueado</span>			
							</fieldset>
						</div>
						<div class="col-md-2 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Receber SMS</label>
								<span ng-show="detalhes.usuarios.USR_ReceberRelatorioSMS == 1" class="label label-success">SIM</span>
								<span ng-show="detalhes.usuarios.USR_ReceberRelatorioSMS == 0" class="label label-success">NÃO</span>
								<span ng-show="detalhes.usuarios.USR_ReceberRelatorioSMS == null" class="label label-warning">INDEFINIDO</span>			
							</fieldset>
						</div>
						<div class="col-md-2 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Nivel</label>
								<span ng-show="detalhes.usuarios.USR_Nivel == 1" class="label label-success">Gerente</span>
								<span ng-show="detalhes.usuarios.USR_Nivel == 2" class="label label-warning">Vendedor</span>
								<span ng-show="detalhes.usuarios.USR_Nivel == 99" class="label label-primary">Administrador</span>			
							</fieldset>
						</div>
					</div>
				</div>
			</section>
		</div>

		<div class="container-fluid fade in col-md-12" ng-show="editable">
			<section class="card card-blue-fill">
				<header class="card-header">
					Usuário Detalhe
					<button ng-click="cancelVisualizar()" type="button" class="modal-close">
						<i class="font-icon-close-2"></i>
					</button>
				</header>
				<div class="card-block">
					<form name="form_visualizar">
						<div class="row">
							<div class="col-md-2 col-sm-6">
								<fieldset class="form-group">
									<label class="form-label">Nome</label>
									<input type="text" class="form-control" ng-model="detalhes.usuarios.USR_Nome">
								</fieldset>
							</div>
							<div class="col-md-2 col-sm-6">
								<fieldset class="form-group">
									<label class="form-label">Email</label>
									<input type="text" class="form-control" ng-model="detalhes.usuarios.USR_Email">
								</fieldset>
							</div>
							<div class="col-md-2 col-sm-6">
								<fieldset class="form-group">
									<label class="form-label">Celular</label>
									<input type="text" class="form-control" mask="(99) 9 9999-9999" ng-model="detalhes.usuarios.USR_Celular">
								</fieldset>
							</div>
							<div class="col-md-2 col-sm-6">
								<fieldset class="form-group">
									<label class="form-label">Status</label>
									<select class="bootstrap-select" ng-model="detalhes.usuarios.USR_Status" ng-required="true">
										<option value="">Selecione um Tipo</option>
										<option value="1">Grupo</option>
										<option value="2">Empresa</option>
									</select>
								</fieldset>
							</div>
							<div class="col-md-2 col-sm-6">
								<fieldset class="form-group">
									<label class="form-label">Receber SMS</label>
									<select class="bootstrap-select" ng-model="detalhes.usuarios.USR_ReceberRelatorioSMS" ng-required="true">
										<option value="">Selecione um Tipo</option>
										<option value="1">Sim</option>
										<option value="2">Não</option>
									</select>	
								</fieldset>
							</div>
							<div class="col-md-2 col-sm-6">
								<fieldset class="form-group">
									<label class="form-label">Nivel</label>
									<select class="bootstrap-select" ng-model="detalhes.usuarios.USR_ReceberRelatorioSMS" ng-required="true">
										<option value="">Selecione um Tipo</option>
										<option value="2">Vendedor</option>
										<option value="1">Gerente</option>
										<option value="99">Administrador</option>
									</select>			
								</fieldset>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>

		<!-- FILTROS -->
		<div class="container-fluid col-md-3" ng-show="!add">
			
			<section class="card">
				<header class="card-header">
					Filtros
					<button ng-click="request()" type="button" class="modal-close">
						<i class="fa fa-refresh fa-2x"></i>
					</button>
				</header>
				<div class="card-block">
					<div class="row">
					<div class="col-lg-12">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputEmail1">Nome</label>
							<input type="text" ng-model="filtro.USR_Nome" class="form-control" ng-required="true">
						</fieldset>
					</div>
					<div class="col-lg-12">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputEmail1">Email</label>
							<input type="text" ng-model="filtro.USR_Email" class="form-control" ng-required="true">
						</fieldset>
					</div>
					<div class="col-lg-12">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputEmail1">Telefone</label>
							<input type="text" ng-model="filtro.USR_Celular" mask="(99) 9 999-9999" class="form-control" ng-required="true">
						</fieldset>
					</div>
					<div class="col-lg-12">
						<fieldset class="form-group">
							<label class="form-label semibold">Nivel</label>
							<select class="bootstrap-select" ng-model="filtro.USR_Nivel" ng-required="true">
								<option value="">Selecione um Nivel</option>
								<option value="1">Gerente</option>
								<option value="2">Vendedor</option>
								<option value="99">Administrador</option>
							</select>
						</fieldset>
					</div>
					<div class="col-lg-12">
						<fieldset class="form-group">
							<label class="form-label semibold">Status</label>
							<select class="bootstrap-select" ng-model="filtro.USR_Status" ng-required="true">
								<option value="">Selecione um Tipo</option>
								<option value="1">Bloqueado</option>
								<option value="0">Desbloqueado</option>
							</select>
						</fieldset>
					</div>
					<div class="col-lg-12">
						<fieldset class="form-group">
							<button type="button" ng-click="buscar(filtro)" class="btn btn-inline btn-success btn-block">Filtrar</button>
							<button type="button" ng-click="limpar()" class="btn btn-inline btn-warning btn-block">Limpar Filtros</button>
							<button type="button" ng-click="setAdd()" class="btn btn-inline btn-primary btn-block">Adicionar Usuário</button>
							<button type="button" ng-click="" class="btn btn-inline btn-info btn-block">Mover Usuários</button>
						</fieldset>
					</div>
				</div>
				</div>
			</section>
		</div><!--.container-fluid-->

		<!-- ADICIONAR -->
		<div class="container-fluid col-md-3" ng-show="add">
			
			<section class="card">
				<header class="card-header">
					Adicionar Usuário
					<button ng-click="request()" type="button" class="modal-close">
						<i class="fa fa-refresh fa-2x"></i>
					</button>
				</header>
				<div class="card-block">
					<form name="form">
						<div class="row">
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label semibold">Nivel</label>
									<select class="bootstrap-select" ng-model="data.USR_Nivel" ng-required="true">
										<option value="">Selecione um Nivel</option>
										<option value="1">Gerente</option>
										<option value="2">Vendedor</option>
										<option value="99">Administrador</option>
									</select>
								</fieldset>
							</div>
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label semibold">Status</label>
									<select class="bootstrap-select" ng-model="data.USR_Status" ng-required="true">
										<option value="">Selecione um Tipo</option>
										<option value="1">Bloqueado</option>
										<option value="0">Desbloqueado</option>
									</select>
								</fieldset>
							</div>
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label" for="exampleInputEmail1">Nome</label>
									<input type="text" ng-model="data.USR_Nome" class="form-control" ng-required="true">
								</fieldset>
							</div>
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label" for="exampleInputEmail1">Email</label>
									<input type="text" ng-model="data.USR_Email" class="form-control" ng-required="true">
								</fieldset>
							</div>
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label" for="exampleInputEmail1">Senha</label>
									<input type="text" ng-model="data.USR_Senha" class="form-control" ng-required="true">
								</fieldset>
							</div>
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label" for="exampleInputEmail1">Telefone</label>
									<input type="text" ng-model="data.USR_Celular" mask="(99) 9 9999-9999" class="form-control" ng-required="true">
								</fieldset>
							</div>
							<div class="col-lg-12">
								<fieldset class="form-group">
									<button type="button" ng-disabled="form.$invalid" ng-click="salvar(data)" class="btn btn-inline btn-success btn-block">Salvar</button>
									<button type="button" ng-click="cancelAdd()" class="btn btn-inline btn-danger btn-block">Cancelar</button>
								</fieldset>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div><!--.container-fluid-->

		<div class="container-fluid col-md-9">
			<table id="table-sm" class="table table-bordered table-hover table-sm">
				<thead>
				<tr>
					<th width="1">
						#
					</th>
					<th>Nome</th>
					<th width="180px">Email</th>
					<th width="120px">Nivel</th>
					<th width="100px">Status</th>
					<th width="180px">Ação</th>
				</tr>
				</thead>
				<tbody>
				<tr ng-repeat="row in dados.usuarios | filter:filtro">
					<td>{{row.USR_CodigoUsuario}}</td>
					<td>{{row.USR_Nome}}</td>
					<td>{{row.USR_Email}}</td>
					<td>
						<span ng-show="row.USR_Nivel == 1" class="label label-success">Gerente</span>
						<span ng-show="row.USR_Nivel == 2" class="label label-warning">Vendedor</span>
						<span ng-show="row.USR_Nivel == 99" class="label label-primary">Administrador</span>
					</td>
					<td>
						<span ng-show="row.USR_Status == 1" class="label label-danger">Bloqueado</span>	
						<span ng-show="row.USR_Status == 0" class="label label-success">Desbloqueado</span>	
					</td>
					<td>
						<button type="button" ng-click="visualizar(row.USR_CodigoUsuario)" class="btn btn-primary btn-sm"><i class="font-icon font-icon-eye"></i></button>
						<button type="button" ng-click="editar(row.USR_CodigoUsuario)" class="btn btn-success btn-sm"><i class="font-icon font-icon-pencil"></i></button>
						<button type="button" class="btn btn-danger btn-sm"><i class="font-icon font-icon-trash"></i></button>
					</td>
				</tr>
				</tbody>
			</table>
		</div><!--.container-fluid-->
	</div>