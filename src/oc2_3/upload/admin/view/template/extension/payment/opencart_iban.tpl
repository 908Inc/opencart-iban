<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-payment" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
          <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
      <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-payment" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab" id="tab-general-link"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-autoclient" data-toggle="tab" id="tab-autoclient-link"><?php echo $tab_autoclient; ?></a></li>
          </ul>
          <div class="tab-content" style="padding-top:15px">
            <div class="tab-pane active" id="tab-general">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-iban"><?php echo $entry_iban; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="opencart_iban_iban" value="<?php echo htmlspecialchars($opencart_iban_iban, ENT_QUOTES, 'UTF-8'); ?>" placeholder="<?php echo $entry_iban; ?>" id="input-iban" class="form-control" />
                  <?php if ($error_iban) { ?>
                    <div class="text-danger"><?php echo $error_iban; ?></div>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-code"><?php echo $entry_code; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="opencart_iban_code" value="<?php echo htmlspecialchars($opencart_iban_code, ENT_QUOTES, 'UTF-8'); ?>" placeholder="<?php echo $entry_code; ?>" id="input-code" class="form-control" />
                  <?php if ($error_code) { ?>
                    <div class="text-danger"><?php echo $error_code; ?></div>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-client-key"><?php echo $entry_client_key; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="opencart_iban_client_key" value="<?php echo htmlspecialchars($opencart_iban_client_key, ENT_QUOTES, 'UTF-8'); ?>" placeholder="<?php echo $entry_client_key; ?>" id="input-client-key" class="form-control" />
                  <?php if ($error_client_key) { ?>
                    <div class="text-danger"><?php echo $error_client_key; ?></div>
                  <?php } ?>
                  <p class="help-block"><?php echo $help_client_key; ?></p>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-client-name"><?php echo $entry_client_name; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="opencart_iban_client_name" value="<?php echo htmlspecialchars($opencart_iban_client_name, ENT_QUOTES, 'UTF-8'); ?>" placeholder="<?php echo $entry_client_name; ?>" id="input-client-name" class="form-control" />
                  <?php if ($error_client_name) { ?>
                    <div class="text-danger"><?php echo $error_client_name; ?></div>
                  <?php } ?>
                  <p class="help-block"><?php echo $help_client_name; ?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_purpose; ?></label>
                <div class="col-sm-10">
                  <?php foreach ($languages as $language) { ?>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                      </span>
                      <input
                        type="text"
                        name="opencart_iban_purpose_<?php echo $language['language_id']; ?>"
                        value="<?php echo htmlspecialchars(isset($opencart_iban_purpose[$language['language_id']]) ? $opencart_iban_purpose[$language['language_id']] : '', ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="<?php echo $entry_purpose; ?>"
                        id="input-purpose-<?php echo $language['language_id']; ?>"
                        class="form-control"
                      />
                    </div>
                  <?php } ?>
                  <p class="help-block"><?php echo $help_purpose; ?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
                <div class="col-sm-10">
                  <select name="opencart_iban_order_status_id" id="input-order-status" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                      <?php if ($order_status['order_status_id'] == $opencart_iban_order_status_id) { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="opencart_iban_status" id="input-status" class="form-control">
                    <?php if ($opencart_iban_status) { ?>
                      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                      <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                      <option value="1"><?php echo $text_enabled; ?></option>
                      <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="opencart_iban_sort_order" value="<?php echo $opencart_iban_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-autoclient">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-autoclient"><?php echo $entry_autoclient; ?></label>
                <div class="col-sm-10">
                  <select name="opencart_iban_autoclient" id="input-autoclient" class="form-control">
                    <?php if ($opencart_iban_autoclient) { ?>
                      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                      <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                      <option value="1"><?php echo $text_enabled; ?></option>
                      <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                  <p class="help-block"><?php echo $help_autoclient; ?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-paid-order-status"><?php echo $entry_paid_order_status; ?></label>
                <div class="col-sm-10">
                  <select name="opencart_iban_paid_order_status_id" id="input-paid-order-status" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                      <?php if ($order_status['order_status_id'] == $opencart_iban_paid_order_status_id) { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                  <p class="help-block"><?php echo $help_paid_order_status; ?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-callback-url"><?php echo $entry_callback_url; ?></label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <input type="text" value="<?php echo $callback_url; ?>" class="form-control" readonly id="input-callback-url"/>
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button" onclick="var el=document.getElementById('input-callback-url');el.select();document.execCommand('copy');"><i class="fa fa-copy"></i></button>
                    </span>
                  </div>
                  <p class="help-block"><?php echo $help_callback_url; ?></p>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(function() {
  var panes = [
    { link: '#tab-general-link', pane: '#tab-general' },
    { link: '#tab-autoclient-link', pane: '#tab-autoclient' }
  ];
  for (var i = 0; i < panes.length; i++) {
    if ($(panes[i].pane).find('.text-danger').length) {
      $(panes[i].link).tab('show');
      return;
    }
  }
});
</script>
<?php echo $footer; ?>
