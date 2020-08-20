{include file='header.tpl'}
{include file='navbar.tpl'}

<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 style="display:inline">{$STORE}</h2>
            <a class="btn btn-primary float-lg-right" href="{$STORE_URL}" target="_blank">{$VIEW_FULL_STORE}</a>

            <hr />

            {include file='craftingstore/parts/nav.tpl'}

            <hr />

            <div class="row">
                <div class="col-md-12">

                    {$CONTENT}

                </div>
            </div>
        </div>
    </div>
</div>

{include file='footer.tpl'}