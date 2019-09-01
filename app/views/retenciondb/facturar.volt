{{ content() }}
{{ elements.getModelosAdicional() }}
{% include "layouts/cabecera.volt" %}

<div style="background-color: #C1C1C1" >
    <div class="d-table" style="width:80%; margin: 0 auto;" >

                <table class="table text-center">
                    <tr>
                        <td width="48%" style="color:#0000BB;">
                            <img align="middle" width="250" height="200" src="https://carrillosteam.com/public/coop/images/logos/auroralogo.jpg"><br />

                        </td>
                        <td width="51%" class="izq">
                            <br><hr>
                            <div style="color:#A52A2A; font-size:24px; text-align:left; font-weight: bold;">RUC :
                                <span style="color:#B8860B; font-size:24px; text-align:left; font-weight: bold;"> {{ contribuyente['ruc'] }} </span></div>
                                <hr>
                                <div style="color:#A52A2A; font-size:24px; text-align:left; font-weight: bold;">Nro. Retencion : 
                                <span style="color:#B8860B; font-size:24px; text-align:left; font-weight: bold;"> {{ retencion.getTxnID() }} </span></div>
                                <hr>
                        </td>
                    </tr><tr></tr>
                    <tr><td>
                            <div style="color:#A52A2A; font-size:16px; text-align:left; font-weight: bold;"> {{ contribuyente['razon'] }} </div>
                            <div style="color:#A52A2A; font-size:16px; text-align:left; font-weight: bold;">  {{ contribuyente['NombreComercial'] }} </strong></div>
                            <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Direccion Matriz : <span style="color:#B8860B; font-size:12px;">
                                    {{ contribuyente['DirMatriz'] }} </span></div>
                            <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Direccion Emisor : <span style="color:#B8860B; font-size:12px;">
                                    {{ contribuyente['DirEmisor'] }} </span></div>
                            <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Obligado a llevar contabilidad : <span style="color:#B8860B; font-size:12px;">
                                    {{ contribuyente['LlevaContabilidad'] }} </span></div>
                        </td>
                        <td>
                            <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Razon Social : 
                                <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ proveedor.getName() }} </span></div>
                            <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Identificacion : 
                                <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ proveedor.getAccountNumber() }} </span></div>
                            <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Nombre Comercial : 
                                <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ proveedor.getCompanyName() }} </span></div>
                            <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Direccion : 
                                <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ proveedor.getVendorAddress_City() ~ proveedor.getVendorAddress_Addr1() }} </span></div>

                            <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Factura de Compra :</span> 
                                <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ retencion.getCustomField4() }} </span></div>
                            
                            <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Fecha Emision :</span> 
                                <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ date('F j, Y', strtotime(retencion.getTxnDate())) }} </span></div>                                
                        </td></tr></table>

                <br>

                <table class="table-bordered" style="font-size: 8pt; " cellpadding="2">
                    <thead>
                        <tr class="table-secondary">
                            <th class="tb-gen tb-c10" align="center" style="font-weight: bold;">Codigo</th>
                            <th class="tb-gen tb-c20"  align="center" style="font-weight: bold;">Descripcion</th>
                            <th class="tb-gen tb-c10"  align="right" style="font-weight: bold;">Tipo</th>
                            <th class="tb-gen tb-c10"  align="right" style="font-weight: bold;">Base Imponible</th>
                            <th class="tb-gen tb-c10"  align="right" style="font-weight: bold;">%</th>
                            <th class="tb-gen tb-c10"  align="right" style="font-weight: bold;">Valor Retenido</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% set base = 0 %}
                        {% set total = 0 %}
                        {% for producto in productos %}
                            <tr>
                                <td> {{ producto.CustomField2 }} </td>
                                <td> {{ producto.CustomField3 }} </td>
                                <td> {{ producto.CustomField1 }} </td>
                                <td align="right"> {{ producto.Quantity | number_format(2, ',', '.') }} </td>
                                <td align="right"> {{ producto.Cost | number_format(2, ',', '.') }} </td>
                                <td align="right"> {{ producto.Amount | number_format(2, ',', '.') }} </td>
                            </tr>  
                            {% set base = base + producto.Quantity %}
                            {% set total = total + producto.Amount %}
                        {% endfor %}

                            <tr>
                                <td class="blanktotal" colspan="4" rowspan="6">
                                    <span style="color:#A52A2A; font-size:14px; text-align:center; font-weight: bold;">Informacion Adicional</span>
                                    <div style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;">TEL : {{ proveedor.phone }} </div>
                                    <div style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;">EMAIL : {{ proveedor.email }}</div>
                                    <div style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;">OBSERVACIONES : {{ retencion.CustomField3 }} </div>
                                  {{ link_to("vendorcredit/firmar/" ~ retencion.getTxnID(), 'Autorizar SRI', "class": "btn btn-success") }}
                                  {{ link_to("retenciondb/eliminar", 'Cancelar Facturacion', "class": "btn btn-secondary") }}
                                </td>
                                <td class="totals" align="right">Total Base Imponible :</td>
                                <td class="totals" align="right"> {{ base | number_format(2, ',', '.') }} </td>
                            </tr>
                            <tr>
                                <td class="totals" align="right"><b>Valor Total Retenido :</b></td>
                                <td class="totals" align="right"><b>{{ total | number_format(2, ',', '.') }} </b></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>



