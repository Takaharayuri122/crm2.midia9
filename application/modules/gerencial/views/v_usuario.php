<div class="page-content hidden" ng-controller="Usuario">

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
							<label class="form-label" for="exampleInputEmail1">Empresa</label>
							<input type="text" ng-model="filtro.EMP_RazaoSocial" class="form-control" ng-required="true">
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
							<button type="button" ng-click="limpar()" class="btn btn-inline btn-warning btn-block">Limpar Filtros</button>
							<button type="button" ng-click="adicionar()" class="btn btn-inline btn-primary btn-block">Adicionar Usuário</button>
						</fieldset>
					</div>
				</div>
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
					<th width="175px">Nome</th>
					<th width="60px">Email</th>
					<th width="180px">Empresa</th>
					<th>Nivel</th>
					<th width="100px">Status</th>
					<th width="180px">Ação</th>
				</tr>
				</thead>
				<tbody>
				<tr ng-repeat="row in dados.usuarios | filter:filtro">
					<td>{{row.USR_CodigoUsuario}}</td>
					<td>{{row.USR_Nome}}</td>
					<td>{{row.USR_Email}}</td>
					<td><b>{{row.EMP_RazaoSocial}}</b></td>
					<td>
						<span ng-show="row.USR_Nivel == 1" class="label label-success">Gerente</span>
						<span ng-show="row.USR_Nivel == 2" class="label label-warning">Vendedor</span>
						<span ng-show="row.USR_Nivel == 99" class="label label-primary">Administrador</span>
					</td>
					<td>
						<span ng-show="!row.USR_Status" class="label label-warning">Indefinido</span>	
						<span ng-show="row.USR_Status == 1" class="label label-danger">Bloqueado</span>	
						<span ng-show="row.USR_Status == 0" class="label label-success">Desbloqueado</span>	
					</td>
					<td>
						<button type="button" ng-click="visualizar(row.USR_CodigoUsuario)" class="btn btn-primary btn-sm"><i class="font-icon font-icon-eye"></i></button>
						<button type="button" ng-click="editar(row.USR_CodigoUsuario)" class="btn btn-success btn-sm"><i class="font-icon font-icon-pencil"></i></button>
						<button type="button" ng-click="setStatus(row.USR_CodigoUsuario, 1, 'Você deseja Bloquear o Usuário?')" ng-if="row.USR_Status == 0" class="btn btn-danger btn-sm"><i class="fa fa-lock"></i></button>
						<button type="button" ng-click="setStatus(row.USR_CodigoUsuario, 0, 'Você deseja Desbloquear o Usuário?')" ng-if="row.USR_Status == 1" class="btn btn-success btn-sm"><i class="fa fa-unlock"></i></button>
					</td>
				</tr>
				</tbody>
			</table>
		</div><!--.container-fluid-->
	</div>

