<div class="page-content hidden" ng-controller="Empresa">
		
		<div class="container-fluid fade in col-md-12" ng-show="editable">
			<section class="card card-blue-fill">
				<header class="card-header">
					Panel title
					<button ng-click="cancelVisualizar()" type="button" class="modal-close">
						<i class="font-icon-close-2"></i>
					</button>
				</header>
				<div class="card-block">
					<p class="card-text">Panel content</p>
				</div>
			</section>
		</div>
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
							<label class="form-label" for="exampleInputEmail1">Razão Social</label>
							<input type="text" ng-model="filtro.EMP_RazaoSocial" class="form-control">
						</fieldset>
					</div>
					<div class="col-lg-12">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputEmail1">CNPJ</label>
							<input type="text" ng-model="filtro.EMP_CNPJ" mask="99.999.999/9999-99" class="form-control">
						</fieldset>
					</div>
					<div class="col-lg-12">
						<fieldset class="form-group">
							<label class="form-label" for="exampleInputEmail1">Chave</label>
							<input type="text" ng-model="filtro.EMP_Key" class="form-control">
						</fieldset>
					</div>
					<div class="col-lg-12">
						<fieldset class="form-group">
							<button type="button" ng-click="buscar(filtro)" class="btn btn-inline btn-success btn-block">Filtrar</button>
							<button type="button" ng-click="limpar()" class="btn btn-inline btn-warning btn-block">Limpar Filtros</button>
							<button type="button" ng-click="setAdd()" class="btn btn-inline btn-primary btn-block">Adicionar Empresa</button>
						</fieldset>
					</div>
					<!-- <div class="col-lg-2">
						<fieldset class="form-group">
							<label class="form-label semibold">First Name</label>
							<select class="bootstrap-select">
								<option>Quant Verbal</option>
								<option>Real Gmat Test</option>
								<option>Prep test</option>
								<option>Catprep test</option>
								<option>Long long long extra long example line long long long extra long example line </option>
							</select>
						</fieldset>
					</div> -->
				</div>
				</div>
			</section>
		</div><!--.container-fluid-->

		<div class="container-fluid col-md-3" ng-show="add">
			
			<section class="card">
				<header class="card-header">
					Filtros
					<button ng-click="request()" type="button" class="modal-close">
						<i class="fa fa-refresh fa-2x"></i>
					</button>
				</header>
				<div class="card-block">
					<form name="form">
						<div class="row">
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label semibold">Tipo</label>
									<select class="bootstrap-select" ng-model="opt.tipo" ng-required="true">
										<option value="">Selecione um Tipo</option>
										<option value="1">Grupo</option>
										<option value="2">Empresa</option>
									</select>
								</fieldset>
							</div>
							<div class="col-lg-12" ng-show="opt.tipo == 2">
								<fieldset class="form-group">
									<label class="form-label semibold">Grupos</label>
									<select selectpicker class="bootstrap-select" ng-model="data.EMP_CodigoPai">
										<option value="">Selecione um Grupo</option>
										<option ng-repeat="grupo in dados.grupo" value="{{grupo.EMP_CodigoEmpresa}}">{{grupo.EMP_RazaoSocial}}</option>
									</select>
								</fieldset>
							</div>
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label" for="exampleInputEmail1">Razão Social</label>
									<input type="text" ng-model="data.EMP_RazaoSocial" class="form-control" ng-required="true">
								</fieldset>
							</div>
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label" for="exampleInputEmail1">CNPJ</label>
									<input type="text" ng-model="data.EMP_CNPJ" mask="99.999.999/9999-99" class="form-control" ng-required="true">
								</fieldset>
							</div>
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label">Emails Gerentes</label>
									<textarea id="tags-editor-textarea" ng-model="data.EMP_Email" ng-required="true"></textarea>
								</fieldset>
							</div>
							<div class="col-lg-12">
								<fieldset class="form-group">
									<button type="button" ng-click="salvar(data)" class="btn btn-inline btn-success btn-block">Salvar</button>
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
					<th>Razão Social</th>
					<th width="180px">CNPJ</th>
					<th width="280px">Chave</th>
					<th width="180px">Ação</th>
				</tr>
				</thead>
				<tbody>
				<tr ng-repeat="row in dados.empresa | filter:filtro">
					<td>{{row.EMP_CodigoEmpresa}}</td>
					<td>{{row.EMP_RazaoSocial}}</td>
					<td>{{row.EMP_CNPJ}}</td>
					<td>{{row.EMP_Key}}</td>
					<td>
						<button type="button" ng-click="visualizar(row.EMP_CodigoEmpresa)" class="btn btn-primary-outline"><i class="font-icon font-icon-eye"></i></button>
						<button type="button" class="btn btn-success-outline"><i class="font-icon font-icon-pencil"></i></button>
						<button type="button" class="btn btn-danger-outline"><i class="font-icon font-icon-trash"></i></button>
					</td>
				</tr>
				</tbody>
			</table>
		</div><!--.container-fluid-->
	</div>