{include file='header.tpl'}

<body id="page-top">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        {include file='sidebar.tpl'}

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main content -->
            <div id="content">

                <!-- Topbar -->
                {include file='navbar.tpl'}

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{$CRAFTINGSTORE}</h1>
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{$PANEL_INDEX}">{$DASHBOARD}</a></li>
                            <li class="breadcrumb-item active">{$CRAFTINGSTORE}</li>
                        </ol>
                    </div>

                    <!-- Update Notification -->
                    {include file='includes/update.tpl'}

                    <div class="card">
                        <div class="card-body">
                            <!-- Success and Error Alerts -->
                            {include file='includes/alerts.tpl'}

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="inputSecretKey">{$SERVER_KEY}</label>
                                    <span class="badge badge-info" data-html="true" data-toggle="popover"
                                        title="{$INFO}" data-content="{$SERVER_KEY_INFO}"><i
                                            class="fas fa-question-circle"></i></span>
                                    <input id="inputSecretKey" name="server_key" class="form-control"
                                        placeholder="{$SERVER_KEY}" value="{$SERVER_KEY_VALUE}">
                                </div>

                                <div class="form-group">
                                    <label for="store_path">{$STORE_PATH}</label>
                                    <input type="text" class="form-control" id="store_path" name="store_path"
                                        placeholder="{$STORE_PATH}" value="{$STORE_PATH_VALUE}">
                                </div>

                                <div class="form-group">
                                    <label for="inputStoreContent">{$STORE_INDEX_CONTENT}</label>
                                    <textarea id="inputStoreContent" name="store_content"
                                        class="form-control">{$STORE_INDEX_CONTENT_VALUE}</textarea>
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

                    <!-- End Page Content -->
                </div>

                <!-- End Main Content -->
            </div>

            {include file='footer.tpl'}

            <!-- End Content Wrapper -->
        </div>

        <!-- End Wrapper -->
    </div>

    {include file='scripts.tpl'}

</body>

</html>