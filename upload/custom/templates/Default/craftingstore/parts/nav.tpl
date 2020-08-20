<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="border-radius:5px;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#storeNav" aria-controls="storeNav" aria-expanded="false" aria-label="Toggle category navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="storeNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{$HOME_URL}">{$HOME}</a>
            </li>
            {foreach from=$CATEGORIES item=category}
                {if count($category.subCategories)}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                            {$category.name}
                        </a>
                        <div class="dropdown-menu">
                            {foreach from=$category.subCategories item=subcategory}
                                <a class="dropdown-item" href="{$subcategory.link}">{$subcategory.name}</a>
                            {/foreach}
                        </div>
                    </li>
                {else}
                    <li class="nav-item">
                        <a class="nav-link" href="{$category.link}">{$category.name}</a>
                    </li>
                {/if}
            {/foreach}
        </ul>
    </div>
</nav>