<script type="text/ng-template" id="v_visualizarUsuario">
	<div class="container-fluid fade in col-md-12">
		<section class="card card-blue-fill">
			<header class="card-header">
				Usuário Detalhe
				<button ng-click="closeThisDialog()" type="button" class="modal-close">
					<i class="font-icon-close-2"></i>
				</button>
			</header>
			<div class="card-block">
				<div class="row">
					<div class="col-md-2 col-sm-6">
						<fieldset class="form-group">
							<label class="form-label">Nome</label>
							<input type="text" class="form-control" value="{{detalhes.USR_Nome}}" disabled="">
						</fieldset>
					</div>
					<div class="col-md-2 col-sm-6">
						<fieldset class="form-group">
							<label class="form-label">Email</label>
							<input type="text" class="form-control" value="{{detalhes.USR_Email}}" disabled="">
						</fieldset>
					</div>
					<div class="col-md-2 col-sm-6">
						<fieldset class="form-group">
							<label class="form-label">Celular</label>
							<input type="text" class="form-control" value="{{detalhes.USR_Celular}}" disabled="">
						</fieldset>
					</div>
					<div class="col-md-2 col-sm-6">
						<fieldset class="form-group">
							<label class="form-label">Status</label>
							<span ng-show="detalhes.USR_Status == 1" class="label label-danger">Desbloqueado</span>	
							<span ng-show="detalhes.USR_Status == 0" class="label label-success">Bloqueado</span>			
						</fieldset>
					</div>
					<div class="col-md-2 col-sm-6">
						<fieldset class="form-group">
							<label class="form-label">Receber SMS</label>
							<span ng-show="detalhes.USR_ReceberRelatorioSMS == 1" class="label label-success">SIM</span>
							<span ng-show="detalhes.USR_ReceberRelatorioSMS == 0" class="label label-success">NÃO</span>
							<span ng-show="detalhes.USR_ReceberRelatorioSMS == null" class="label label-warning">INDEFINIDO</span>			
						</fieldset>
					</div>
					<div class="col-md-2 col-sm-6">
						<fieldset class="form-group">
							<label class="form-label">Nivel</label>
							<span ng-show="detalhes.USR_Nivel == 1" class="label label-success">Gerente</span>
							<span ng-show="detalhes.USR_Nivel == 2" class="label label-warning">Vendedor</span>
							<span ng-show="detalhes.USR_Nivel == 99" class="label label-primary">Administrador</span>			
						</fieldset>
					</div>
				</div>
			</div>
		</section>
	</div>
</script>

<script type="text/ng-template" id="v_editarUsuario">
	<div class="container-fluid fade in col-md-12">
		<section class="card card-blue-fill">
			<header class="card-header">
				Alterar Usuário
				<button ng-click="closeThisDialog()" type="button" class="modal-close">
					<i class="font-icon-close-2"></i>
				</button>
			</header>
			<div class="card-block">
				<form name="form_visualizar">
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Nome</label>
								<input type="text" class="form-control" ng-model="detalhes.USR_Nome">
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Email</label>
								<input type="text" class="form-control" ng-model="detalhes.USR_Email">
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Celular</label>
								<input type="text" class="form-control" mask="(99) 9 9999-9999" ng-model="detalhes.USR_Celular">
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Status</label>
								<select selectpicker id="select2" data-width="100%" ng-model="detalhes.USR_Status" ng-required="true">
									<option value="">Selecione uma Opção</option>
									<option value="0">Desbloqueado</option>
									<option value="1">Bloqueado</option>
								</select>
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Receber SMS</label>
								<select selectpicker id="select2" data-width="100%" ng-model="detalhes.USR_ReceberRelatorioSMS" ng-required="true">
									<option value="">Selecione uma Opção</option>
									<option value="1">Sim</option>
									<option value="2">Não</option>
								</select>	
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Nivel</label>
								<select selectpicker id="select2" data-width="100%" ng-model="detalhes.USR_Nivel" ng-required="true">
									<option value="">Selecione uma Opção</option>
									<option value="2">Vendedor</option>
									<option value="1">Gerente</option>
									<option value="99">Administrador</option>
								</select>			
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6" ng-if="!alterarSenhaVar">
							<fieldset class="form-group">
								<label class="form-label">Senha</label>
								<button type="button"  ng-click="alterarSenha(1)" class="btn btn-inline btn-warning btn-block">Clique para Alterar a Senha</button>
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6" ng-if="alterarSenhaVar">
							<fieldset class="form-group">
								<label class="form-label">Senha</label>
								<input type="password" class="form-control" ng-model="detalhes.USR_Senha">
							</fieldset>
						</div>
					</div>
				</form>
			</div>
			<footer class="card-footer text-center">
				<div class="row">
					<div class="col-lg-8"></div>
					<div class="col-lg-2">
						<fieldset class="form-group">
							<button type="button" ng-click="closeThisDialog()" class="btn btn-inline btn-danger btn-block">Sair</button>
						</fieldset>
					</div>
					<div class="col-lg-2">
						<fieldset class="form-group">
							<button type="button" ng-click="confirm(detalhes)" class="btn btn-inline btn-success btn-block">Salvar</button>
						</fieldset>
					</div>
				</div>
			</footer>
		</section>
	</div>
