{include file="head.tpl"}

<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">{$lang["user.Login existing user"]}</h3>
        </div>
        <div class="panel-body">

            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label class="col-md-2 control-label">{$lang["user.E-mail"]}:</label>
                    <div class="col-md-10"><input type="text" name="email" class="form-control" value="" /></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">{$lang["user.Password"]}:</label>
                    <div class="col-md-10"><input type="password" name="password" class="form-control"  value="" /></div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-5 col-md-7">
                        <div class="col-md-2 text-left">
                            <button type="submit" title="{$lang["user.Login"]}" class="btn btn-primary" />
                              <i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;{$lang["user.Login"]}
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

{include file="tail.tpl"}