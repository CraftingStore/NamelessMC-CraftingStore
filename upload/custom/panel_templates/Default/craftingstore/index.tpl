{include file='header.tpl'}
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    {include file='navbar.tpl'}
    {include file='sidebar.tpl'}

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{$CRAFTINGSTORE}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{$PANEL_INDEX}">{$DASHBOARD}</a></li>
                            <li class="breadcrumb-item active">{$CRAFTINGSTORE}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        {if isset($SUCCESS)}
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5><i class="icon fa fa-check"></i> {$SUCCESS_TITLE}</h5>
                                {$SUCCESS}
                            </div>
                        {/if}

                        {if isset($ERRORS) && count($ERRORS)}
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5><i class="icon fas fa-exclamation-triangle"></i> {$ERRORS_TITLE}</h5>
                                <ul>
                                    {foreach from=$ERRORS item=error}
                                        <li>{$error}</li>
                                    {/foreach}
                                </ul>
                            </div>
                        {/if}

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="inputSecretKey">{$SERVER_KEY}</label>
                                <span class="badge badge-info" data-html="true" data-toggle="popover" title="{$INFO}" data-content="{$SERVER_KEY_INFO}"><i class="fas fa-question-circle"></i></span>
                                <input id="inputSecretKey" name="server_key" class="form-control" placeholder="{$SERVER_KEY}" value="{$SERVER_KEY_VALUE}">
                            </div>

                            <div class="form-group">
                                <label for="store_path">{$STORE_PATH}</label>
                                <input type="text" class="form-control" id="store_path" name="store_path" placeholder="{$STORE_PATH}" value="{$STORE_PATH_VALUE}">
                            </div>

                            <div class="form-group">
                                <label for="inputStoreContent">{$STORE_INDEX_CONTENT}</label>
                                <textarea id="inputStoreContent" name="store_content" class="form-control">{$STORE_INDEX_CONTENT_VALUE}</textarea>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="token" value="{$TOKEN}">
                                <input type="submit" value="{$SUBMIT}" class="btn btn-primary">
                            </div>
                        </form>

                    </div>
                </div>

                <!-- Spacing -->
                <div style="height:1rem;"></div>

            </div>
        </section>
    </div>

    {include file='footer.tpl'}

</div>
<!-- ./wrapper -->

{include file='scripts.tpl'}

{literal}
<script>
let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
elems.forEach(function(html) {
  let switchery = new Switchery(html, {color: '#23923d', secondaryColor: '#e56464'});
});
</script>
{{/literal}}

</body>
</html>