</script>


<script type="text/ng-template" id="v_adicionarUsuario">
	<div class="container-fluid fade in col-md-12">
		<section class="card card-blue-fill">
			<header class="card-header">
				Adicionar Usuário
				<button ng-click="closeThisDialog()" type="button" class="modal-close">
					<i class="font-icon-close-2"></i>
				</button>
			</header>
			<div class="card-block">
				<form name="form_adicionar">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<fieldset class="form-group">
								<label class="form-label">Empresa</label>
								<input type="text" class="form-control" value="{{dados.empresa.EMP_RazaoSocial}}" disabled>
							</fieldset>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Nome</label>
								<input type="text" class="form-control" ng-model="detalhes.USR_Nome">
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Email</label>
								<input type="text" class="form-control" ng-model="detalhes.USR_Email">
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Celular</label>
								<input type="text" class="form-control" mask="(99) 9 9999-9999" ng-model="detalhes.USR_Celular" ng-required="true">
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Status</label>
								<select selectpicker id="select2" data-width="100%" ng-model="detalhes.USR_Status" ng-required="true">
									<option value="">Selecione uma Opção</option>
									<option value="0">Desbloqueado</option>
									<option value="1">Bloqueado</option>
								</select>
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Receber SMS</label>
								<select selectpicker id="select2" data-width="100%" ng-model="detalhes.USR_ReceberRelatorioSMS" ng-required="true">
									<option value="">Selecione uma Opção</option>
									<option value="1">Sim</option>
									<option value="2">Não</option>
								</select>	
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6">
							<fieldset class="form-group">
								<label class="form-label">Nivel</label>
								<select selectpicker id="select2" data-width="100%" ng-model="detalhes.USR_Nivel" ng-required="true">
									<option value="">Selecione uma Opção</option>
									<option value="2">Vendedor</option>
									<option value="1">Gerente</option>
									<option value="99">Administrador</option>
								</select>			
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6" ng-if="!alterarSenhaVar">
							<fieldset class="form-group">
								<label class="form-label">Senha</label>
								<button type="button"  ng-click="alterarSenha(1)" class="btn btn-inline btn-warning btn-block">Não utilizar senha padrão</button>
							</fieldset>
						</div>
						<div class="col-md-4 col-sm-6" ng-if="alterarSenhaVar">
							<fieldset class="form-group">
								<label class="form-label">Senha</label>
								<input type="password" class="form-control" ng-model="detalhes.USR_Senha">
							</fieldset>
						</div>
					</div>
				</form>
			</div>
			<footer class="card-footer text-center">
				<div class="row">
					<div class="col-lg-8"></div>
					<div class="col-lg-2">
						<fieldset class="form-group">
							<button type="button"  ng-click="closeThisDialog()" class="btn btn-inline btn-danger btn-block">Sair</button>
						</fieldset>
					</div>
					<div class="col-lg-2">
						<fieldset class="form-group">
							<button type="button" ng-disabled="form_adicionar.$invalid"  ng-click="confirm(detalhes)" class="btn btn-inline btn-success btn-block">Salvar</button>
						</fieldset>
					</div>
				</div>
			</footer>
		</section>
	</div>
</script>

<script type="text/ng-template" id="v_infoAlert">
	<section class="card card-{{class}}-fill">
		<header class="card-header">
			Atenção
			<button ng-click="closeThisDialog()" type="button" class="modal-close">
				<i class="font-icon-close-2"></i>
			</button>
		</header>
		<div class="card-block">
			<p>{{alertText}}</p>
			<div class="row">
				<div class="col-lg-6">
					<fieldset class="form-group">
						<button type="button" ng-click="closeThisDialog()" class="btn btn-inline btn-danger btn-block">Não</button>
					</fieldset>
				</div>
				<div class="col-lg-6">
					<fieldset class="form-group">
						<button type="button" ng-click="confirm(INT_Mensagem)" class="btn btn-inline btn-success btn-block">Sim</button>
					</fieldset>
				</div>
			</div>
		</div>
	</section>
</script>


