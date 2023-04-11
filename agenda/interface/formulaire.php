<div class="row">
    <div class="col-md-4 col-12">
        <label for="date" class="col-form-label obligatoire">Date </label>
        <input id="date"
               type='date'
               style="width: 160px;"
               required
               value='<?= isset($date) ? $date : "" ?>'
               min='<?= isset($min) ? $min : "" ?>'
               max='<?= isset($max) ? $max : "" ?>'
               class="form-control ctrl ">
        <div id='msgdate' class='messageErreur'></div>
    </div>
    <div class="col-md-8 col-12">
        <label for="nom" class="col-form-label obligatoire">Nom </label>
        <input id="nom"
               type="text"
               required
               minlength="10"
               maxlength="70"
               pattern="^[0-9A-Za-zÀÇÈÉÊàáâçèéêëî]((.)*[0-9A-Za-zÀÇÈÉÊàáâçèéêëî!])*$"
               class="form-control ctrl"
               autocomplete="off">
        <div id='msgnom' class='messageErreur'></div>
    </div>
</div>
</p>
<input type="checkbox" id="prive" name="prive" value="privé">
<label for="prive"> Événement privé </label>
</p>
<label for="description" class="col-form-label">Description</label>
<textarea id='description' style="min-height: 350px" class="form-control"></textarea>
<div id="msgdescription" class='messageErreur'></div>
