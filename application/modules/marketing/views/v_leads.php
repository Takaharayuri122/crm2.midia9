<div class="page-content hidden" ng-controller="Lead">

		<!-- FILTRO -->
		<div class="container-fluid col-md-12" ng-show="!add">
			
			<section class="card">
				<header class="card-header">
					Filtros
					<button ng-click="request()" type="button" class="modal-close">
						<i class="fa fa-refresh fa-2x"></i>
					</button>
				</header>
				<div class="card-block">
					<div class="row">
						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label" for="exampleInputEmail1">Código</label>
								<input type="text" ng-model="filtro.LE_CodigoLead" class="form-control">
							</fieldset>
						</div>
						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label" for="exampleInputEmail1">Vendedor</label>
								<input type="text" ng-model="filtro.USR_Nome" class="form-control">
							</fieldset>
						</div>
						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label" for="exampleInputEmail1">Cliente</label>
								<input type="text" ng-model="filtro.LE_Nome" class="form-control">
							</fieldset>
						</div>
						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label">Produto</label>
								<select class="select2" ng-model="filtro.LE_CodigoProduto" ng-required="true">
									<option value="">Selecione</option>
									<option ng-repeat="produtos in dados.filtro_produto" ng-value="produtos.PRO_CodigoProduto">{{produtos.PRO_Nome}}</option>
								</select>
							</fieldset>
						</div>
						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label" for="exampleInputEmail1">Origem</label>
								<input type="text" ng-model="filtro.LE_Origem" class="form-control">
							</fieldset>
						</div>
						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label" for="exampleInputEmail1">Tipo</label>
								<select class="select2" ng-model="filtro.LE_CodigoTipo" ng-required="true">
									<option value="">Selecione um Tipo</option>
									<option ng-repeat="tipo in dados.filtro_tipo" ng-value="tipo.LET_CodigoTipo">{{tipo.LET_Nome}}</option>
								</select>
							</fieldset>
						</div>
						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label">Status</label>
								<select class="select2" ng-model="filtro.LE_Status" ng-required="true">
									<option value="">Selecione</option>
									<option value="0">Aberto</option>
									<option value="1">Neociação</option>
									<option value="2">Venda Perdida</option>
									<option value="3">Encerrado</option>
									<option value="4">Venda Efetivada</option>
								</select>
							</fieldset>
						</div>
						<div class="col-lg-2">
								<fieldset class="form-group">
									<label class="form-label">Data <b class="text-danger">*</b></label>
									<div class='input-group date datetimepicker-1'>
										<input type='text' ng-model="filtro.LE_Data" class="form-control" />
										<span class="input-group-addon">
											<i class="font-icon font-icon-calend"></i>
										</span>
									</div>
								</fieldset>
							</div>
					</div>
					<div class="row">
						<div class="col-lg-2">
							<fieldset class="form-group">
								<button type="button" ng-click="buscar(filtro)" class="btn btn-inline btn-success btn-block">Filtrar</button>
							</fieldset>
						</div>
						<div class="col-lg-2">
							<fieldset class="form-group">
								<button type="button" ng-click="limpar(filtro)" class="btn btn-inline btn-warning btn-block">Limpar Filtro</button>
							</fieldset>
						</div>
						<div class="col-lg-2">
							<fieldset class="form-group">
								<button type="button" ng-click="novoLead()" class="btn btn-inline btn-primary btn-block">Novo Lead</button>
							</fieldset>
						</div>
						<div class="col-lg-2">
							<fieldset class="form-group">
								<button type="button" ng-click="buscar(filtro)" class="btn btn-inline btn-secondary btn-block">Mostrar Todos</button>
							</fieldset>
						</div>
					</div>
				</div>
			</section>
		</div><!--.container-fluid-->

		<div class="container-fluid col-md-12">
			<table id="table-sm" class="table table-bordered table-hover table-sm">
				<thead>
				<tr>
					<th width="1">
						#
					</th>
					<th>Vendedor</th>
					<th>Empresa</th>
					<th>Cliente</th>
					<th>Produto</th>
					<th>Origem</th>
					<th>Tipo</th>
					<th>Status</th>
					<th width="160px">Data</th>
					<th width="198px">Ação</th>
				</tr>
				</thead>
				<tbody>
				<tr ng-repeat="row in dados.leads | filter:filtro">
					<td>{{row.LE_CodigoLead}}</td>
					<td>{{row.USR_Nome}}</td>
					<td>{{row.EMP_RazaoSocial}}</td>
					<td>{{row.LE_Nome}}</td>
					<td>{{row.PRO_Nome}}</td>
					<td>{{row.LE_Origem}}</td>
					<td>{{row.LET_Nome}}</td>
					<td class="text-center">
						<span ng-if="row.LE_Status == 0" class='label label-info'>Aberto</span>
            <span ng-if="row.LE_Status == 1" class='label label-warning'>Negociação</span>
            <span ng-if="row.LE_Status == 2" class='label label-secondary'>Venda Perdida</span>
            <span ng-if="row.LE_Status == 3" class='label label-danger'>Encerrado</span>
            <span ng-if="row.LE_Status == 4" class='label label-success'>Venda Efetivada</span>
					</td>
					<td>{{row.LE_Data | date:'dd/MM/yyyy'}} {{row.LE_Hora}}</td>
					<td>
						<button type="button" ng-click="visualzarLead(row.LE_CodigoLead)" class="btn btn-sm btn-primary"><i class="font-icon font-icon-eye"></i></button>
						<button type="button" ng-click="setLeadStatus(row.LE_CodigoLead,1, 'Negociação')" ng-if="row.LE_Status != 1" class="btn btn-sm btn-warning"><i class="font-icon font-icon-fire"></i></button>
						<button type="button" ng-click="setLeadStatus(row.LE_CodigoLead,2, 'Venda Perdida')" ng-if="row.LE_Status != 2" class="btn btn-sm btn-secondary"><i class="font-icon font-icon-del"></i></button>
						<button type="button" ng-click="setLeadStatus(row.LE_CodigoLead,4, 'Venda Efetivada')" ng-if="row.LE_Status != 4" class="btn btn-sm btn-success"><i class="font-icon font-icon-ok"></i></button>
						<button type="button" ng-click="interacaoLead(row.LE_CodigoLead)" class="btn btn-sm btn-info"><i class="font-icon font-icon-comment"></i></button>
						<!-- ` -->
					</td>
				</tr>
				</tbody>
			</table>
		</div><!--.container-fluid-->
	</div>

<script type="text/ng-template" id="v_cadastroLead">
    <div class="container-fluid fade in col-md-12">
			<section class="card card-blue-fill">
				<header class="card-header">
					Adicionar um Novo Lead Manual
					<button ng-click="closeThisDialog()" type="button" class="modal-close">
						<i class="font-icon-close-2"></i>
					</button>
				</header>
				<div class="card-block">
					<form name="form_lead">
						<div class="row">
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label">Empresa <b class="text-danger">*</b></label>
									<select selectpicker id="select2" ng-model="lead.LE_CodigoEmpresa"  ng-required="true" style="z-index: 1001">
										<option value="">Selecione</option>
										<option ng-repeat="empresa in dados.empresas" ng-value="empresa.EMP_CodigoEmpresa">{{empresa.EMP_RazaoSocial}}</option>
									</select>
								</fieldset>
							</div>
							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label">Nome Cliente <b class="text-danger">*</b></label>
									<input type="text" ng-model="lead.LE_Nome"  ng-required="true" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label">Email <b class="text-danger">*</b></label>
									<input type="text" ng-model="lead.LE_Email"  ng-required="true" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-2">
								<fieldset class="form-group">
									<label class="form-label">Celular <b class="text-danger">*</b></label>
									<input type="text" ng-model="lead.LE_Celular" mask="(99) 9 9999-9999"  ng-required="true" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-2">
								<fieldset class="form-group">
									<label class="form-label">Origem <b class="text-danger">*</b></label>
									<input type="text" ng-model="lead.LE_Origem"  ng-required="true" placeholder="Lead Manual" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label">Produto <b class="text-danger">*</b></label>
									<select selectpicker id="select2" ng-model="lead.LE_CodigoProduto"  ng-required="true" style="z-index: 1001">
										<option value="">Selecione</option>
										<option ng-repeat="produtos in dados.filtro_produto" ng-value="produtos.PRO_CodigoProduto">{{produtos.PRO_Nome}}</option>
									</select>
								</fieldset>
							</div>
							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label">Status <b class="text-danger">*</b></label>
									<select selectpicker id="select2" data-dropup="true" ng-model="lead.LE_Status"  ng-required="true" style="z-index: 1001">
										<option value="">Selecione</option>
										<option value="0">Aberto</option>
										<option value="1">Selecione</option>
										<option value="2">Negociação</option>
										<option value="3">Venda Perdida</option>
										<option value="4">Encerrado</option>
										<option value="5">Venda Efetivada</option>
									</select>
								</fieldset>
							</div>
							<div class="col-lg-2">
								<fieldset class="form-group">
									<label class="form-label">Tipo <b class="text-danger">*</b></label>
									<select selectpicker id="select2" data-dropup="true" ng-model="lead.LE_CodigoTipo"  ng-required="true" style="z-index: 1001">
										<option value="">Selecione</option>
										<option value="1">Venda</option>
										<option value="2">Cotação</option>
									</select>
								</fieldset>
							</div>
							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label">Parcelamento</label>
									<select selectpicker id="select2" data-dropup="true" ng-model="lead.LE_Parcelas" style="z-index: 1001">
										<option value="" disabled="" selected="">Parcelas</option>
		                <option value="À Vista">À Vista</option>
		                <option value="12x">12 meses</option>
		                <option value="18x">18 meses</option>
		                <option value="24x">24 meses</option>
		                <option value="36x">36 meses</option>
		                <option value="48x">48 meses</option>
		                <option value="60x">60 meses</option>
									</select>
								</fieldset>
							</div>
							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label">Entrada</label>
									<input type="text" ng-model="lead.LE_Entrada" placeholder="R$ " class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label">Mensagem</label>
									<textarea ng-model="lead.LE_Descricao" class="form-control"></textarea>
								</fieldset>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<fieldset class="form-group">
									<button type="button" ng-click="closeThisDialog()" class="btn btn-inline btn-danger btn-block">Cancelar</button>
								</fieldset>
							</div>
							<div class="col-lg-6">
								<fieldset class="form-group">
									<button type="button" ng-disabled="form_lead.$invalid" ng-click="salvarLead(lead)" class="btn btn-inline btn-success btn-block">Salvar</button>
								</fieldset>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
</script>


<script type="text/ng-template" id="v_visualizarLead">
    <div class="container-fluid fade in col-md-12">
			<section class="card card-blue-fill">
				<header class="card-header">
					Detalhes do Lead: {{detalhe.LE_CodigoLead}}
					<button ng-click="closeThisDialog()" type="button" class="modal-close">
						<i class="font-icon-close-2"></i>
					</button>
				</header>
				<div class="card-block">
					<form>
						<div class="row">
							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label">Vendedor<b class="text-danger">*</b></label>
									<input type="text" value="{{detalhe.USR_Nome}}"  ng-required="true" disabled="true" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label">Cliente <b class="text-danger">*</b></label>
									<input type="text" value="{{detalhe.LE_Nome}}"  ng-required="true" disabled="true" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label">Email<b class="text-danger">*</b></label>
									<input type="text" value="{{detalhe.LE_Email}}"  ng-required="true" disabled="true" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label">Telefone<b class="text-danger">*</b></label>
									<input type="text" value="{{detalhe.LE_Telefone}}"  ng-required="true" disabled="true" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label">Data<b class="text-danger">*</b></label>
									<input type="text" value="{{detalhe.LE_Data | date:'dd/M/yyyy'}} {{detalhe.LE_Hora}}"  ng-required="true" disabled="true" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-2">
								<fieldset class="form-group">
									<label class="form-label">Status<b class="text-danger">*</b></label>
									<span ng-if="detalhe.LE_Status == 0" class='label label-info'>Aberto</span>
			            <span ng-if="detalhe.LE_Status == 1" class='label label-warning'>Negociação</span>
			            <span ng-if="detalhe.LE_Status == 2" class='label label-secondary'>Venda Perdida</span>
			            <span ng-if="detalhe.LE_Status == 3" class='label label-danger'>Encerrado</span>
			            <span ng-if="detalhe.LE_Status == 4" class='label label-success'>Venda Efetivada</span>
								</fieldset>
							</div>
							<div class="col-lg-2">
								<fieldset class="form-group">
									<label class="form-label">Origem<b class="text-danger">*</b></label>
									<input type="text" value="{{detalhe.LE_Origem}}"  ng-required="true" disabled="true" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-4">
								<fieldset class="form-group">
									<label class="form-label">Produto/Serviço<b class="text-danger">*</b></label>
									<input type="text" value="{{detalhe.PRO_Nome}}"  ng-required="true" disabled="true" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-4" ng-if="detalhe.LE_Parcelas">
								<fieldset class="form-group">
									<label class="form-label">Produto/Serviço<b class="text-danger">*</b></label>
									<input type="text" value="{{detalhe.LE_Parcelas}}X"  ng-required="true" disabled="true" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-4" ng-if="detalhe.LE_Entrada">
								<fieldset class="form-group">
									<label class="form-label">Entrada<b class="text-danger">*</b></label>
									<input type="text" value="{{detalhe.LE_Entrada | currency : 'R$ '}}"  ng-required="true" disabled="true" class="form-control">
								</fieldset>
							</div>
							<div class="col-lg-12">
								<fieldset class="form-group">
									<label class="form-label">Mensagem</label>
									<textarea  disabled="true" class="form-control">{{detalhe.LE_Descricao}}</textarea>
								</fieldset>
							</div>
						</div>
					</form>
				</div>
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
			<p>Deseja marcar este Lead como {{leadStatus}}?</p>
			<div class="row">
			<div class="col-lg-12">
				<fieldset class="form-group">
					<textarea ng-model="INT_Mensagem" ng-required="true" placeholder="Comentário" class="form-control">{{detalhe.LE_Descricao}}</textarea>
				</fieldset>
			</div>
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

<script type="text/ng-template" id="v_interacaoLead">
	<section class="card card-blue-fill">
		<header class="card-header">
			Interações
			<button ng-click="closeThisDialog()" type="button" class="modal-close">
				<i class="font-icon-close-2"></i>
			</button>
		</header>
		<div class="card-block">
			<section style="overflow-y: scroll; height:400px;">
				<div ng-repeat="inte in dados.interacoes | filter:INT_CodigoLead | orderBy: inte.LE_Hora:true">
				  <section class="activity-line-action" ng-if="inte.LE_CodigoLead">
						<div class="time">{{inte.INT_Data | date: 'dd/M/yyyy'}} {{inte.INT_Hora}}</dirv>
						<div class="cont">
							<div class="cont-in">
								<p>
									<b class="text-danger">{{inte.USR_Nome}}</b> fez uma nova interação com o Lead {{inte.LE_CodigoLead}}  
									<span ng-if="inte.INT_Status == 1" class="label label-warning">Negociação</span>
									<span ng-if="inte.INT_Status == 2" class="label label-black">Venda Perdida</span>
									<span ng-if="inte.INT_Status == 3" class="label label-danger">Venda Encerrada</span>
									<span ng-if="inte.INT_Status == 4" class="label label-success">Venda Efetivada</span>
									<span ng-if="inte.INT_Status == 10" class="label label-info">Comentário</span>
								</p>
								<div ng-if="inte.INT_Status == 1" class="alert alert-warning">
									{{inte.INT_Mensagem}}
								</div>
								<div ng-if="inte.INT_Status == 2" class="alert alert-black">
									{{inte.INT_Mensagem}}
								</div>
								<div ng-if="inte.INT_Status == 3" class="alert alert-danger">
									{{inte.INT_Mensagem}}
								</div>
								<div ng-if="inte.INT_Status == 4" class="alert alert-success">
									{{inte.INT_Mensagem}}
								</div>

								<div ng-if="inte.INT_Status == 10" class="alert alert-purple">
									{{inte.INT_Mensagem}}
								</div>
							</div>
					</section>
				</div>
			</section>
		</div>
		<footer  class="card-footer">
			<form name="form_interacao">
				<div class="col-lg-9">
					<fieldset class="form-group">
						<textarea ng-model="INT_Mensagem" ng-required="true" class="form-control">{{detalhe.LE_Descricao}}</textarea>
					</fieldset>
				</div>
				<div class="col-lg-3">
					<fieldset class="form-group">
						<button ng-disabled="form_interacao.$invalid" ng-click="createInteracao(INT_Mensagem)" class="btn btn-lg btn-success btn-block">Interagir</button>
					</fieldset>
				</div>
			</form>
		</footer>
</section>
</script>