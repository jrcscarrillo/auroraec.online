<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("guiatrx", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit guiatrx
    </h1>
</div>

{{ content() }}

{{ form("guiatrx/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldTxnid" class="col-sm-2 control-label">TxnID</label>
    <div class="col-sm-10">
        {{ select_static("txnID", "using": [], "class" : "form-control", "id" : "fieldTxnid") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTimecreated" class="col-sm-2 control-label">TimeCreated</label>
    <div class="col-sm-10">
        {{ text_field("timeCreated", "size" : 30, "class" : "form-control", "id" : "fieldTimecreated") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTimemodified" class="col-sm-2 control-label">TimeModified</label>
    <div class="col-sm-10">
        {{ text_field("timeModified", "size" : 30, "class" : "form-control", "id" : "fieldTimemodified") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEditsequence" class="col-sm-2 control-label">EditSequence</label>
    <div class="col-sm-10">
        {{ text_field("editSequence", "type" : "numeric", "class" : "form-control", "id" : "fieldEditsequence") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldNumerolote" class="col-sm-2 control-label">NumeroLote</label>
    <div class="col-sm-10">
        {{ select_static("numeroLote", "using": [], "class" : "form-control", "id" : "fieldNumerolote") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldItemreflistid" class="col-sm-2 control-label">ItemRefListID</label>
    <div class="col-sm-10">
        {{ text_field("ItemRefListID", "size" : 30, "class" : "form-control", "id" : "fieldItemreflistid") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldItemreffullname" class="col-sm-2 control-label">ItemRefFullName</label>
    <div class="col-sm-10">
        {{ text_field("ItemRefFullName", "size" : 30, "class" : "form-control", "id" : "fieldItemreffullname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldObslote" class="col-sm-2 control-label">ObsLote</label>
    <div class="col-sm-10">
        {{ text_field("obsLote", "size" : 30, "class" : "form-control", "id" : "fieldObslote") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldOrigentrx" class="col-sm-2 control-label">OrigenTrx</label>
    <div class="col-sm-10">
        {{ text_field("origenTrx", "size" : 30, "class" : "form-control", "id" : "fieldOrigentrx") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldDestinotrx" class="col-sm-2 control-label">DestinoTrx</label>
    <div class="col-sm-10">
        {{ text_field("destinoTrx", "size" : 30, "class" : "form-control", "id" : "fieldDestinotrx") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldQty" class="col-sm-2 control-label">Qty</label>
    <div class="col-sm-10">
        {{ text_field("qty", "type" : "numeric", "class" : "form-control", "id" : "fieldQty") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldIdkey" class="col-sm-2 control-label">IDKEY</label>
    <div class="col-sm-10">
        {{ text_field("IDKEY", "size" : 30, "class" : "form-control", "id" : "fieldIdkey") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEstado" class="col-sm-2 control-label">Estado</label>
    <div class="col-sm-10">
        {{ text_field("estado", "size" : 30, "class" : "form-control", "id" : "fieldEstado") }}
    </div>
</div>


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
