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
                                <div style="color:#A52A2A; font-size:24px; text-align:left; font-weight: bold;">Nro. Nota de Credito : 
                                <span style="color:#B8860B; font-size:24px; text-align:left; font-weight: bold;"> {{ credito.getTxnID() }} </span></div>
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
                                <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ credito.getCustomerRefFullName() }} </span></div>
                            <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Identificacion : 
                                <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ credito.getCustomerRefListID() }} </span></div>
                            <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Nombre Comercial : 
                                <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ credito.getCustomerRefFullName() }} </span></div>
                            <div style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Direccion : 
                                <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ credito.getBillAddressCity() ~ credito.getBillAddressAddr1() }} </span></div>

                            <div style="text-align: left">
                                <span style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Fecha del Credito :</span> 
                                <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ date('F j, Y', credito.getDueDate()) }} </span>

                                <span style="color:#A52A2A; font-size:14px; text-align:left; font-weight: bold;">Fecha Emision :</span> 
                                <span style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;"> {{ date('F j, Y', credito.getTxnDate()) }} </span></div>                                
                        </td></tr></table>

                <br>

                <table class="table-bordered" width="100%" style="font-size: 8pt; " cellpadding="2">
                    <thead>
                        <tr class="table-secondary">
                            <th align="center" style="font-weight: bold;">Codigo</th>
                            <th align="center" style="font-weight: bold;">Descripcion</th>
                            <th align="right" style="font-weight: bold;">Cantidad</th>
                            <th align="right" style="font-weight: bold;">Precio</th>
                            <th align="right" style="font-weight: bold;">Dscto.</th>
                            <th align="right" style="font-weight: bold;">Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for producto in productos %}
                            <tr>
                                <td> {{ producto.ItemRefListID }} </td>
                                <td> {{ producto.ItemRefFullName }} </td>
                                <td align="right"> {{ producto.Qty | number_format(2, ',', '.') }} </td>
                                <td align="right"> {{ producto.Price | number_format(2, ',', '.') }} </td>
                                <td align="right">0,00</td>
                                <td align="right"> {{ producto.Amount | number_format(2, ',', '.') }} </td>
                            </tr>  
                        {% endfor %}

                            <tr>
                                <td class="blanktotal" colspan="4" rowspan="6">
                                    <span style="color:#A52A2A; font-size:14px; text-align:center; font-weight: bold;">Informacion Adicional</span>
                                    <div style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;">TEL : {{ cliente.getPhone() }} </div>
                                    <div style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;">EMAIL : {{ cliente.getEmail() }}</div>
                                    <div style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;">RUTA : {{ cliente.getCustomField1() }} </div>
                                    <div style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;">ASESOR : {{ cliente.getSalesRepRefFullName() }} </div>
                                    <div style="color:#B8860B; font-size:12px; text-align:left; font-weight: bold;">OBSERVACIONES : {{ credito.getCustomField3() }} </div>
                                  {{ link_to("notacredito/search/" ~ ' ', 'Regresar a Busqueda', "class": "btn btn-primary") }}
                                </td>
                                <td class="totals" align="right">Subtotal 12% :</td>
                                <td class="totals" align="right">

                                    {{ credito.getSubtotal() | number_format(2, ',', '.') }} </td>
                            </tr>
                            <tr>
                                <td class="totals" align="right">Subtotal 0% :</td>
                                <td class="totals" align="right">0.00</td>
                            </tr>
                            <tr>
                                <td class="totals" align="right">Sin Impuestos :</td>
                                <td class="totals" align="right">0.00</td>
                            </tr>
                            <tr>
                                <td class="totals" align="right"><b>IVA 12% :</b></td>
                                <td class="totals" align="right"><b>

                                        {{ credito.getSalesTaxTotal() | number_format(2, ',', '.') }} </b></td>
                            </tr>
                            <tr>
                                <td class="totals" align="right">Descuentos :</td>
                                <td class="totals" align="right">0.00</td>
                            </tr>
                            <tr>
                                <td class="totals" align="right"><b>Importe Total:</b></td>
                                <td class="totals" align="right"><b>
                                        {% set totalfactura = credito.getSalesTaxTotal() + credito.getSubtotal() %}
                                        {{ totalfactura  | number_format(2, ',', '.') }} </b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



