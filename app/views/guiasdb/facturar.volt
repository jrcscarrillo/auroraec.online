{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}

<div class="container mt-3">
    <div class="d-table" style="width:100%">
        <div class="d-table-row" style="width:100%">

            <table class="table" width="100%">
                <tr>
                    <td width="48%" style="color:#0000BB;">
                        <img align="middle" width="250" height="200" src="https://carrillosteam.com/public/coop/images/logos/auroralogo.jpg"><br />

                    </td>
                    <td width="51%" class="izq">
                        <br><hr>
                        <div style="color:#A52A2A; font-size:24px; text-align:left; font-weight: bold;">RUC :
                            <span style="color:#B8860B; font-size:24px; text-align:left; font-weight: bold;"> {{ contribuyente['ruc'] }} </span></div>
                        <hr>
                        <div style="color:#A52A2A; font-size:24px; text-align:left; font-weight: bold;">Nro. Guia : 
                            <span style="color:#B8860B; font-size:24px; text-align:left; font-weight: bold;"> {{ guia.gettxnID() }} </span></div>
                        <hr>
                    </td>
                </tr>
            </table>
            <table class="table" width="100%">
                <tr>
                    <td>
                        <div style="color:#A52A2A; font-size:16px; text-align:center; font-weight: bold;"> {{ contribuyente['razon'] }} </div>
                        <div style="color:#A52A2A; font-size:16px; text-align:center; font-weight: bold;">  {{ contribuyente['NombreComercial'] }} </div>
                        <div style="color:#A52A2A; font-size:14px; text-align:center; font-weight: bold;">Direccion Matriz : 
                            <span style="color:#B8860B; font-size:12px;">{{ contribuyente['DirMatriz'] }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:center; font-weight: bold;">Direccion Emisor : 
                            <span style="color:#B8860B; font-size:12px;">{{ contribuyente['DirEmisor'] }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:center; font-weight: bold;">Obligado a llevar contabilidad : 
                            <span style="color:#B8860B; font-size:12px;">{{ contribuyente['LlevaContabilidad'] }} </span></div>
                    </td>
                </tr>
            </table>

            <br>
            <table class="table" width="100%">
                <tr>
                    <td width="48%" class="izq">
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Identificacion Transportista                    : 
                            <span style="color:#B8860B; font-size:14px; text-align:left; font-weight: bold;"> {{ nombres['chofernumeroId'] }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;"> Razon Social / Nombres y Apellidos              : 
                            <span style="color:#B8860B; font-size:14px; text-align:left; font-weight: bold;"> {{ nombres['chofer'] }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Placa                                             : 
                            <span style="color:#B8860B; font-size:14px; text-align:left; font-weight: bold;">{{ nombres['carroplaca'] }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Punto de Partida                                 : 
                            <span style="color:#B8860B; font-size:14px; text-align:left; font-weight: bold;"> {{ nombres['origenaddress'] }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Fecha Inicio                                      : 
                            <span style="color:#B8860B; font-size:14px; text-align:left; font-weight: bold;">{{ guia.getdateBegin() }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Fecha Final                                     : 
                            <span style="color:#B8860B; font-size:14px; text-align:left; font-weight: bold;"> {{ guia.getdateEnd() }} </span></div>
                    </td>
                    <td width="51%" class="izq">
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Motivo Traslado : 
                            <span style="color:#B8860B; font-size:14px; text-align:left; font-weight: bold;"> {{ guia.getmotive() }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Ruta : 
                            <span style="color:#B8860B; font-size:14px; text-align:left; font-weight: bold;"> {{ nombres['ruta'] }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Destino : 
                            <span style="color:#B8860B; font-size:14px; text-align:left; font-weight: bold;"> {{ nombres['destinoaddress'] }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Identificacion Destinatario : 
                            <span style="color:#B8860B; font-size:14px; text-align:left; font-weight: bold;"> {{ nombres['destinonumeroid'] }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Razon Social Destinatario : </strong></span>
                            <span style="color:#B8860B; font-size:14px; text-align:left; font-weight: bold;"> {{ nombres['destino'] }} </span></div>
                    </td>
                </tr>
            </table>

            <br />

            <table class="table table-bordered table-striped table-hover" width="100%" style="font-size: 10pt; border-collapse: collapse; " cellpadding="2">
                <thead>
                    <tr class="table-secondary">
                        <th class="tb-gen tb-c10" align="center" style="font-weight: bold;">CodigoPrincipal</th>
                        <th class="tb-gen tb-c10" align="center" style="font-weight: bold;">Codigo Auxiliar</th>
                        <th class="tb-gen tb-c20" align="center" style="font-weight: bold;">Lotes Usados</th>
                        <th class="tb-gen tb-c30" align="left" style="font-weight: bold;">Descripcion</th>
                        <th class="tb-gen tb-c10" align="right" style="font-weight: bold;">Cantidad</th>
                    </tr>

                </thead>

                <tbody>
                    {% for producto in productos %}
                        <tr>
                            <td> {{ producto.ItemRefListID }} </td>
                            <td> {{ producto.Items.nombre }} </td>
                            <td> {{ producto.numeroLote }} </td>
                            <td> {{ producto.ItemRefFullName }} </td>
                            <td align="right"> {{ producto.Qty | number_format(2, ',', '.') }} </td>
                        </tr>  
                    {% endfor %}
                </tbody>
            </table>
            <table class="table" width="100%">
                <tr>
                    <td width="100%" class="izq">
                        <div style="color:#A52A2A; font-size:16px; text-align:center; font-weight: bold;">Informacion Adicional</div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">TEL : 
                            <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ cliente.getPhone() }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">EMAIL : 
                            <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ cliente.getEmail() }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">RUTA : 
                            <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ cliente.getCustomField1() }} </span></div>
                        <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">ASESOR : 
                            <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ cliente.getSalesRepRefFullName() }} </span></div>
                        {{ link_to("guia/firmar/" ~ guia.gettxnID(), 'Autorizar SRI', "class": "btn btn-primary") }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>



