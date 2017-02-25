<div class="container">
    <div class="row">
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target="#MyTopMenu" >
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="MyTopMenu">
                    <ul class="nav navbar-nav">
                        <li{if $arr.menu == "info/index"} class="active"{/if}>
                            <a href="/info/index" title="{$lang->word("menu.home")}">
                                <i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;{$lang->word("menu.home")}</a>
                        </li>
                        <li{if $arr.menu == "user/signup"} class="active"{/if}>
                           <a href="/user/signup" title="{$lang->word("menu.join")}">
                               <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;{$lang->word("menu.join")}
                            </a>
                        </li>
                        <li>
                           <a href="/ru" title="По-русски">
                               &nbsp;&nbsp;По-русски
                           </a>
                        </li>
                        <li>
                           <a href="/en" title="English">
                               </i>&nbsp;&nbsp;English
                           </a>
                        </li>
                        <li>
                           <a href="/lt" title="По-литовски">
                               </i>&nbsp;&nbsp;Lietuviškai
                           </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li{if $arr.menu == "user/login"} class="active"{/if}>
                            <a href="/user/login" title="{$lang->word("menu.login")}">
                                <i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;{$lang->word("menu.login")}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
