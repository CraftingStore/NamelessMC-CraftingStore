{include file='header.tpl'}
{include file='navbar.tpl'}

<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 style="display:inline">{$STORE} &raquo; {$ACTIVE_CATEGORY}</h2>
            <a class="btn btn-primary float-lg-right" href="http://{$STORE_URL}" target="_blank">{$VIEW_FULL_STORE}</a>

            <hr />

            {include file='craftingstore/parts/nav.tpl'}

            <hr />

            {if isset($NO_PACKAGES)}
                <div class="alert alert-info">
                    {$NO_PACKAGES}
                </div>
            {else}
                <div class="row">
                    {assign var=i value=0}
                    {foreach from=$PACKAGES item=package name=packageArray}
                        <div class="col-md-4 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    {if $package.image}
                                        <img class="rounded" style="max-height: 150px; max-width: 150px;" src="{$package.image}" alt="{$package.name}">
                                    {/if}

                                    <hr />

                                    <h5 class="card-title">{$package.name}</h5>
                                    <div class="ui divider"></div>
                                    {$package.price} {$CURRENCY}

                                    <hr />

                                    <button role="button" class="btn btn-primary" data-toggle="modal" data-target="#modal{$package.id}">
                                        {$BUY} &raquo;
                                    </button>
                                </div>
                            </div>

                            <div class="modal fade" id="modal{$package.id}" tabindex="-1" role="dialog" aria-labelledby="modal{$package.id}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="text-align: center;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal{$package.id}Label">{$package.name}<span aria-hidden="true"> | {$package.price} {$CURRENCY}</span></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {if $package.image}
                                                <img class="rounded" style="max-width: 200px; max-height: 200px" src="{$package.image}" alt="{$package.name}" />
                                                <hr />
                                            {/if}
                                            <div class="forum_post">
                                                {$package.description}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">{$CLOSE}</button>
                                            <a href="http://{$STORE_URL}/package/{$package.id}" target="_blank" rel="nofollow noopener" class="btn btn-success">{$BUY}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {assign var=i value=$i+1}
                    {/foreach}
                </div>
            {/if}
        </div>
    </div>
</div>

{include file='footer.tpl'}
