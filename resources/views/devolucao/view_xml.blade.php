@extends('layouts.app')
@section('title', 'Adicionar devolução')

@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">

	@php
	$__f1 = ['options' => ['url' => '/devolucao/save', 'method' => 'post', 'id' => 'add_purchase_form', 'files' => true ]];
	@endphp
	<x-form.open :options="$__f1['options']" />
	@component('components.widget', ['class' => 'box-primary'])

	<input type="hidden" value="{{json_encode($contact)}}" name="contact">
	<input type="hidden" value="{{json_encode($itens)}}" name="itens" id="itens">
	<input type="hidden" value="{{json_encode($dadosNf)}}" name="dadosNf">

	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">

				@if(is_null($default_location))
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-map-marker"></i>
								</span>
								@php
								$__f2 = ['name' => 'select_location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.select_location'), 'id' => 'select_location_id', 'required', 'autofocus'], 'optionsAttributes' => $bl_attributes];
								@endphp
								<x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" :options-attributes="$__f2['optionsAttributes']" />
								<span class="input-group-addon">
									@show_tooltip('Local da devolução')
								</span> 
							</div>
						</div>
					</div>
				</div>
				@endif
				<h3 class="box-title">Fornecedor</h3>
				@if($dadosNf['novoFornecedor'])
				<p class="text-danger">*Este é um novo fornecedor, será cadastrado se finalizar a compra!</p>
				@endif
				<div class="row">
					<div class="col-sm-6">

						<span>Nome: <strong>{{$contact['name']}}</strong></span><br>
						<span>CNPJ/CPF: <strong>{{$contact['cpf_cnpj']}}</strong></span><br>
						<span>IE/RG: <strong>{{$contact['ie_rg']}}</strong></span>
					</div>

					<div class="col-sm-6">

						<span>Rua: <strong>{{$contact['rua']}}, {{$contact['numero']}}</strong></span><br>
						<span>Bairro: <strong>{{$contact['bairro']}}</strong></span><br>
						<span>Cidade: <strong>{{$cidade->nome}} ({{$cidade->uf}})</strong></span>

					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="form-group">
				<h3 class="box-title">Dados do Documento</h3>

				<div class="row">
					<div class="col-sm-12">

						<span>Chave: <strong>{{$dadosNf['chave']}}</strong></span><br>
						<span>Valor: <strong>{{number_format((double)$dadosNf['vProd'], 2, ',', '.')}}</strong></span><br>
						<span>Número: <strong>{{$dadosNf['nNf']}}</strong></span><br>
						<span>Valor do frete: <strong>{{number_format((double)$dadosNf['vFrete'], 2, ',', '.')}}</strong></span><br>
						<span>Valor de desconto: <strong>{{number_format((double)$dadosNf['vDesc'], 2, ',', '.')}}</strong></span><br>
					</div>

				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="form-group">
				<h3 class="box-title">Produtos</h3>


				<div class="">
					
					<!-- Inicio tabela -->
					<div class="nav-tabs-custom">


						<div class="tab-content">
							<div class="tab-pane active" id="product_list_tab">
								<br><br>
								<div class="table-responsive">
									<div id="product_table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
										<div class="row margin-bottom-20 text-center">
											<table class="table table-bordered table-striped ajax_view hide-footer dataTable no-footer" id="product_table" role="grid" aria-describedby="product_table_info" style="width: 1300px;">
												<thead>
													<tr role="row">
														
														<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 200px;" aria-label="">Produto</th>
														<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 80px;" aria-label="">Código</th>
														<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 80px;" aria-label="Produto">NCM</th>
														<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 80px;" aria-label="Produto">CFOP</th>
														<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 80px;" aria-label="Produto">Quantidade</th>
														<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 80px;" aria-label="Produto">Valor Unit.</th>
														<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;" aria-label="Produto">Cod. Barras</th>
														<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 80px;" aria-label="Produto">Unidade</th>
														<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 80px;" aria-label="">Ações</th>
													</tr>
												</thead>

												<tbody>

													@foreach($itens as $i)

													<tr id="tr_{{$i['codigo']}}">
														<td style="width: 180px;">{{$i['xProd']}}</td>
														<td style="width: 80px;">{{$i['codigo']}}</td>
														<td style="width: 80px;">{{$i['NCM']}}</td>
														<td style="width: 80px;">{{$i['CFOP']}}</td>

														<td style="width: 80px;">
															<input title="{{$i['codigo']}}" type="" class="form-control qtd" value="{{$i['qCom']}}" name="">
														</td>

														<td style="width: 80px;">{{$i['vUnCom']}}</td>
														<td style="width: 100px;">{{$i['codBarras']}}</td>
														<td style="width: 100px;">{{$i['uCom']}}</td>
														<td style="width: 80px;"><a onclick="removeItem('{{$i['codigo']}}')">Remove Item</a></td>

													</tr>
													@endforeach
													
												</tbody>
											</table>
										</div>

									</div>


								</div>
							</div>
						</div>
					</div>

					<!-- fim tabela -->
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				<div class="form-group">

					<div class="col-sm-4">
						<div class="form-group">
							@php
							$__f3 = ['name' => 'natureza_id', 'value' => 'Natureza de Operação para devolução'. ':*'];
							@endphp
							<x-form.label :name="$__f3['name']" :value="$__f3['value']" />
							@php
							$__f4 = ['name' => 'natureza_id', 'list' => $naturezas, 'selected' => null, 'options' => ['id' => 'natureza_id', 'class' => 'form-control select2', 'required', 'placeholder' => __('messages.please_select')]];
							@endphp
							<x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
						</div>
					</div>

					<div class="col-sm-2">
						<div class="form-group">
							@php
							$__f5 = ['name' => 'tipo', 'value' => 'Tipo'. ':*'];
							@endphp
							<x-form.label :name="$__f5['name']" :value="$__f5['value']" />
							@php
							$__f6 = ['name' => 'tipo', 'list' => ['1' => '1 - Saída', '0' => '0 - Entrada'], 'selected' => null, 'options' => ['id' => 'tipo', 'class' => 'form-control select2', 'required']];
							@endphp
							<x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
						</div>
					</div>

					<div class="col-sm-2">
						<div class="form-group">
							@php
							$__f7 = ['name' => 'desconto', 'value' => 'Desconto'. ':*'];
							@endphp
							<x-form.label :name="$__f7['name']" :value="$__f7['value']" />
							@php
							$__f8 = ['name' => 'desconto', 'value' => $dadosNf['vDesc'], 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Desconto']];
							@endphp
							<x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
						</div>
					</div>

					<div class="col-sm-2">
						<div class="form-group">
							@php
							$__f9 = ['name' => 'valor_frete', 'value' => 'Valor do frete'. ':*'];
							@endphp
							<x-form.label :name="$__f9['name']" :value="$__f9['value']" />
							@php
							$__f10 = ['name' => 'valor_frete', 'value' => $dadosNf['vFrete'], 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Valor do frete']];
							@endphp
							<x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
						</div>
					</div>

					<div class="clearfix"></div>
					
					<div class="col-sm-2">
						<div class="form-group">
							@php
							$__f11 = ['name' => 'vSeguro', 'value' => 'Valor do seguro'. ':*'];
							@endphp
							<x-form.label :name="$__f11['name']" :value="$__f11['value']" />
							@php
							$__f12 = ['name' => 'vSeguro', 'value' => $dadosNf['vSeguro'], 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Valor do seguro']];
							@endphp
							<x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
						</div>
					</div>

					<div class="col-sm-2">
						<div class="form-group">
							@php
							$__f13 = ['name' => 'vOutro', 'value' => 'Outras despesas'. ':*'];
							@endphp
							<x-form.label :name="$__f13['name']" :value="$__f13['value']" />
							@php
							$__f14 = ['name' => 'vOutro', 'value' => $dadosNf['vOutro'], 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Outras despesas']];
							@endphp
							<x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
						</div>
					</div>


					<div class="col-sm-5">
						<div class="form-group">
							@php
							$__f15 = ['name' => 'motivo', 'value' => 'Motivo'. ':*'];
							@endphp
							<x-form.label :name="$__f15['name']" :value="$__f15['value']" />
							@php
							$__f16 = ['name' => 'motivo', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Motivo']];
							@endphp
							<x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							@php
							$__f17 = ['name' => 'observacao', 'value' => 'Observação'. ':'];
							@endphp
							<x-form.label :name="$__f17['name']" :value="$__f17['value']" />
							@php
							$__f18 = ['name' => 'observacao', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Observação']];
							@endphp
							<x-form.input type="text" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-12">
				<div class="box @if(!empty($class)) {{$class}} @else box-danger @endif" id="accordion">
					<div class="box-header with-border" style="cursor: pointer;">
						<h3 class="box-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
								Transportadora
							</a>
						</h3>
					</div>
					<div id="collapseFilter" class="panel-collapse active collapse" aria-expanded="true">
						<div class="box-body">
							<div class="col-md-3">
								<div class="form-group">
									@php
									$__f19 = ['name' => 'transportadora_nome', 'value' => 'Nome:'];
									@endphp
									<x-form.label :name="$__f19['name']" :value="$__f19['value']" />
									@php
									$__f20 = ['name' => 'transportadora_nome', 'value' => $infoFrete ? $infoFrete['transportadora_nome'] : '', 'options' => ['class' => 'form-control','placeholder' => 'Nome']];
									@endphp
									<x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									@php
									$__f21 = ['name' => 'transportadora_cidade', 'value' => 'Cidade:'];
									@endphp
									<x-form.label :name="$__f21['name']" :value="$__f21['value']" />
									@php
									$__f22 = ['name' => 'transportadora_cidade', 'value' => $infoFrete ? $infoFrete['transportadora_cidade'] : '', 'options' => ['class' => 'form-control','placeholder' => 'Cidade']];
									@endphp
									<x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
								</div>
							</div>

							<div class="col-sm-1">
								<div class="form-group">
									@php
									$__f23 = ['name' => 'transportadora_uf', 'value' => 'UF'. ':'];
									@endphp
									<x-form.label :name="$__f23['name']" :value="$__f23['value']" />
									@php
									$__f24 = ['name' => 'transportadora_uf', 'list' => $estados, 'selected' => $infoFrete ? $infoFrete['transportadora_uf'] : '', 'options' => ['id' => 'natureza_id', 'class' => 'form-control select2', 'placeholder' => 'UF']];
									@endphp
									<x-form.select :name="$__f24['name']" :list="$__f24['list']" :selected="$__f24['selected']" :options="$__f24['options']" />
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									@php
									$__f25 = ['name' => 'transportadora_cpf_cnpj', 'value' => 'CPF/CNPJ:'];
									@endphp
									<x-form.label :name="$__f25['name']" :value="$__f25['value']" />
									@php
									$__f26 = ['name' => 'transportadora_cpf_cnpj', 'value' => $infoFrete ? $infoFrete['transportadora_cpf_cnpj'] : '', 'options' => ['class' => 'form-control','placeholder' => 'CPF/CNPJ']];
									@endphp
									<x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									@php
									$__f27 = ['name' => 'transportadora_ie', 'value' => 'IE:'];
									@endphp
									<x-form.label :name="$__f27['name']" :value="$__f27['value']" />
									@php
									$__f28 = ['name' => 'transportadora_ie', 'value' => $infoFrete ? $infoFrete['transportadora_ie'] : '', 'options' => ['class' => 'form-control','placeholder' => 'IE']];
									@endphp
									<x-form.input type="text" :name="$__f28['name']" :value="$__f28['value']" :options="$__f28['options']" />
								</div>
							</div>

							<div class="col-md-5">
								<div class="form-group">
									@php
									$__f29 = ['name' => 'transportadora_endereco', 'value' => 'Logradouro:'];
									@endphp
									<x-form.label :name="$__f29['name']" :value="$__f29['value']" />
									@php
									$__f30 = ['name' => 'transportadora_endereco', 'value' => $infoFrete ? $infoFrete['transportadora_endereco'] : '', 'options' => ['class' => 'form-control','placeholder' => 'Logradouro']];
									@endphp
									<x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="box @if(!empty($class)) {{$class}} @else box-info @endif" id="accordion">
					<div class="box-header with-border" style="cursor: pointer;">
						<h3 class="box-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseFilter2">
								Frete
							</a>
						</h3>
					</div>
					<div id="collapseFilter2" class="panel-collapse active collapse" aria-expanded="true">
						<div class="box-body">
							<div class="col-md-2">
								<div class="form-group">
									@php
									$__f31 = ['name' => 'frete_quantidade', 'value' => 'Quantidade:'];
									@endphp
									<x-form.label :name="$__f31['name']" :value="$__f31['value']" />
									@php
									$__f32 = ['name' => 'frete_quantidade', 'value' => $infoFrete ? $infoFrete['frete_quantidade'] : '', 'options' => ['class' => 'form-control','placeholder' => 'Quantidade']];
									@endphp
									<x-form.input type="text" :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									@php
									$__f33 = ['name' => 'frete_especie', 'value' => 'Espécie:'];
									@endphp
									<x-form.label :name="$__f33['name']" :value="$__f33['value']" />
									@php
									$__f34 = ['name' => 'frete_especie', 'value' => $infoFrete ? $infoFrete['frete_especie'] : '', 'options' => ['class' => 'form-control','placeholder' => 'Espécie']];
									@endphp
									<x-form.input type="text" :name="$__f34['name']" :value="$__f34['value']" :options="$__f34['options']" />
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									@php
									$__f35 = ['name' => 'frete_marca', 'value' => 'Marca:'];
									@endphp
									<x-form.label :name="$__f35['name']" :value="$__f35['value']" />
									@php
									$__f36 = ['name' => 'frete_marca', 'value' => $infoFrete ? $infoFrete['frete_marca'] : '', 'options' => ['class' => 'form-control','placeholder' => 'Marca']];
									@endphp
									<x-form.input type="text" :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									@php
									$__f37 = ['name' => 'frete_numero', 'value' => 'Número:'];
									@endphp
									<x-form.label :name="$__f37['name']" :value="$__f37['value']" />
									@php
									$__f38 = ['name' => 'frete_numero', 'value' => $infoFrete ? $infoFrete['frete_numero'] : '', 'options' => ['class' => 'form-control','placeholder' => 'Número']];
									@endphp
									<x-form.input type="text" :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />
								</div>
							</div>


							<div class="col-md-2">
								<div class="form-group">
									@php
									$__f39 = ['name' => 'frete_tipo', 'value' => 'Tipo do frete:'];
									@endphp
									<x-form.label :name="$__f39['name']" :value="$__f39['value']" />

									@php
									$__f40 = ['name' => 'frete_tipo', 'list' => $tiposFrete, 'selected' => $infoFrete ? $infoFrete['frete_tipo'] : '', 'options' => ['class' => 'form-control select2', 'data-default' => 'percentage']];
									@endphp
									<x-form.select :name="$__f40['name']" :list="$__f40['list']" :selected="$__f40['selected']" :options="$__f40['options']" />

								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									@php
									$__f41 = ['name' => 'frete_peso_bruto', 'value' => 'Peso bruto:'];
									@endphp
									<x-form.label :name="$__f41['name']" :value="$__f41['value']" />
									@php
									$__f42 = ['name' => 'frete_peso_bruto', 'value' => $infoFrete ? $infoFrete['frete_peso_bruto'] : '', 'options' => ['class' => 'form-control','placeholder' => 'Peso bruto']];
									@endphp
									<x-form.input type="text" :name="$__f42['name']" :value="$__f42['value']" :options="$__f42['options']" />
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									@php
									$__f43 = ['name' => 'frete_peso_liquido', 'value' => 'Peso liquido:'];
									@endphp
									<x-form.label :name="$__f43['name']" :value="$__f43['value']" />
									@php
									$__f44 = ['name' => 'frete_peso_liquido', 'value' => $infoFrete ? $infoFrete['frete_peso_liquido'] : '', 'options' => ['class' => 'form-control','placeholder' => 'Peso liquido']];
									@endphp
									<x-form.input type="text" :name="$__f44['name']" :value="$__f44['value']" :options="$__f44['options']" />
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									@php
									$__f45 = ['name' => 'veiculo_placa', 'value' => 'Placa'];
									@endphp
									<x-form.label :name="$__f45['name']" :value="$__f45['value']" />
									@php
									$__f46 = ['name' => 'veiculo_placa', 'value' => $infoFrete ? $infoFrete['veiculo_placa'] : '', 'options' => ['class' => 'form-control','placeholder' => 'Placa', 'data-mask="AAA-AAAA"', 'data-mask-reverse="true"']];
									@endphp
									<x-form.input type="text" :name="$__f46['name']" :value="$__f46['value']" :options="$__f46['options']" />
								</div>
							</div>

							<div class="col-sm-1">
								<div class="form-group">
									@php
									$__f47 = ['name' => 'veiculo_uf', 'value' => 'UF'. ':'];
									@endphp
									<x-form.label :name="$__f47['name']" :value="$__f47['value']" />
									@php
									$__f48 = ['name' => 'veiculo_uf', 'list' => $estados, 'selected' => $infoFrete ? $infoFrete['veiculo_uf'] : '', 'options' => ['id' => 'natureza_id', 'class' => 'form-control select2', 'placeholder' => 'UF']];
									@endphp
									<x-form.select :name="$__f48['name']" :list="$__f48['list']" :selected="$__f48['selected']" :options="$__f48['options']" />
								</div>
							</div>

							
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<button type="submit" class="btn btn-primary pull-right btn-flat">Salvar Devolução</button>
			</div>
		</div>


	</div>

	@endcomponent
	<x-form.close />


</section>

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
	$('#perc_venda').mask('000.00', {reverse: true})
	$('#valor_frete').mask('00000000,00', {reverse: true})
	$('#desconto').mask('00000000,00', {reverse: true})
	$('.qtd').mask('00000000,0000', {reverse: true})
	var ITENS = JSON.parse($('#itens').val());

	console.log(ITENS)

	function removeItem(id){
		console.log("id: ",'#tr_' + id)
		$('#tr_' + id).remove()
		let temp = [];
		ITENS.map((item) => {
			
			if(item.codigo != id){
				temp.push(item)
			}else{
				console.log("nao")
			}

		})
		ITENS = temp;
		console.log(ITENS)
		$('#itens').val(JSON.stringify(ITENS))
	}

	$('.qtd').keyup((target) => {
		let qtd = target.target.value
		let id = target.target.title

		for(let i = 0; i < ITENS.length; i++){
			if(ITENS[i].codigo == id){
				ITENS[i].qCom = qtd
			}
		}

		console.log(ITENS)
		$('#itens').val(JSON.stringify(ITENS))

	})
</script>

@endsection


<!-- /.content -->

@endsection
